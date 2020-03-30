=== Easy Cookie Law ===
Contributors: antsanchez
Tags: cookies, cookie law
Requires at least: 4.0
Requires PHP: 5.6
Tested up to: 5.2.4
Stable tag: 3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy Cookie Law helps you to easily comply with the European cookie law. It shows a customizable notice to the user until he accepts or declines the use of cookies in your website.

== Description ==

Easy Cookie Law helps you to easily comply with the European cookie law. It shows a customizable notice to the user until he accepts or declines the use of cookies in your website. 
The message, position, and style of this notice can be easily modified through the plugin menu.

This plugin is good for your SEO since it will not add any CSS stylesheet or Javascript file. Everything is inline and kept to a minimum (<2KB).

It is also totally compatible with any cache plugin since only JavaScript code is responsible checking if the user already accepted the use of cookies, to show and to hide the banner, without any use of PHP, so your websites can be cached to HTML without a problem.  

If you use Google Tag Manager, you can put the required scripts on your website directly with this plugin. 

**For detailed information see [Easy Cookie Law WordPress Plugin](https://antsanchez.com/apps/easy-cookie-law-wordpress-plugin/)**.

== Installation ==

1. Upload 'easy-cookie-law' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin throught Settings -> Easy Cookie Law

== Frequently Asked Questions ==

= How does it work? =

When a user visits your site, the plugin will check if this user has already accepted the use of cookies, (using a session cookie). If the user has not this cookie, a message will be shown (you can configure where, how and what will be shown). If the users keep surfing
in your web, now or within the next month, it means that he accepted the use of cookies in your website, so this message will not be shown again.

**For detailed information see [Easy Cookie Law WordPress Plugin](https://antsanchez.com/apps/easy-cookie-law-wordpress-plugin/)**.

= Why am I not seeing the message? =

Probably, you already have visited the site before, so you accepted the use of cookies and the plugin installed a cookie in your browser to know it. If you want to test if the plugin is working properly, try removing the cookies of your web browser or navigating in incognito mode.

**For detailed information see [Easy Cookie Law WordPress Plugin](https://antsanchez.com/apps/easy-cookie-law-wordpress-plugin/)**.

= How do I block some scripts of loading or using cookies until cookes are accepted =

If you are using Google Tag Manger, you just have to put the code on your website using our Plugin (go to Settings -> Easy Cookie Law).
If you are usiny any other scripts, you can wrap them within the JavaScript function `ecl_is_cookie_accepted()` like this:

`<script>
    if(ecl_is_cookie_accepted()){
        .. your JS Code here ..
    }
</script>`

Please, make sure you are calling this function somwhere after after the `wp_head()` WordPress function. For instance, you can use it within the `<body></body>` tags. 

If this JavaScript code is not working or you prefer to use PHP code, you can also use this function within your theme:

`<?php if(function_exists('ecl_is_cookie_accepted') && ecl_is_cookie_accepted()): ?>
    .. your JS Code here ..
<?php endif; ?>`

== Screenshots ==

1. Easy Cookie Law Options Menu

== Changelog ==

= 3.0 =
* Added option to decline cookies
* Improved management of cookies, scripts and notice

= 2.9 =
* Fixed bug on accepting on scroll

= 2.8 =
* Added accepting cookies on scroll

= 2.7 =
* Close notice without reloading

= 2.6 =
* Added more styling options

= 2.5 =
* Added textarea for custom styles

= 2.4 = 
* Added check of user roles
* Fixed some PHP Warnings (Thanks to [Łukasz Muchlado](https://bapro.pl))

= 2.3 = 
* Fixed some small JavaScript bugs

= 2.2 = 
* Added support for Google Tag Manager
* Added some translations

= 2.1 =
* Bug fix on JavaScript 
* Refactoring of code
* Link target option added

= 2.0 =
* Minor JavaScript improvements

= 1.9 =
* Bug fix on php version

= 1.8 =
* Some minor bug fixes

= 1.7 =
* Bugfix in output string (Thanks to [Giomba](www.ilgiomba.it))

= 1.6 =
* Updated to WordPress v4.9

= 1.5 =
* Updated to WordPress v4.6

= 1.4 =
* Updated to WordPress v4.3

= 1.3 =
* Updated to WordPress v4.2.1

= 1.0 =
* First published version.
