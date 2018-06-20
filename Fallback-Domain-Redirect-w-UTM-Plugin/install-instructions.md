Installation
------------
1. Download the [Fallback Domain-Redirect-w-UTM  plugin](../archive/master.zip "Fallback Domain-Redirect-w-UTM  plugin")
2. Drag or move the folder named `fallback-domain-redirect-w-UTM` to the `/user/plugins` folder in your YOURLS installation. Make sure there is a file named `plugin.php` inside.
3. Move the ` index.html` file to the root directory of your domain, you want the homepage to also redirect. 
4. Go to the Plugins administration page ( *eg* `http://sho.rt/admin/plugins.php` ) and activate the plugin.
5. Go to the Plugin's settings page and configure it. At minimum, selecting a fallback domain is required for the plugin to function. Selecting UTM parameters is completely optional and unrequired.
6. Start using it and go on with your life.

### Requirements
1. This plugin was built on YOURLS v1.7.2.
2. This plugin will work best with PHP 5.4 or greater.
3. This plugin will NOT work if YOURLS is installed in a subfolder.