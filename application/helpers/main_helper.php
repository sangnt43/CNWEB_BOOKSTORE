<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists("debug")) {
    function debug(...$data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        die;
    }
}

if (!function_exists("ObjectId")) {
    function ObjectId()
    {
        $bin = str_split(sprintf(
            "%s%s%s%s",
            pack('N', time()),
            substr(md5(php_uname('n')), 0, 3),
            pack('n', getmypid()),
            substr(pack('N', rand(0, 2E9)), 1, 3)
        ));
        return array_reduce($bin, function ($c, $e) {
            return $c . sprintf("%02x", ord($e));
        }, "");
    }
}

if (!function_exists("get_client_ip")) {
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
}
