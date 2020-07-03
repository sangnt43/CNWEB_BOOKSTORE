<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['GetObjectId'] = "GetObjectId";

$route['[Aa]dmin'] = "Admin";

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
    if (isset($_POST['total']))
        return "Cart/checkout_";
    return "Cart/checkout";
};
$route['search'] = "Shop/search";

$route['about'] = "Infomation/about";
$route['faq'] = "Infomation/faq";
$route['policy'] = "Infomation/policy";
$route['contact']['post'] = "Home/Contact";
$route['contact']['get'] = "Infomation/contact";

$route['shipping-return'] = "Infomation/shippingReturn";
$route['terms-condition'] = "Infomation/termsCondition";

$route['all'] = "Shop/getAll";
$route['(:any)'] = "Shop/category/$1";
$route['(:any)/(:any)'] = "Shop/get/$1/$2";

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
