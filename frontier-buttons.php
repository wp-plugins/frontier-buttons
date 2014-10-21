<?php
/*
Plugin Name: Frontier Buttons
Plugin URI: http://wordpress.org/extend/plugins/frontier-buttons/
Description: Adds Smileys, Table control, Search/Replace & Preview to WP Editor using tinyMCE standard plugins, from Wordpress version 4
Author: finnj
Version: 1.0.2
Author URI: http://wordpress.org/extend/plugins/frontier-buttons/
*/

// define constants
define('FRONTIER_BUTTONS_VERSION', "1.0.2"); 


//*************************************************************************
// Set options on activation
//*************************************************************************

function frontier_buttons_set_defaults ()
	{
	$tmp_options = get_option( "frontier_buttons_toolbars");
	if( (!isset($tmp_options)) || (!is_array($tmp_options)) )
		{
		include("frontier-buttons-defaults.php");
		$stdbuttons  	= array( $std_frontier_buttons1, $std_frontier_buttons2, $std_frontier_buttons3,	$std_frontier_buttons4);
		update_option("frontier_buttons_toolbars", $stdbuttons );
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
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		$tmp_toolbar = $tmp_options[0]; //toolbar 1
		$buttons = $tmp_toolbar;
		return $buttons;
		}
	}
add_filter( 'mce_buttons', 'frontier_toolbar1' );	

//   **** Toolbar 2 ****
if (!function_exists("frontier_toolbar2"))
	{
	function frontier_toolbar2( $buttons  )
		{
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		$tmp_toolbar = $tmp_options[1]; //toolbar 2
		$buttons = $tmp_toolbar;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_2', 'frontier_toolbar2' );	

//   **** Toolbar 3 ****
if (!function_exists("frontier_toolbar3"))
	{
	function frontier_toolbar3( $buttons  )
		{
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		$tmp_toolbar = $tmp_options[2]; //toolbar 3
		$buttons = $tmp_toolbar;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_3', 'frontier_toolbar3' );	

//   **** Toolbar 4 ****
if (!function_exists("frontier_toolbar4"))
	{
	function frontier_toolbar4( $buttons  )
		{
		$tmp_options = get_option("frontier_buttons_toolbars"); 
		$tmp_toolbar = $tmp_options[3]; //toolbar 4
		$buttons = $tmp_toolbar;
		return $buttons;
		}
	}
add_filter( 'mce_buttons_4', 'frontier_toolbar4' );	


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