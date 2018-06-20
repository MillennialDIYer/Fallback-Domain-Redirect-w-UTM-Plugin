<?php
/**
 * index.php from Redirect Domain with UTM
 * Website here
 *
 * For this page to function, the 'Fallback Domain Redirect with UTM' Plugin must be active.
 * 
 * Copy this into the base/root folder of your YOURLS install.
*/

// Start YOURLS engine
require_once( dirname(__FILE__) . '/includes/load-yourls.php' );

// Save the page URI to preserve any query string.
fdr_save_uri() ;

// Run fallback domain redirection function and redirect as appropriate.
fdr_fallback_redirect() ;

exit;

// PHP tag left unclosed