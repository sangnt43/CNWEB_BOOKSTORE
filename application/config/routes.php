<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['(:any)'] = "Shop/category/$1";
$route['(:any)/(:any)'] = "Shop/get/$1/$2";

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
