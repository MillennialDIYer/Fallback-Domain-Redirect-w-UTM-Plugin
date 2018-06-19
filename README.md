# Fallback Domain Redirect with UTM Parameters Plugin
This light-weight plugin for [YOURLS](https://github.com/YOURLS/YOURLS#readme) allows your link-shortener to work double-duty. While still allowing you to create shortlinks as normal, it also allows you to use the domain of your link shortener as a wildcard redirect to your main site, without having to set up the link before hand. It will redirect links automatically.

What this plugin does
------------
- **Redirects the original URL to the fallback domain like a wildcard redirect**.
- Optional - **Adds UTM parameters** - utm_source, utm_medium & utm_campaign can be added upon redirect to the fallback domain.
- Optional - Removes any UTM parameters if present before redirecting to the fallback domain.
- If the sho.rt keyword exists, it doesn't interfere. You can keep using your link shortener as you always have.

### Example

Say your main WordPress website or store is: https://www.BillysTenneesseEmporium.com/

On the other hand, the domain for your YOURLS domain is: https://BTEmp.com

If you're on the go, at an event or simply posting on a forum, a shorter easy-to-spell domain might be appreciated. Using this plugin, and without having to set up a shortlink before hand, you could make the following wildcard redirect:
[BTEmp.com/weddings/bouquets/arrangement-[1]](BTEmp.com/weddings/bouquets/arrangement-[1]) Auto-redirects to ↴

https://www.BillysTenneesseEmporium.com/weddings/bouquet/arrangement-[1]

Or, it can also add [UTM parameters](https://en.wikipedia.org/wiki/UTM_parameters) to redirect to:

https://www.BillysTenneesseEmporium.com/weddings/bouquet/arrangement-[1]/?utm_source=BTEmp.com&utm_medium=yourls&utm_campaign=business_ard

It certainly is convenient for one-time use URLS to write on the back of a business card or whatever. Or even just for your own use as as an abbreviation for any page on your website. If you're just using your short domain to make shortlinks for your WordPress site, this plugin is a great way to make YOURLS even more versatile! Plus it's easy and free.

Also, keep in mind that **you still get to keep using your YOURLS install like you always have**. This plugin doesn't interfere in any way with short links to existing keywords.

### Why add UTM Parameters?

It's just the cherry on top. You don't have to use them if they don't provide any value to you. It's purpose is to distinguish people using that link from direct traffic. If you want to know how much use you're getting out of these redirects, you'd be able to see how many people clicked or typed-in your short link. This will help you better assess if the cost and hassle of maintaining an extra domain is worth it, as well as just for your own statistical purposes. There is little to no downside to using them, and the UTM parameters will dissappear from the URL as soon as the visitor clicks any link on your site.

Installation
------------
1. Download the [Fallback Domain-Redirect-w-UTM  plugin](../archive/master.zip "Fallback Domain-Redirect-w-UTM  plugin")
1. Drag or move the folder named `fallback-domain-redirect-w-UTM` to the `/user/plugins` folder in your YOURLS installation. Make sure there is a file named `plugin.php` inside.
1. Move the ` index.html` file to the root directory of your domain, you want the homepage to also redirect. 
1. Go to the Plugins administration page ( *eg* `http://sho.rt/admin/plugins.php` ) and activate the plugin.
1. Go to the Plugin's settings page and configure it. At minimum, selecting a fallback domain is required for the plugin to function. Selecting UTM parameters is completely optional and unrequired.
1. Start using it and go on with your life.

### Requirements
1. This plugin was built on YOURLS v1.7.2.
2. This plugin will work best with PHP 5.4 or greater

For more info
------------
For additional details on this plugin, as well as a detailed FAQ, please check the [plugin Wiki](../wiki "plugin Wiki").

License
-------
*MIT License* - In other words, do whatever you want with it. Just don't try to hold me accountable if you're unhappy with the results.

Found it useful?
------------
Consider giving the program a 'star' up there at the top, as a well-appreciated hat tip my way. And if this really solved a problem for you, you can always [donate](https://millennialdiyer.com/donate/ "donate") a buck or two. I promise that 100% of the proceeds will go directly to the furtherment of my vice fund.
