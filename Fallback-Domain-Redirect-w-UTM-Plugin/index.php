<?php
/* index.php from 'Fallback Domain Redirect with UTM' Plugin for YOURLS.
 * https://github.com/MillennialDIYer/Fallback-Domain-Redirect-w-UTM-Plugin/
 *
 * Copy this into the base/root folder of your YOURLS install.
 * For this page to function, the 'Fallback Domain Redirect with UTM' Plugin must be active, and a fallback domain saved in the settings.
*/

// Start YOURLS engine
require_once( dirname(__FILE__) . '/includes/load-yourls.php' );

// Save the incoming URL path to preserve any query string.
fdr_save_uri() ;

// Run fallback domain redirection function and redirect as appropriate.
fdr_fallback_redirect() ;

exit;

// PHP tag left unclosed
