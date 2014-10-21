<?php
//*******************************************************************************************************
//Default values for Frontier Buttons plugin
//*******************************************************************************************************

$frontier_buttons_empty	= "#empty#"; //Identifier for empty toolbar button 

$std_mce_buttons_1		= 'bold, italic, strikethrough, bullist, numlist, blockquote, alignleft, aligncenter, alignright, link, unlink, wp_more, fullscreen, hr';
$std_mce_buttons_2		= 'formatselect, underline, alignjustify, forecolor, pastetext, removeformat, charmap, outdent, indent, undo, redo, wp_help'; 
$std_mce_buttons_3		= 'fontselect, fontsizeselect, emoticons, searchreplace, table, preview';
$std_mce_buttons_4		= '';

$std_frontier_buttons1 	= array(
							'bold', 
							'italic', 
							'underline',
							'strikethrough', 
							'bullist', 
							'numlist', 
							'blockquote', 
							'alignleft', 
							'aligncenter', 
							'alignright',
							'alignjustify',
							'link', 
							'unlink',
							'wp_more', 
							'fullscreen', 
							'wp_adv'
						);

$std_frontier_buttons2 	= array(
							'formatselect', 
							'forecolor', 
							'pastetext', 
							'removeformat', 
							'charmap', 
							'outdent', 
							'indent', 
							'undo', 
							'redo', 
							'wp_help'
						);						

$std_frontier_buttons3	= array(
							'fontselect',
							'fontsizeselect',
							'backcolor',
							'emoticons',
							'searchreplace',
							'table',
							'preview',
							);
$std_frontier_buttons4	= array();

						
$frontier_buttons = array(
						'#empty#'		=> __('(Empty)', 'frontier-buttons'),
						'bold' 			=> __('Bold', 'frontier-buttons'),
						'italic' 		=> __('Italic', 'frontier-buttons'),
						'strikethrough' => __('Strike through', 'frontier-buttons'),
						'bullist'		=> __('Bullit list', 'frontier-buttons'),
						'numlist'		=> __('Numeric list', 'frontier-buttons'),
						'blockquote' 	=> __('Block quote', 'frontier-buttons'),
						'alignleft' 	=> __('Align left', 'frontier-buttons'),
						'aligncenter' 	=> __('Align center', 'frontier-buttons'),
						'alignright' 	=> __('Align right', 'frontier-buttons'),
						'link' 			=> __('Link', 'frontier-buttons'),
						'unlink' 		=> __('Un-Link', 'frontier-buttons'),
						'wp_more' 		=> __('WP More', 'frontier-buttons'),
						'wp_adv' 		=> __('Toolbar toggle', 'frontier-buttons'),
						'fullscreen' 	=> __('Full Screen', 'frontier-buttons'),
						'hr' 			=> __('HR', 'frontier-buttons'),
						'formatselect'	=> __('Format select', 'frontier-buttons'),
						'underline'		=> __('Underline', 'frontier-buttons'),
						'alignjustify'	=> __('Align justify', 'frontier-buttons'),
						'forecolor'		=> __('Forecolor', 'frontier-buttons'),
						'backcolor'		=> __('Background color', 'frontier-buttons'),
						'pastetext' 	=> __('Paste', 'frontier-buttons'),
						'removeformat'	=> __('Remove format', 'frontier-buttons'),
						'charmap'		=> __('Character map', 'frontier-buttons'),
						'outdent' 		=> __('Outdent', 'frontier-buttons'),
						'indent' 		=> __('Indent', 'frontier-buttons'),
						'undo' 			=> __('Undo', 'frontier-buttons'),
						'redo' 			=> __('Redo', 'frontier-buttons'),
						'wp_help'		=> __('WP Help', 'frontier-buttons'),
						'fontselect' 	=> __('Font select', 'frontier-buttons'),
						'fontsizeselect' => __('Font size', 'frontier-buttons'),
						'emoticons' 	=> __('Smileys', 'frontier-buttons'),
						'searchreplace'	=> __('Search Replace', 'frontier-buttons'),
						'table' 		=> __('Table', 'frontier-buttons'),
						'preview'		=> __('Preview', 'frontier-buttons')
					);

		asort($frontier_buttons);


?>