=== Maintenance Redirect ===
Contributors: petervandoorn,jfinch3
Tags: maintenance,503,redirect,developer
Requires at least: 4.6
Tested up to: 5.2.2
Requires PHP: 5.2.4
Stable tag: 1.5.3
Text Domain: jf3-maintenance-mode
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to specify a maintenance mode message or HTML page for your site as well as configure settings to allow specific users to bypass the maintenance mode functionality in order to preview the site prior to public launch, etc.

== Description ==
This plugin is intended primarily for designers / developers that need to allow clients to preview sites before being available to the general public or to temporarily hide your WordPress site while undergoing major updates.

Any logged in user with WordPress administrator privileges will be allowed to view the site regardless of the settings in the plugin

The behaviour of this can be enabled or disabled at any time without losing any of settings configured in it’s settings pane. However, deactivating the plugin is recommended versus having it activated while disabled.

When redirect is enabled it can send 2 different header types. “200 OK” is best used for when the site is under development and “503 Service Temporarily Unavailable” is best for when the site is temporarily taken offline for small amendments. If used for a long period of time, 503 can damage your Google ranking.

A list if IP addresses can be setup to completely bypass maintenance mode. This option is useful when needing to allow a client’s entire office to access the site while in maintenance mode without needing to maintain individual access keys.

Access keys work by creating a key on the user’s computer that will be checked against when maintenance mode is active. When a new key is created, a link to create the access key cookie will be emailed to the email address provided. Access can then be revoked either by disabling or deleting the key.

This plugin allows three (3) methods of notifying users that a site is undergoing maintenance:

  1. They can be presented with a message on a page created by information entered into the plugin settings pane.

  2. They can be presented with a custom HMTL page.

  3. They can be redirected to a static page. This static page will need to be uploded to the server via FTP or some other method. This plugin DOES NOT include any way to upload the static page file.


== Installation ==
1. Upload the `jf3-maintenance-mode` folder to your plugins directory (usually `/wp-content/plugins/`).

2. Activate the plugin through the `Plugins` menu in WordPress.

3. Configure the settings through the `Maintenance Redirect` Settings panel.


== Frequently Asked Questions ==
= Why don’t you have any FAQs? =

Ask me a FAQ and I’ll tell you no lies.


== Screenshots ==
1. Settings

== Changelog ==
= 1.6 (coming soon) =
* Ability to set user capability to allow logged-in users to bypass redirect.

= 1.5.3 =
* Fixed ability to set IP address using Class C wildcard (eg, 192.168.0.*) - thanks to @tsouts for bringing that to my attention.

= 1.5.2 =
* Tiny translation tweak

= 1.5.1 =
* Phooey! Found a couple of translation strings that I missed on the previous commit!

= 1.5 =
* Now translatable! I’m a typical Englishman who doesn’t speak any other language, so at time of release there aren’t any translation packs available. However, if you’re interested in contributing, just pop over to https://translate.wordpress.org/ and get translating!
* Minimum WordPress requirement now 4.6 due to usage of certain translation bits & bobs.

= 1.4 =
* Plugin taken over by @petervandoorn due to being unmaintained for over 4 years. 
* Changed name to Maintenance Redirect
* Setting added to choose whether to return 200 or 503 header
* Added nonces and other, required, security checks
* General code modernisation

= 1.3 =
* Updated to return 503 header when enabled to prevent indexing of maintenance page. 
* Also, wildcards are allowed to enable entire class C ranges. Ex: 10.10.10.*
* A fix affecting some installations using a static page has been added. Thanks to Dorthe Luebbert.

= 1.2 =
* Fixed bug in Unrestricted IP table creation.

= 1.1 =
* Updated settings panel issue in WordPress 3.0 and moved folder structure to work properly with WordPress auto install.

= 1.0 =
* First release. No Changes Yet.

== Upgrade Notice ==
Now translatable!