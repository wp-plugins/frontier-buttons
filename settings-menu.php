<?php
/*
Admin settings menu - Frontier Editor Buttons
*/


function frontier_buttons_settings_menu() 
	{
	//create new top-level menu
	add_options_page('Frontier Buttons', 'Frontier Buttons', 'administrator', __FILE__, 'frontier_buttons_settings_page');
	}

function frontier_buttons_settings_page() 
	{
		include("frontier-buttons-defaults.php");
		//must check that the user has the required capability 
		if (!current_user_can('manage_options'))
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
		
		
		// See if the user has posted us some information
		// If they did, this hidden field will be set to 'Y'
		if( isset($_POST[ "frontier_isupdated_hidden" ]) && $_POST[ "frontier_isupdated_hidden" ] == 'Y' ) 
			{
				
				// get form data, and save it
				
				
				//get the button table values
				$tmp_buttons 	= array();
				
				// loop through the 4 toolbars
				for ($b=0; $b<=3; $b++)
					{
					$tmp_buttons[$b] 	= array();
					
					// Loop through the 20 options for each toolbar
					for ($x=0; $x<=19; $x++)
						{
						$tmp_fieldname = "frontier_btn_" . $b . "_" . $x;
						$tmp_value = isset($_POST[ $tmp_fieldname]) ? $_POST[ $tmp_fieldname] : $frontier_buttons_empty ;
						if ($tmp_value != $frontier_buttons_empty)
							{
							array_push($tmp_buttons[$b],$tmp_value);
							}
						}
					}
				update_option("frontier_buttons_toolbars", $tmp_buttons);
				
			
				// Put an settings updated message on the screen
				?>
					<div class="updated"><p><strong><?php _e('Settings saved.', 'frontier-buttons' ); ?></strong></p></div>
				<?php
			}
		
		
		?>
	
		<div class="wrap">
		<div class="frontier-admin-menu">
		<h2><?php _e("Frontier Editor Buttons Settings", "frontier-buttons") ?></h2>

		<form name="frontier_buttons_settings" method="post" action="">
			<input type="hidden" name="frontier_isupdated_hidden" value="Y">
			
			<table border="1">
					<tr>
					<th colspan="8"></center><?php _e("WP editor toolbar setup", "frontier-buttons"); ?></center></th>
					<tr></tr>
					<tr></tr>
						<th width="25%"><?php _e("Toolbar", "frontier-buttons"); ?> 1</th>
						<th width="25%"><?php _e("Toolbar", "frontier-buttons"); ?> 2</th>
						<th width="25%"><?php _e("Toolbar", "frontier-buttons"); ?> 3</th>
						<th width="25%"><?php _e("Toolbar", "frontier-buttons"); ?> 4</th>
					
					</tr>
					
			<?php
			
			//Build table based on values from options
			
			$buttonlist = $frontier_buttons;
			
	
			
			//$stdbuttons  	= array( $std_frontier_buttons1, $std_frontier_buttons2, $std_frontier_buttons3,	$std_frontier_buttons4);
			$stdbuttons 	= get_option("frontier_buttons_toolbars"); 
						
			
			//build 20 button placeholders for each tool bar
			for ($x=0; $x<=19; $x++)
				{
				?><tr><?php
				
				//loop through the 4 toolbars
				for ($b=0; $b<=3; $b++)
					{
					$tmp_value = "";
					$btnlist = $stdbuttons[$b];
					
					if (isset($btnlist[$x]) && ($btnlist[$x] > ""))
						{
						$tmp_value = $btnlist[$x];						
						}
					
					if (!isset($btnlist[$x]) || ($tmp_value <= " "))
						{
						$tmp_value = $frontier_buttons_empty;
						}
					// output cell
					$tmp_name		= 'frontier_btn_'.$b.'_'.$x;
					
					
					?>
					<td>
					<select  id="<?php echo $tmp_name ?>" name="<?php echo $tmp_name ?>" >
						<?php foreach($frontier_buttons as $id => $desc) : ?>   
								<option value='<?php echo $id ?>' <?php echo ( $id == $tmp_value) ? "selected='selected'" : ' ';?>>
									<?php echo $desc; ?>
								</option>
							<?php endforeach; ?>
							</select>
					</td>
					<?php
					
					}
				?></tr><?php
				
				
				}
			
			?>
			
			</table>
			
			<br/>
			<br/>
			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
			</p>
			<hr>
			<?php
			// ************** Show the editor *******************************************
			
			$tmp_text = __("This is a sample of the editor, new button layout wont show until you save","frontier-buttons") . " <br>	:)  <br>";
			
			$editor_layout	= array('media_buttons' => false, 'dfw' => false, 'tabfocus_elements' => 'sample-permalink,post-preview', 'editor_height' => 100 );
			
			wp_editor($tmp_text, 'user_post_desc', $editor_layout);
			
			
			?>
		</form>
		
		

	</div> <!-- frontier-admin-menu -->
	</div> <!-- wrap -->

	<?php 
	} // end function frontier_buttons_settings_page
	
	?>