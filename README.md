# Fallback Domain Redirect with UTM Parameters Plugin
Description
-----------
This [YOURLS](https://github.com/YOURLS/YOURLS#readme) plugin allows your YOURLS site to work double-duty. While still allowing you to create shortlinks as normal, it also allows you to to use the domain of your link shortener as a wildcard redirect to your main site.

###  What this plugin does
- **Redirects the original URL to the fallback domain like a wildcard redirect**
- **Adds UTM parameters** (optional) - utm_source, utm_medium & utm_campaign can be set and added upon redirect to the fallback domain.
- Removes any UTM parameters if present before redirecting to the fallback domain. But only if UTM parameters are set.
- If the sho.rt keyword exists, it doesn't interfere.

##### Example

Say your main website is: https://www.BillysTenneesseEmporium.com/

On the other hand, the domain for your YOURLS domain is: https://BTEmp.com

If you're on the go, at an event or simply posting on a forum, a shorter easy-to-spell domain might be appreciated. Using this plugin, and without having to set up a shortlink before hand, you could make the following wildcard redirect:
BTEmp.com/weddings/bouquets/arrangement-[1] ↴
https://www.BillysTenneesseEmporium.com/weddings/bouquet/arrangement-[1]/?utm_source=BTEmp.com&utm_medium=YOURLS

It certainly is convenient for one-time use URLS to write on the back of a business card or whatever. The UTM source is optional and to allow the user to see how much use they're getting out of method, and to distinguish it from direct traffic.

Also, keep in mind that **you still get to keep using your YOURLS install like you always have**. This plugin doesn't interfere in any way with short links to existing keywords.

Installation
------------
1. Download the [Fallback Domain-Redirect-w-UTM  plugin](../archive/master.zip "Fallback Domain-Redirect-w-UTM  plugin")
1. Drag or move the folder named `fallback-domain-redirect-w-UTM` to the `/user/plugins` folder in your YOURLS installation. Make sure there is a file named `plugin.php` inside.
1. Move the ` index.html` file to the root directory of your domain. 
1. Go to the Plugins administration page ( *eg* `http://sho.rt/admin/plugins.php` ) and activate the plugin.
1.  Go to the Plugin's settings page and configure it. At minimum, selecting a fallback domain is required for the plugin to function. Selecting UTM parameters is completely optional an unrequired.
1. Start using it and go on with your life.

Requirements
------------
1. This plugin was built on YOURLS v1.7.2.
2. This plugin will work best with PHP 5.4 or greater

For more info
------------
For additional details on this plugin, as well as a detailed FAQ, please check the [plugin Wiki](../wiki "plugin Wiki").

License
-------
*MIT License*: In other words, do whatever you want with it. Just don't try to hold me accountable if you're unhappy with the results.

Found it useful?
------------
Consider giving the program a 'star' up there at the top, as a well-appreciated hat tip my way. And if this really solved a problem for you, you can always [donate](https://millennialdiyer.com/donate/ "donate") a buck or two. I promise that 100% of the proceeds will go directly to the furtherment of my vice fund.
