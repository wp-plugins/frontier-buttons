<?php
/*
Plugin Name: Frontier Buttons
Plugin URI: http://wordpress.org/plugins/frontier-buttons/
Description: Control and organize the button layout of your WP editor toolbar. Adds Smileys, Table control, Search/Replace & Preview to WP Editor using tinyMCE standard plugins. Use visual editor for comments.
Author: finnj
Version: 1.3.9
Author URI: http://wordpress.org/plugins/frontier-buttons/
*/

// define constants
define('FRONTIER_BUTTONS_VERSION', "1.3.9"); 


//*************************************************************************
// Set options on activation
//*************************************************************************

function frontier_buttons_set_defaults ()
	{
	include("frontier-buttons-defaults.php");
	$tmp_options = get_option( "frontier_buttons_toolbars");
	if( (!isset($tmp_options)) || (!is_array($tmp_options)) )
		{
		$stdbuttons  	= array( $std_frontier_buttons1, $std_frontier_buttons2, $std_frontier_buttons3, $std_frontier_buttons4, $std_frontier_buttons_teeny, $std_frontier_buttons_cmt);
		update_option("frontier_buttons_toolbars", $stdbuttons );
		}
	$tmp_options = get_option( "frontier_buttons_settings");
	if( (!isset($tmp_options)) || (!is_array($tmp_options)) )
		{
		update_option("frontier_buttons_settings", $std_frontier_settings );
		}	
	}
	
register_activation_hook( __FILE__ , 'frontier_buttons_set_defaults');



//*************************************************************************
// Load tinyMCE plugins
//*************************************************************************

function frontier_buttons_plugins () 
	{
	global $wp_version;
	if ($wp_version >= "3.9")
		{
		$tmp_tinymce_loc 	= '/frontier-buttons/tinymce/';
		$tmp_js				= '/plugin.min.js';
		}
	else
		{
		$tmp_tinymce_loc = '/frontier-buttons/tinymce3/tinymce/';
		$tmp_js				= '/editor_plugin.js';
		}
	$plugins = array('emoticons', 'table', 'searchreplace', 'preview');
	$plugins_array = array();
	foreach ($plugins as $plugin ) 
		{
		$plugins_array[ $plugin ] = plugins_url() . $tmp_tinymce_loc . $plugin . $tmp_js;
		}
	return $plugins_array;
	}
add_filter('mce_external_plugins', 'frontier_buttons_plugins');

//*************************************************************************
// Load the editor tool bars
//*************************************************************************

