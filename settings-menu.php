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
				$bsettings_save = array(
							'visual_editor' 		=> (isset($_POST[ "btn_visual_editor_enable"]) 	? $_POST[ "btn_visual_editor_enable"] 		: "false"),
							'editor_lines'			=> (isset($_POST[ "btn_cmt_editor_lines"]) 		? $_POST[ "btn_cmt_editor_lines"] 			: 5),
							'enable_comment_editor'	=> (isset($_POST[ "btn_comment_editor_enable"]) ? $_POST[ "btn_comment_editor_enable"] 		: "false"),
							'comment_editor_login'	=> (isset($_POST[ "btn_comment_editor_login"]) ? $_POST[ "btn_comment_editor_login"] 		: "false"),
							'enable_teeny_editor'	=> (isset($_POST[ "btn_teeny_enable"]) 			? $_POST[ "btn_teeny_enable"] 				: "false")
							);
			
				update_option("frontier_buttons_settings", $bsettings_save);
				/*
				print_r("</br>after save");
				print_r("</br>");
				print_r("comment editor: ");
				print_r($bsettings_save['comment_editor_type']);
				print_r("</br>");
				print_r($_POST[ "btn_comment_editor_type"]);
				print_r("</br>");
				*/
				
				//Setup buttons
				$tmp_buttons 	= array();
				
				// loop through the 6 toolbars
				for ($b=0; $b<=5; $b++)
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
		
		
		// load settings
		$bsettings		= get_option("frontier_buttons_settings") ? get_option("frontier_buttons_settings") : $std_frontier_settings ;
			
		$btn_visual_editor_enable	=	$bsettings['visual_editor'] ;
		$btn_cmt_editor_lines 		=	$bsettings['editor_lines'] ? $bsettings['editor_lines'] : 5;
		$btn_comment_editor_enable 	=	$bsettings['enable_comment_editor'];
		//$btn_comment_editor_type	=	$bsettings['comment_editor_type'] ? $bsettings['comment_editor_type'] : 'minimal-visual';
		$btn_comment_editor_login 	=	$bsettings['comment_editor_login'];
		$btn_teeny_enable 			=	$bsettings['enable_teeny_editor'];
		/*
		print_r("</br>after load of settings</br>");
		print_r("comment editor: ");
		print_r($btn_comment_editor_type);
		print_r("</br>");
		print_r("Editor types: ");
		print_r($editor_types);
		print_r("</br>");
		*/
		?>
		
		<div class="wrap">
		<div class="frontier-admin-menu">
		<h2><?php _e("Frontier Editor Buttons Settings", "frontier-buttons") ?></h2>

		<form name="frontier_buttons_settings" method="post" action="">
			<input type="hidden" name="frontier_isupdated_hidden" value="Y">
			
			<table border="1">
				<tr>
					<td><?php _e("Enable editor for comments", "frontier-buttons"); ?>:</td>
					<td><center><input type="checkbox" name="btn_comment_editor_enable" value="true" <?php echo ($btn_comment_editor_enable == "true") ? 'checked':''; ?>></center></td>
					<td><?php _e("Editor for comments only for logged in users", "frontier-buttons"); ?>:</td>
					<td><center><input type="checkbox" name="btn_comment_editor_login" value="true" <?php echo ($btn_comment_editor_login == "true") ? 'checked':''; ?>></center></td>
				</tr><tr>
					<td><?php _e("Use visual editor for comments", "frontier-buttons"); ?>:</td>
					<td><center><input type="checkbox" name="btn_visual_editor_enable" value="true" <?php echo ($btn_visual_editor_enable == "true") ? 'checked':''; ?>></center></td>
					
					<td><?php _e("Editor lines for comments", "frontier-buttons");?>:</td>
					<td><input type="text" name="btn_cmt_editor_lines" value="<?php echo $btn_cmt_editor_lines; ?>" /></td>
				</tr>
			</table>
			</br>
			<table border="1">
					<tr>
					<th colspan="8"></center><?php _e("WP editor toolbar setup", "frontier-buttons"); ?></center></th>
					<tr></tr>
					<tr></tr>
						<th width="20%"><?php _e("Toolbar", "frontier-buttons"); ?> 1</th>
						<th width="20%"><?php _e("Toolbar", "frontier-buttons"); ?> 2</th>
						<th width="20%"><?php _e("Toolbar", "frontier-buttons"); ?> 3</th>
						<th width="20%"><?php _e("Toolbar", "frontier-buttons"); ?> 4</th>
						<th width="20%"><?php _e("Toolbar", "frontier-buttons"); ?> </br>Simple</th>
					</tr>
					
			<?php
			
			//Build table based on values from options
			
			
			
			//$stdbuttons  	= array( $std_frontier_buttons1, $std_frontier_buttons2, $std_frontier_buttons3,	$std_frontier_buttons4);
			$stdbuttons 		= get_option("frontier_buttons_toolbars"); 
			$not_used_full		= $frontier_buttons;
			$not_used_teeny		= $frontier_teeny_buttons;
			/*
			$used_buttons 		= array_merge($stdbuttons[0], $stdbuttons[1], $stdbuttons[2] );
			$used_buttons 		= array_merge($used_buttons, $stdbuttons[3]);
			$tmp_std_buttons 	= array_keys($frontier_buttons);
			$not_used_buttons 	= array_diff($used_buttons, $tmp_std_buttons);
			
			print_r("--standard buttons:");
			print_r($tmp_std_buttons);
			print_r("</br>");
			
			//$xx = array_flip($frontier_buttons);
			//$yy = array_values($xx);
			//$yy = array_keys($frontier_buttons);
			//$yy = array_values($xx);
			
			//print_r("--standard cleaned buttons:");
			//print_r($yy);
			//print_r("</br>");
			
			print_r("--Used buttons:");
			print_r($used_buttons);
			print_r("</br>");
			
			print_r("--Unused buttons:");
			print_r($not_used_buttons);
			print_r("</br>");
			*/
				
			
			//build 20 button placeholders for each tool bar
			for ($x=0; $x<=19; $x++)
				{
				?><tr><?php
				
				//loop through the 6 toolbars
				for ($b=0; $b<=4; $b++)
					{
					$tmp_value = "";
					if( (!isset($stdbuttons[$b])) || (!is_array($stdbuttons[$b])) )
						$stdbuttons[$b] = array();
						
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
					
					//for teeny simple editor, only standard buttons are available
					if ($b<=3)
						$dropdown_buttons = $frontier_buttons;
					else
						$dropdown_buttons = $frontier_teeny_buttons;
					?>
					<td>
					<select  id="<?php echo $tmp_name ?>" name="<?php echo $tmp_name ?>" >
						<?php foreach($dropdown_buttons as $id => $desc) : ?>   
								<option value='<?php echo $id ?>' <?php echo ( $id == $tmp_value) ? "selected='selected'" : ' ';?>>
									<?php echo $desc; ?>
								</option>
							<?php endforeach; ?>
							</select>
					</td>
					<?php
					
					//Remove the button from the unused buttons for later display
					if ($b<=3)
						unset($not_used_full[$tmp_value]);
					if ($b<=4)
						unset($not_used_teeny[$tmp_value]);
					
					}
				?></tr><?php
				
				
				}
				
			
			?>
			
			</table>
			<?php
			
			/*
			print_r("--Unused buttons full:--");
			print_r(implode(", ", array_values($not_used_full)));
			print_r("</br>");
			print_r("--Unused buttons teeny:--");
			print_r($not_used_teeny);
			print_r("</br>");
			*/
			
			?>
			<br/>
			<table border="1">
				<tr>
					<td><?php _e("Full editor unused buttons"); ?></td>
					<td><?php echo(implode(", ", array_values($not_used_full))); ?></td>
				</tr><tr>
					<td><?php _e("Simple editor unused buttons"); ?></td>
					<td><?php echo implode(", ", array_values($not_used_teeny)); ?></td>
				</tr>
			</table>
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