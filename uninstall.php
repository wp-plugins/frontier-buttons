<?php

/*
Used to delete options and remove capabilities when Frontier Buttons is deleted
*/

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	{
	exit ();
	}
	
	delete_option('frontier_buttons_toolbars');
	
	
	
	


?>