//   **** Toolbar 1 ****
if (!function_exists("frontier_toolbar1"))
	{
	function frontier_toolbar1( $buttons  )
		{
		// get the difference between the standard wordpress toolbar (buttons added by other plugins)
		$std_toolbar 		= array('bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'wp_more', 'spellchecker', 'fullscreen', 'wp_adv' );
		$btn_diff			= array_diff($buttons, $std_toolbar);
		/*
		error_log("std: Btn 1: ".implode(", ",$buttons));
		error_log("set Btn 1 : ".implode(", ",$std_toolbar1));
		error_log("Btn 1 diff: ".implode(", ",$btn_diff));
		*/
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		// add the diff buttons to the toolbar.
		$buttons = array_merge($tmp_options[0],$btn_diff) ; 
		return $buttons;
		}
	}
add_filter( 'mce_buttons', 'frontier_toolbar1', 99 );	

//   **** Toolbar 2 ****
if (!function_exists("frontier_toolbar2"))
	{
	function frontier_toolbar2( $buttons  )
		{
		$std_toolbar 		= array( 'formatselect', 'underline', 'alignjustify', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo', 'wp_help' );
		$btn_diff			= array_diff($buttons, $std_toolbar);
		$tmp_options = get_option("frontier_buttons_toolbars");  
		$buttons = array_merge($tmp_options[1],$btn_diff) ;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_2', 'frontier_toolbar2' );	

//   **** Toolbar 3 ****
if (!function_exists("frontier_toolbar3"))
	{
	function frontier_toolbar3( $buttons  )
		{
		$std_toolbar 		= array( );
		$btn_diff			= array_diff($buttons, $std_toolbar);
		$tmp_options = get_option("frontier_buttons_toolbars");  
		$buttons = array_merge($tmp_options[2],$btn_diff) ;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_3', 'frontier_toolbar3' );	

//   **** Toolbar 4 ****
if (!function_exists("frontier_toolbar4"))
	{
	function frontier_toolbar4( $buttons  )
		{
		$std_toolbar 		= array( );
		$btn_diff			= array_diff($buttons, $std_toolbar);
		$tmp_options = get_option("frontier_buttons_toolbars");  
		$buttons = array_merge($tmp_options[3],$btn_diff) ;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_4', 'frontier_toolbar4' );	

// *************************
//   **** teeny buttons ****
// *************************

if (!function_exists("frontier_toolbar_teeny"))
	{
	function frontier_toolbar_teeny( $buttons  )
		{
		include("frontier-buttons-defaults.php");
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		$tmp_toolbar = $tmp_options[4] ? $tmp_options[4] : $std_frontier_buttons_teeny; //teeny toolbar 
		$buttons = $tmp_toolbar;
		return $buttons;
		}
	}
add_filter( 'teeny_mce_buttons', 'frontier_toolbar_teeny' );	

//*************************************************************************
// Enable tinyMCE editor for comments
//*************************************************************************

function frontier_buttons_comments_editor( $fields ) 
	{
	$bsettings					= get_option("frontier_buttons_settings") ? get_option("frontier_buttons_settings") : $std_frontier_settings ;		
	$btn_comment_editor_enable 	= isset($bsettings['enable_comment_editor']) ? $bsettings['enable_comment_editor'] : "false";
	$btn_comments_editor_login 	= isset($bsettings['comment_editor_login']) ? $bsettings['comment_editor_login'] : "true";
	$btn_comment_editor_fix 	= array_key_exists('comment_editor_fix', $bsettings) ? $bsettings['comment_editor_fix'] : false;
	$btn_quicktags_enable		= true;
	$btn_teeny_enable			= true;
	
	if ( $btn_comment_editor_enable == "true" )
		{
		// check if user is required to be logged in to use the editor
		if (($btn_comments_editor_login == "true") && !is_user_logged_in() )
			return $fields;
		else
			{
		
		
			$btn_quicktags_enable	 	=	($bsettings['visual_editor'] == "true") ? false : true; 
			$btn_cmt_editor_lines 		=	$bsettings['editor_lines'] > 0 ? $bsettings['editor_lines'] : 5;
			// not active
			$btn_teeny_enable 			=	($bsettings['enable_teeny_editor'] == "true") ? true : false;
			
			/*
			$tmp_options = get_option("frontier_buttons_toolbars");
			$tmp_teeny_buttons  = array(
				'theme_advanced_buttons1' 	=> implode(',', $tmp_options[0]),
				);
			*/
			
			if ( array_key_exists('comment_editor_type', $bsettings) )
				$tmp_editor_type =  $bsettings['comment_editor_type'];
			else
				$tmp_editor_type = 'teeny';
			
			switch($tmp_editor_type)
				{
				case "full":  
					$tmp_args = array(
					'textarea_rows' => $btn_cmt_editor_lines,
					'media_buttons' => false,
					'quicktags'		=> false
					);	
				break;
				
				case "quicktags":  
					$tmp_args = array(
					'textarea_rows' => $btn_cmt_editor_lines,
					'media_buttons' => false,
					'quicktags'		=> true
					);
				break;
				
				default:  
					$tmp_args = array(
					'teeny' 		=> true,
					'textarea_rows' => $btn_cmt_editor_lines,
					'media_buttons' => false,
					'quicktags'		=> false,
					);
				break;
				} // end switch
			
			//error_log(print_r($tmp_teeny_buttons, true));
			ob_start();
			wp_editor( '', 'comment', $tmp_args);
			$fields['comment_field'] = ob_get_clean();
			return $fields;	
		
			} // end login check
		
		} //end visual comment editor enabled
	else
		{
		return $fields;
		}
	} // end function		
add_filter( 'comment_form_defaults', 'frontier_buttons_comments_editor' );

//******************************************************************************
// Enable fix for reply to comments not working with teeny editor
//******************************************************************************

$bsettings	= get_option("frontier_buttons_settings", array());		

if ( array_key_exists('enable_comment_editor', $bsettings) && ($bsettings['enable_comment_editor'] == "true") && array_key_exists('comment_editor_fix', $bsettings) && ($bsettings['comment_editor_fix'] == "true") )
	{		
	//error_log("Comment fix check	: ".$bsettings['comment_editor_fix']);
	
	// wp_editor doesn't work when clicking reply. Here is the fix.
	add_action( 'wp_enqueue_scripts', '__THEME_PREFIX__scripts' );
	function __THEME_PREFIX__scripts() 
		{
		wp_enqueue_script('jquery');
		}
	
	add_filter( 'comment_reply_link', '__THEME_PREFIX__comment_reply_link' );
	function __THEME_PREFIX__comment_reply_link($link) 
		{
		return str_replace( 'onclick=', 'data-onclick=', $link );
		}
	
	add_action( 'wp_head', '__THEME_PREFIX__wp_head' );
	function __THEME_PREFIX__wp_head() 
		{
	?>
	<script type="text/javascript">
	  jQuery(function($){
		$('.comment-reply-link').click(function(e){
		  e.preventDefault();
		  var args = $(this).data('onclick');
		  args = args.replace(/.*\(|\)/gi, '').replace(/\"|\s+/g, '');
		  args = args.split(',');
		  tinymce.EditorManager.execCommand('mceRemoveEditor', true, 'comment');
		  addComment.moveForm.apply( addComment, args );
		  tinymce.EditorManager.execCommand('mceAddEditor', true, 'comment');
		});
	  });
	</script>
	<?php 
		} 
	}

//******************************************************************************
// End fix 
//******************************************************************************

//*************************************************************************
// Force default visual editor
//*************************************************************************	
function frontier_buttons_default_editor() {
    if (user_can_richedit())
		return 'tinymce';
}
add_filter( 'wp_default_editor', 'frontier_buttons_default_editor' );	

//*************************************************************************
// Expose function to return editor (full editor) buttons to thee and other plugins
//*************************************************************************	

function frontier_buttons_full_buttons()
	{
	$tmp_options = get_option("frontier_buttons_toolbars");
	$tinymce_options = array(
			'theme_advanced_buttons1' 	=> implode(',', $tmp_options[0]),
			'theme_advanced_buttons2' 	=> implode(',', $tmp_options[0]),
			'theme_advanced_buttons3' 	=> implode(',', $tmp_options[0]),
			'theme_advanced_buttons4' 	=> implode(',', $tmp_options[0])
			);
	return $tinymce_options;
	}

//add_action("init","frontier_buttons_full_buttons");

		
//*************************************************************************
// Load settings menu
//*************************************************************************
include('settings-menu.php');
add_action('admin_menu', 'frontier_buttons_settings_menu');

//*************************************************************************
// Translation
//*************************************************************************
function frontier_buttons_translation() 
	{
	load_plugin_textdomain('frontier-buttons', false, dirname( plugin_basename( __FILE__ ) ).'/language');
	}
add_action('plugins_loaded', 'frontier_buttons_translation');


//*************************************************************************
// End plugin
//*************************************************************************

?>