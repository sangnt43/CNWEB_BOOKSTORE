<?php

$protocol =
    (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ?
    'https://' :
    'http://';

$config['base_url'] = "http://localhost/CNWEB/";
$config['database'] = "";
$config['username'] = "";
$config['password'] = "";
$config['constants'] = [
    "__HEAD__" => "head",

    "__NAVBAR__" => "navbar",
    "__BREADCRUMB__" => "breadcrumb",
    "__SIDEBAR__" => "sidebar",
    "__HEADER__" => "header",
    "__INCLUDE_SCRIPT__" => "include_script",

    "__FOOTER__" => "footer",

    "__CURRENCY__" => "USD",
    "__CURRENCY_DECIAML__" => "0"
];


if ($config['base_url'] == "")
    $config['base_url'] = $protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);