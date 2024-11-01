=== Wikipedia for tag pages ===
Contributors: Haldaug
Donate link: 
Tags: wikipedia, tags, api
Requires at least: 2.3
Tested up to: 3.6
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget that displays excerpts from Wikipedia articles relevant to the tag on tag-pages. Support for multiple languages. 

== Description ==

This plugin creates a widget that displays excerpts from Wikipedia on the tag pages (the template tag.php). The user can specify multiple languages for the plugin to query using the Wikipeida API. The language that has an article that matches the tag has its article displayed.

== Installation ==

1. Unzip the 'wikipedia-tags.zip' file
2. Upload the folder `wikipedia-for-tags` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Use the widget control panel to place the widget in your sidebars.

== Frequently asked questions ==

= Does the plugin support articles in all languages? =

Yes. The user can specify the languages the plugin should search through. 

= Does the widget show up on other pages than tag pages? =

No, the widget checks to see if it is being displayed on a tag page using the conditional tag is_tag(). 

== Screenshots ==

1. Widget displayed on tag page
2. Widget options

== Changelog ==

= 1.4 =
Added support for the 'before_widget', 'after_widget', 'before_title' and 'after_title' arguments.

= 1.3 =
Added cahcing on client and server sides.

= 1.2 =
Changed to widget title to correspond to the standard <h2> tag.

= 1.1 =
Added some simple styling

= 1.0 =
Stable release

== Upgrade notice ==

= 1.4 =
Added support for the 'before_widget', 'after_widget', 'before_title' and 'after_title' arguments. Update your css file accordingly.

= 1.3 =
Caching on client and server side reduces load on your site and wikipedia.

= 1.2 =
Changed to widget title to correspond to the standard <h2> tag. Make sure you change your css markup accordingly.

= 1.0 =
Stable release

== Credits ==

This widget is based on the Wordpress-Wikipedia-Widget by patlockley: [Wordpress-Wikipedia-Widget](https://github.com/patlockley/WordPress-Wikipedia-Widget)