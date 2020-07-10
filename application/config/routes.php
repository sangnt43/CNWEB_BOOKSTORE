<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['GetObjectId'] = "GetObjectId";

$route['[Aa]dmin'] = "Admin/Dashboard";
$route['[Aa]dmin/login']['get'] = "Admin/Auth/index";
$route['[Aa]dmin/login']['post'] = "Admin/Auth/login";
$route['[Aa]dmin/logout'] = "Admin/Auth/logout";

$route['cart'] = "Cart/index";
$route['login'] = "Auth/login";

$route['logout'] = "Auth/logout";
$route['profile'] = "Auth/profile";
$route['changePassword'] = "Auth/changePassword";
$route['changeProfile'] = "Auth/changeProfile";
$route['register'] = "Auth/register";
$route['forget'] = "Auth/forget_";
$route['forget/(:any)'] = "Auth/forget/$1";
$route['wich'] = "Auth/wichList";
$route['transaction'] = "Auth/transaction";
$route['transaction/(:any)'] = "Transaction/index/$1";

$route['checkout'] = function () {
    return (isset($_POST['total'])) ? "Cart/checkout_" : "Cart/checkout";
};

$route['search'] = "Shop/search";

$route['about'] = "Information/about";
$route['faq'] = "Information/faq";
$route['policy'] = "Information/policy";
$route['contact']['post'] = "Home/Contact";
$route['contact']['get'] = "Information/contact";

$route['shipping-return'] = "Information/shippingReturn";
$route['terms-condition'] = "Information/termsCondition";

$route['all'] = "Shop/getAll";
$route['((?!([Aa]dmin))[^\/]+)'] = "Shop/category/$1";
$route['((?!([Aa]dmin))[^\/]+)/(:any)'] = "Shop/get/$1/$2";

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
