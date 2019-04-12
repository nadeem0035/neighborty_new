<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


$config['stripe']['mode'] = 'test'; // test or live
$config['stripe']['sk_test'] = '';
$config['stripe']['pk_test'] = '';

$config['stripe']['sk_live'] = '';
$config['stripe']['pk_live'] = '';
$config['stripe']['currency'] = 'EUR';


// Configuration options for CurlStripe
$config['stripe_key_test_public'] = '';
$config['stripe_key_test_secret'] = '';


$config['stripe_key_live_public'] = '';
$config['stripe_key_live_secret'] = '';


$config['stripe_test_mode'] = TRUE;
$config['stripe_verify_ssl'] = FALSE;
$config['stripe_currency'] = 'EUR';
$config['stripe_decode'] = TRUE;
