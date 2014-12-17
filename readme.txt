=== Frontier Buttons ===
Contributors: finnj
Donate link: 
Tags: frontend, frontier, wp-editor, tinymce, buttons, frontier-buttons
Requires at least: 3.4
Tested up to: 4.1
Stable tag: 1.3.4
License: GPL v3 or later
 
Control and organize the button layout of your WP editor toolbar. Adds Smileys, Table control, Search/Replace & Preview to WP Editor using tinyMCE standard plugins. Use visual editor for comments

== Description ==

Frontier Buttons is intentionally made simple :)

NEW: Support for Wordpress versions before 3.9

= Main Features =
* Enable to design your own toolbar setup for your site.
* Enable visual editor for comments
* The following tinyMCE moduls added to Wordpresss 
** Table Control
** Smileys (emoticons)
** Search & Replace


This plugin has been created to separate the tinyMCE editor options from [Frontier Post plugin ](http://wordpress.org/plugins/frontier-post/) 

See also [Frontier Set Featured plugin ](http://wordpress.org/plugins/frontier-set-featured/) 

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
* None at the moment :)

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


= 1.3.4 =
* Disabled media button for comments editor

= 1.3.2 =
* Tested and works with Wordpres version 4.1

= 1.3.1 =
* New function: frontier_buttons_full_buttons() - Will return array with theme_advanced_buttons1-4, can be called from themes and other plugins 

= 1.3.0 =
* Support for Wordpress versions before 3.9

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