<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * Sandbox / Test Mode
 * -------------------------
 * TRUE means you'll be hitting PayPal's sandbox/test servers.  FALSE means you'll be hitting the live servers.
 */
$config['Sandbox'] = TRUE;

/* 
 * PayPal API Version
 * ------------------
 * The library is currently using PayPal API version 98.0.  
 * You may adjust this value here and then pass it into the PayPal object when you create it within your scripts to override if necessary.
 */
$config['APIVersion'] = '98.0';

/*
 * PayPal Gateway API Credentials
 * ------------------------------
 * These are your PayPal API credentials for working with the PayPal gateway directly.
 * These are used any time you're using the parent PayPal class within the library.
 * 
 * We're using shorthand if/else statements here to set both Sandbox and Production values.
 * Your sandbox values go on the left and your live values go on the right.
 * 
 * You may obtain these credentials by logging into the following with your PayPal account: https://www.paypal.com/us/cgi-bin/webscr?cmd=_login-api-run
 */
$config['APIUsername'] = $config['Sandbox'] ? 'nadeem.sheensol_api1.gmail.com' : 'PRODUCTION_USERNAME_GOES_HERE';
$config['APIPassword'] = $config['Sandbox'] ? '1363069087' : 'PRODUCTION_PASSWORD_GOES_HERE';
$config['APISignature'] = $config['Sandbox'] ? 'Am8wo0GY9Cw5oRGt3RMsdgprz.gOABMVCEJaYe8aaWs6qcWYJHWCtyKv' : 'PRODUCTION_SIGNATURE_GOES_HERE';



/* End of file paypal.php */
/* Location: ./system/application/config/paypal.php */