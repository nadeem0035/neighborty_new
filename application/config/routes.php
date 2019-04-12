<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['login'] = 'users/login';
$route['verification'] = 'users/confirmation';
$route['confirm'] = 'users/confirmByCode';
$route['resend-code'] = 'users/reSendCode';
$route['signup'] = 'users/register';
$route['referral'] = 'users/user_referral';
$route['users/dashboard'] = 'users/dashboard';
$route['wishlists/(:any)'] = 'wishlist/wishlists/$1';
$route['user-wishlists'] = 'wishlist/wishlist';
$route['user-wishlist/(:any)'] = 'wishlist/wishlist_detail/$1';
$route['trips/present'] = 'trips/index';


$route['listings'] = 'listings/index';
$route['sitemap'] = 'sitemap/index';

$route['city-area'] = 'listings/areasByCityId/';
$route['city-areas'] = 'listings/cityAreas/';
$route['area-sectors'] = 'listings/areasSectors/';
$route['listings/applications'] = 'listings/applications';
$route['listings/applications'] = 'listings/applications';
$route['premium-listing-request'] = 'listings/premiumListingRequest';


$route['apply'] = 'apply/index';
$route['do'] = 'apply/save_do';
$route['upload-document'] = 'apply/upload_document';
$route['save-advertisement-request'] = 'advertise/saveAdvertiseRequest';


//$route['search/MapListings'] = 'search/MapListings/$1';
$route['search/map_results/?/(:any)'] = 'search/listWithMapsAjax/$1';
$route['search/results'] = 'search/results/$1';
$route['search/(:any)'] = 'search/index/$1';
//$route['search'] = 'search/index/$1';



$route['search-with-map'] = 'search/listingsWithMap/$1';

$route['save-property'] = 'listings/postProperty';
$route['edit-property'] = 'listings/postEditProperty';

$route['property/(:any)'] = 'booking/detail/$1';
$route['contact'] = 'index/contact';
$route['default_controller'] = 'index';
$route['404_override'] = 'Error_404';
$route['translate_uri_dashes'] = true;
$route['page/stories'] = 'pages/stories';
$route['page/(:any)'] = 'pages/view/$1';
$route['agents'] = 'agents/index';
$route['user/profile/(:any)'] = 'users/user_profile/$1';
$route['agent/profile/(:any)'] = 'agents/detail/$1';
$route['packages'] = 'packages/index';
$route['agent-finder'] = 'agents/agent_finder';
$route['rent'] = 'index/rent';
$route['buy'] = 'index/rent';
$route['press/detail/(:any)'] = 'press/PressDetail/$1';

$route['claim/(:any)'] = 'claim/index/$1';
$route['claim-varification'] = 'claim/claim_varification';
$route['agent-home'] = 'index/agent_home';
$route['splash'] = 'splash/index';
$route['about-us'] = 'pages/about_us';
$route['about-us-2'] = 'pages/about_us_2';
$route['about-us-3'] = 'pages/about_us_3';
$route['search/results_map'] = 'search/results_map';

