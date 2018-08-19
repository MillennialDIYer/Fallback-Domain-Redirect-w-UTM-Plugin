Installation
------------
1. Download the Fallback Domain Redirect with UTM plugin folder from the [main page](https://github.com/MillennialDIYer/Fallback-Domain-Redirect-w-UTM-Plugin).
2. Upload the compressed folder named `fallback-domain-redirect-w-UTM-master` to the `/user/plugins` folder in your YOURLS installation. 
3. Extract the contents of the compressed folder. Rename the decompressed folder as `Fallback-Domain-Redirect-w-UTM-Plugin` (remove `-master` from the end). Finally, you can delete the initial compressed folder.
4. Move the ` index.html` file to the root directory of your domain, if you also want the homepage to redirect. 
5. Go to the Plugins administration page ( *eg*.: `http://sho.rt/admin/plugins.php` ) and activate the plugin.
6. Go to the Plugin's settings page and configure it. At minimum, selecting a fallback domain is required for the plugin to function. Selecting UTM parameters is completely optional and unrequired.
7. Start using it and get on with your life.

### Requirements
1. This plugin was built on YOURLS v1.7.2.
2. This plugin will work best with PHP 5.4 or greater.
3. This plugin will NOT work if YOURLS is installed in a subfolder.

For more details, see:
https://github.com/MillennialDIYer/Fallback-Domain-Redirect-w-UTM-Plugin
