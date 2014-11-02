<?php
/*
Plugin Name: Frontier Buttons
Plugin URI: http://wordpress.org/plugins/frontier-buttons/
Description: Control and organize the button layout of your WP editor toolbar. Adds Smileys, Table control, Search/Replace & Preview to WP Editor using tinyMCE standard plugins. Use visual editor for comments - works from WP 3.9
Author: finnj
Version: 1.2.0
Author URI: http://wordpress.org/plugins/frontier-buttons/
*/

// define constants
define('FRONTIER_BUTTONS_VERSION', "1.2.0"); 


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
	$plugins = array('emoticons', 'table', 'searchreplace', 'preview');
	$plugins_array = array();
	foreach ($plugins as $plugin ) 
		{
		$plugins_array[ $plugin ] = plugins_url() . '/frontier-buttons/tinymce/' . $plugin . '/plugin.min.js';
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
	$bsettings		= get_option("frontier_buttons_settings") ? get_option("frontier_buttons_settings") : $std_frontier_settings ;		
	$btn_comment_editor_enable 	=	$bsettings['enable_comment_editor'] ? $bsettings['enable_comment_editor'] : false;
	$btn_comments_editor_login 	=	$bsettings['comment_editor_login'] ? $bsettings['comment_editor_login'] : true;
	
	if ($btn_comment_editor_enable)
		{
		// check if user is required to be logged in to use the editor
		if (($btn_comments_editor_login == true) && !is_user_logged_in() )
			return;
		else
			{
			
			$btn_quicktags_enable	 	=	($bsettings['visual_editor'] == true) ? false : true; 
			$btn_cmt_editor_lines 		=	$bsettings['editor_lines'] ? $bsettings['editor_lines'] : 5;
			$btn_teeny_enable 			=	$bsettings['enable_teeny_editor'] ? $bsettings['enable_teeny_editor'] : false;
			$btn_comment_editor_type	=	$bsettings['comment_editor_type'] ? $bsettings['comment_editor_type'] : 'minimal-visual';
			/*
			$editor_layout		 		= array('dfw' => false, 'textarea_rows' => $btn_cmt_editor_lines  );
			$tmp = array();
			// error_log("Editor type: ");
			// error_log($btn_comment_editor_type);
			if ($btn_comment_editor_type == "full")
				{
				$custom_buttons 	= get_option("frontier_buttons_toolbars"); 
				$tinymce_options = array(
					'theme_advanced_buttons1' 	=> ($custom_buttons[0] ? $custom_buttons[0] : ''),
					'theme_advanced_buttons2' 	=> ($custom_buttons[1] ? $custom_buttons[1] : ''),
					'theme_advanced_buttons3' 	=> ($custom_buttons[2] ? $custom_buttons[2] : ''),
					'theme_advanced_buttons4' 	=> ($custom_buttons[3] ? $custom_buttons[3] : '')
					);
	
				$tmp = array('tinymce' => $tinymce_options);
				}

			if ($btn_comment_editor_type == "minimal-visual")
				$tmp = array('teeny' => true, 'quicktags' => false);
		
			if ($btn_comment_editor_type == "minimal-html")
				$tmp = array('teeny' => true, 'tinymce' => false);
		
			if ($btn_comment_editor_type == "text")	
				$tmp = array('quicktags' => false, 'tinymce' =>false);
		
			$editor_layout = array_merge($editor_layout, $tmp);
			ob_start();
			wp_editor( 
				'', 
				'comment', 
				$editor_layout
			);
			$fields['comment_field'] = ob_get_clean();
			return $fields;
			*/
			ob_start();
			wp_editor( '', 'comment', array(
			'teeny' 		=> true,
			'textarea_rows' => 5,
			'quicktags'		=> $btn_quicktags_enable
			));
			$fields['comment_field'] = ob_get_clean();
			return $fields;

			}
		}
	}		
	add_filter( 'comment_form_defaults', 'frontier_buttons_comments_editor' );



//*************************************************************************
// Force default visual editor
//*************************************************************************	
function frontier_buttons_default_editor() {
    if (user_can_richedit())
		return 'tinymce';
}
add_filter( 'wp_default_editor', 'frontier_buttons_default_editor' );	
		
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