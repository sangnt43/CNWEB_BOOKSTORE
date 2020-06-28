<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['GetObjectId'] = "GetObjectId";

$route['login'] = "Auth/login";
$route['logout'] = "Auth/logout";
$route['profile'] = "Auth/profile";
$route['changePassword'] = "Auth/changePassword";
$route['register'] = "Auth/register";
$route['forget'] = "Auth/forget";

$route['about'] = "Infomation/about";
$route['faq'] = "Infomation/faq";
$route['policy'] = "Infomation/policy";
$route['contact'] = "Infomation/contact";
$route['shipping-return'] = "Infomation/shippingReturn";
$route['terms-condition'] = "Infomation/termsCondition";


$route['all'] = "Shop/getAll";
$route['(:any)'] = "Shop/category/$1";
$route['(:any)/(:any)'] = "Shop/get/$1/$2";

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
