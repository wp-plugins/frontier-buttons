=== Frontier Buttons ===
Contributors: finnj
Donate link: 
Tags: frontend, frontier, wp-editor, tinymce, buttons, frontier-buttons
Requires at least: 3.9
Tested up to: 4.0
Stable tag: 1.2.1
License: GPL v3 or later
 
Control and organize the button layout of your WP editor toolbar. Adds Smileys, Table control, Search/Replace & Preview to WP Editor using tinyMCE standard plugins. Use visual editor for comments - works from WP 3.9

== Description ==

Frontier Buttons is intentionally made simple :)

= Main Features =
* Enable to design your own toolbar setup for your site.
* Enable visual editor for comments
* The following tinyMCE moduls added to Wordpresss 
** Table Control
** Smileys (emoticons)
** Search & Replace
* Only works from Wordpress version 3.9

This plugin has been created to separate the tinyMCE editor options from [Frontier Post plugin ](http://wordpress.org/plugins/frontier-post/) 

The plugin is simple with no custom js, and only enables tinyMCE standard plugins and controls - If you want a more sophisticated plugin you should look at [WP Edit plugin ](http://wordpress.org/plugins/wp-edit/) 

= Translations =
* Danish
* 

Let me know what you think, and if you have enhancement requests or problems let me know through support area

== Installation ==

1. Upload `frontier-buttons` to the `/wp-content/plugins/`  directory or search for Frontier Editor Buttons from add plugin.
2. Activate the plugin through the 'Plugins' menu in WordPress
3: Update Frontier Editor Buttons settings (settings menu)

== Frequently Asked Questions ==

= Known Issues and limitations =
* Only works from Wordpress 4

= Translations =
* Please post a link in support to translation files and I will include them in next release.

 = Cleanup =
* On deactivation: no cleanup.
* On deletion options are deleted, and role capabilities are removed.
* If you accidental delete the frontier-post plugin folder, you should:
 * Delete all options starting with frontier_buttons



== Screenshots ==

1. Editor layout with additional buttons
2. Settings page

== Changelog ==

= 1.2.1 =
* Removed error message - frontier-buttons.php line 160


= 1.2.0 =
* Will respect buttons inserted by other plugins (they will be added at the end of toolbar they were placed)
* Show unused buttons on settings page

= 1.1.0 =
* Use WP editor for comments (optional)
* Change Teeny buttons (the simple editor)

= 1.0.3 =
* Danish translation added

= 1.0.1 =
* Wrong name for settings menu - Collission with Frontier Post plugin

= 1.0.0 =
* Initial Version
* Editor buttons moved from plugin Frontier Post to separate tinyMCE functions in separate plugin



== Upgrade Notice ==
None