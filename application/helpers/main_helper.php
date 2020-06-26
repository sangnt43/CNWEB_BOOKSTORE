<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists("debug")) {
    function debug()
    {
        echo "<pre>";
        print_r(func_get_args());
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
        return array_reduce($bin,function ($c,$e) {
            return $c . sprintf("%02x", ord($e));
        },"");
    }
}