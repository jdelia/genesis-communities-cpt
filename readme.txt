===Genesis Communities CPT===

Contributors: JDELIA
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WRXXR5TR8NXQW
Tags: genesis, real estate, genesis framework, communities, towns, portfolio, custom post type
Requires at least: 4.0.0
Tested up to: 4.2.2
Stable tag: 0.6.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin adds a Community Custom Post Type to a Genesis Child theme, similar to the one in the **Winning Agent Pro theme by Carrie Dils**. You can change the name of the custom post type and the name of the slug, making this a very versatile plugin. Easily rename it to Portfolio, Projects, Towns, Cities, Neighborhoods, etc. Includes a widget to display your custom post type. Archive page settings includes changing the name of the slug, and some nice sorting options.

**Note: This plugin requires the Genesis Framework.**

**CUSTOM POST TYPE NAME AND SLUG**

You can choose the name you want to use for the slug URL under Communities -> Settings. It defaults to ‘communities’.
 
You can also change the  singular and plural name of the custom post type. For example if Towns make more sense for you, you can change the singular name to ‘Town’, plural name to ‘Towns’ and the slug to ‘towns’. This makes this plugin versatile as it can be used outside of real estate. Other uses, portfolio, projects, etc.

See example site: [Genesis Sample Theme](http://communities.savvyjackie.com/)

**STYLESHEET**

A stylesheet is included and if you prefer to use your own stylesheet, you can deregister it under Communities -> Settings. This deactivates the stylesheet. You may copy the css styles from the awp-communities.css file in the css folder of the plugin directory and paste them in your theme’s stylesheet.

**FEATURED COMMUNITIES WIDGET**

Adds a widget for sidebar or for using on the home page. Includes a random sort option, along with sorting by title, date, post_id, and menu_order. Option to include page title, the featured image with choice of sizes, and whether to include any content. CSS is style for using this widget in the sidebar and on the home page.

**COMMUNITY ARCHIVE PAGE**

Lots of sorting options for this page. Choose them in the Communities -> Settings page. Defaults to sorting by title (ascending A-Z).

See example site: [Genesis Sample Theme Archive Page](http://communities.savvyjackie.com/neighborhoods/)

Will display communities four across on desktop and responsive for smaller viewport widths. (This keeps page load times fast). Includes a random sort option, along with sorting by title, date, post_id, and menu_order. You can change the number of posts per page in the Communities -> Settings page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Make sure you have the Genesis Framework installed and a Genesis Child theme active.
2. Upload the entire `genesis-communities-cpt` folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. That's it! You can enter your Archive Page settings under Communities -> Archive Settings.
5. You can change the name of the slug in Communities -> Settings. 

== Frequently Asked Questions ==

= Does this plugin require the Genesis Framework? =

Yes. Install the plugin into your active Genesis Child theme.

= How do I know if the plugin is working? =

Look in your Dashboard under Comments for a house icon with the name of your custom post type (Defaults to Communities).

= Is this plugin translation ready? =

Yes. The code is in place.


== Screenshots ==
1. Sample home page using the Genesis Communities CPT Widget.
2. Sample Archive page for Genesis Communities CPT.
3. Sample Detail page for Genesis Communities CPT.

==Changelog==

= 0.6.3 =
Removed erroneous test message.

= 0.6.2 =
Added check to make sure Genesis is still active and if not, deactivate the plugin.

= 0.6.1 =
Removed test code message on some pages.

= 0.6.0 =
Updated plugin for translations. New features added for archive page. Some file names were changed.

= 0.5.2 =
Stylesheet changes for font sizes and removing borders on single page post display.

= 0.5.1 =
Updated code in functions.php to fix bug that displayed featured image on all single posts instead of just the ‘awp-community’ custom type posts.

= 0.5.0 =
Plugin renamed to Genesis Communities CPT. New Github location. https://github.com/savvyjackie/genesis-communities-cpt

Still need to add support for languages and test.

= 0.4.3 =
Bug fix if any of the fields are empty to reset to default on settings page. Setting pages now shows current version number.

= 0.4.2 =
Bug fix - uncommented code to update option on init. 

= 0.4.1 =
Fixed bug in awp-settings.php missing slug variable on initial load.

= 0.4.0 =
Added support to change the name of the custom post type.

= 0.3.2 =
Updated plugin with function prefix to avoid conflicts. Updated Readme.txt and instructions.

= 0.2.2 =
Initial Release.

==Upgrade Notice==

= 0.6.3 =
Bug fix. Removed erroneous test message.

= 0.6.2 =
Bug fix. Automatically deactivate plugin, if the Genesis theme is deactivated.

= 0.6.1 =
Bug fix. Removed test code message on some pages.

= 0.6.0 =
Updated plugin for translations. New features added for archive page. Some file names were changed.

= 0.5.2 =
Contains corrections and enhancements to the stylesheet.

= 0.5.1 =
Contains bug fixes and enhancements since initial release.

= 0.2.2 =
Initial Release.
