<?php
/*
Plugin Name: Fallback Domain Redirect with UTM
Plugin URI:  https://github.com/MillennialDIYer/Fallback-Domain-Redirect-w-UTM-Plugin
Description: This plugin wildcard-redirects any incoming URL paths to a fallback domain, in case there isn't a match for your short URL.
             If set up, it is also capable of adding UTM parameters in the process.
             This allows the short domain to be used as an alternative for any existing URL at the fallback domain.
             NOTE - This plugin does NOT work if YOURLS is installed in a subfolder.
Version:     1.0
Author:      Millennial DIYer
Author URI:  https://MillennialDIYer.com
*/

// Die if no direct call to stop external access to file
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// Save URI present in yourls-loader.php via the fdr_save_uri() function
yourls_add_action( 'pre_load_template', 'fdr_save_uri' );
function fdr_save_uri()
{
    session_start();  // Start session to conserve incoming URL path across pages
    $_SESSION[ 'fdr_loader_uri' ] = $_SERVER['REQUEST_URI'] ;
}


// Run the fallback domain redirect if the keyword is not found
yourls_add_action( 'redirect_keyword_not_found', 'fdr_fallback_redirect' );

// Run the fallback domain redirect if the loader fails to load (unexpected characters in URI, etc)
yourls_add_action( 'loader_failed', 'fdr_fallback_redirect' );

// fdr_fallback_redirect is the function that redirects the inexistent URL path to the fallback domain
function fdr_fallback_redirect()
{
    // Check if the plugin is active and a fallback domain set. If so, perform the redirect.
    if( yourls_is_active_plugin( 'fallback-domain-redirect-w-utm/plugin.php' ) && ( yourls_get_option( 'fdr_fallback_dom' ) != "" ) )
    {  
        // Check if a session is already started, and if not, start one
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        // Get the values for the fallback domain and UTM parameters from the database
        $fdr_fallback_dom = yourls_get_option( 'fdr_fallback_dom' );
        $fdr_utm_param = yourls_get_option( 'fdr_utm_param' );
        
        // Retrieve incoming URL path via the value saved in the session
        $mod_uri = $_SESSION[ 'fdr_loader_uri' ];
        
        // Check if UTM Parameters are actually set
        if ( $fdr_utm_param != "" )
        {
            // Checks if the incoming URL path already contained a query string
            if ( strpos( $mod_uri, '?' ) === false )
            {
                // If there was no query string, make sure there's a slash and add a '?' at the end to start one.
                $mod_uri = rtrim( $mod_uri , "/" ) . "/" ;
                $mod_uri = $mod_uri . '?' . $fdr_utm_param ;
            }
            else
            {
                // If there already was a query string, remove the existing UTM Parameters if any, and append the UTM Parameters
                $mod_uri = preg_replace( '/&?utm_.+?(&|$)$/', '', $mod_uri ); 
                $mod_uri = $mod_uri . '&' . $fdr_utm_param ;
            }    
            
        }
        
        // Append the initial request plus UTM Parameter to the fallback domain
        $fdr_fallback_url = $fdr_fallback_dom . $mod_uri; 
         
        // Redirect to the fallback domain
        yourls_redirect( $fdr_fallback_url, 301 ); // Choose redirect type here.
    }  
}


// Register plugin config page
yourls_add_action( 'plugins_loaded', 'fdr_config_add_page' );
function fdr_config_add_page()
{
    // parameters: ( page slug, page title, page display function )
    yourls_register_plugin_page( 'fallback_url_config', 'Fallback Domain Redirect with UTM Parameters', 'fdr_config_do_page' );
}
    
