<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


$config['stripe']['mode'] = 'test'; // test or live
$config['stripe']['sk_test'] = 'sk_test_ZB6rrbObArTsMGGikfe7fAQV';
$config['stripe']['pk_test'] = 'pk_test_xPZWkOwAOn3NQjrBINmr62fk';

$config['stripe']['sk_live'] = 'sk_live_37aO3tlEfO1hQ8FHugBavSro';
$config['stripe']['pk_live'] = 'pk_live_ptSeGbEXSyvqpDSHvaVhUOLB';
$config['stripe']['currency'] = 'EUR';


// Configuration options for CurlStripe
$config['stripe_key_test_public'] = 'pk_test_xPZWkOwAOn3NQjrBINmr62fk';
$config['stripe_key_test_secret'] = 'sk_test_ZB6rrbObArTsMGGikfe7fAQV';


$config['stripe_key_live_public'] = 'pk_live_3T39Obfaxx3twJTSa5yj5HqM';
$config['stripe_key_live_secret'] = 'sk_live_6eaiwFf6HpYiT6DQATGFQHNl';


$config['stripe_test_mode'] = TRUE;
$config['stripe_verify_ssl'] = FALSE;
$config['stripe_currency'] = 'EUR';
$config['stripe_decode'] = TRUE;