// Display Plugin Configuration Page
function fdr_config_do_page()
{
    // Submit values on button press
    if( isset( $_POST['submit'] ) )
        fdr_config_update_option();
    
    // Get values from the database
    $fdr_fallback_dom = yourls_get_option( 'fdr_fallback_dom' );
    $fdr_utm_param = yourls_get_option( 'fdr_utm_param' );
    $fdr_utm_source = yourls_get_option( 'fdr_utm_source' );
    $fdr_utm_medium = yourls_get_option( 'fdr_utm_medium' );
    $fdr_utm_campaign = yourls_get_option( 'fdr_utm_campaign' );

    // Create a mock-up redirect for example purposes.
    $fdr_example = $fdr_fallback_dom;
    if ( $fdr_fallback_dom == "" )
        $fdr_example = "Please set up a fallback domain first";
    elseif ( ( $fdr_utm_param != "" ) )  // testing without ( $fdr_fallback_dom != "" ) && 
        $fdr_example = $fdr_fallback_dom . "/?" . $fdr_utm_param ;
    
    // Settings Form    
    echo <<<HTML
    <h2><center>Fallback Domain Redirect with UTM Parameters - Plugin Configuration</center></h2>
    <hr>
    <h3>Fallback Domain</h3>
    <p>Here you can configure the domain to wildcard-redirect to, used in cases where a keyword doesn't exist in the database. This plugin will not function without a fallback domain configured. 
    Once it is set, any inexistent folders, files or URL paths will automatically be redirected to the equivalent location at the fallback domain.</p>
    <form method="post" > 
    <p><label for="fdr_fallback_dom"><strong>Domain to wildcard-redirect to:</strong></label> <input type="text" id="fdr_fallback_dom" name="fdr_fallback_dom" value="$fdr_fallback_dom" size="40" /></p>
    <p><strong>Note</strong> - Please include protocol. For example: <strong>https://</strong>example.com </p>
    <hr>
    <h3>UTM Parameters - Optional</h3>
    <p>The purpose of the following UTM parameters is simply added information in <a href="https://support.google.com/analytics/answer/1033863#parameters">Google Analytics</a>. Its use is completely optional.
    If you don't use Google Analytics, just leave all the boxes empty.</p>
    <p><label for="fdr_utm_source"><strong>utm_source=</strong></label> <input type="text" id="fdr_utm_source" name="fdr_utm_source" value="$fdr_utm_source" size="40" /></p>
    <p><label for="fdr_utm_medium"><strong>utm_medium=</strong></label> <input type="text" id="fdr_utm_medium" name="fdr_utm_medium" value="$fdr_utm_medium" size="40" /></p>
    <p><label for="fdr_utm_campaign"><strong>utm_campaign=</strong></label> <input type="text" id="fdr_utm_campaign" name="fdr_utm_campaign" value="$fdr_utm_campaign" size="40" /></p>
    <p><strong>Note</strong> - To use UTM parameters, you must have first set a fallback domain above. Also, if you choose to set UTM parameters, only <em>utm_source</em> is truly necessary. 
    The rest are encouraged but not required. You can/should leave the medium or campaign boxes blank if they do not fit your scenario. However, you cannot configure the other UTM parameters without setting a <em>utm_source</em>.</p>
    <hr>
    <p><strong>Redirection example:</strong></p>
    <center><p><em>$fdr_example</em></p></center>
    <hr>
    <center><p><input type="submit" value="Update values" name="submit" /></p></center>
    </form>
HTML;
}


// Update the plugin settings in the database with the values from the settings form
function fdr_config_update_option()
{
    // Retrieve, validate and store the fallback domain.
    $in1 = $_POST[ 'fdr_fallback_dom' ];
    $in1 = strval( $in1 );  // Validate as a string
    $in1 = trim( $in1 );    // Trim whitespace from both sides of the domain
    yourls_update_option( 'fdr_fallback_dom', $in1 );
    
    // Retrieve and validate the utm_source, if any     
    $in2 = $_POST[ 'fdr_utm_source' ];
    $in2 = strval( $in2 );  // Validate as a string
    $in2 = trim( $in2 );    // Trim whitespace from both sides
    
    // If utm_source is null, erase all utm parameters
    if ( $in2 == "")
    {
        // Set all utm parameters to empty in the database
        yourls_update_option( 'fdr_utm_source', "" );
        yourls_update_option( 'fdr_utm_medium', "" );
        yourls_update_option( 'fdr_utm_campaign', "" );
        $fdr_utm_param = "";
    }
    elseif ( $in2 != "" )
    {
        // If utm_source isn't null, update the database value
        yourls_update_option( 'fdr_utm_source', $in2 );
        
        // Store the variable with the utm_source prefix
        $fdr_utm_param = 'utm_source='.$in2;
        
        // Retrieve and validate the utm_medium, if any     
        $in3 = $_POST[ 'fdr_utm_medium' ];
        $in3 = strval( $in3 );  // Validate as a string
        $in3 = trim( $in3 );    // Trim whitespace from both sides
        
        // Check if utm_medium is not null, and store accordingly    
        if ( $in3 == "")
            yourls_update_option( 'fdr_utm_medium', $in3 );
        elseif ( $in3 != "" )
        {
            yourls_update_option( 'fdr_utm_medium', $in3);
            $fdr_utm_param = $fdr_utm_param.'&utm_medium='.$in3;
        }
        
        // Retrieve and validate the utm_campaign, if any     
        $in4 = $_POST[ 'fdr_utm_campaign' ];
        $in4 = strval( $in4 );  // Validate as a string
        $in4 = trim( $in4 );    // Trim whitespace from both sides
        
        // Check if utm_campaign is not null, and store accordingly      
        if ( $in4 == "")
            yourls_update_option( 'fdr_utm_campaign', $in4 );
        elseif ( $in4 != "" )
        {
            yourls_update_option( 'fdr_utm_campaign', $in4 );
            $fdr_utm_param = $fdr_utm_param.'&utm_campaign='.$in4;
        }
    }
    // Save the assembled UTM parameter query string
    yourls_update_option( 'fdr_utm_param', $fdr_utm_param );
}

// Do not insert exit
// PHP tag left unclosed
