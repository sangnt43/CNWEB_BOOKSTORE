<?php

if (!function_exists("get_cookie")) {
    function get_cookie(string $key = null)
    {
        if ($key == null)
            return ($_COOKIE);
        else return isset($_COOKIE[$key]) ? $_COOKIE[$key] : "";
    }
    function set_cookie(string $key, string $var)
    {
        $_COOKIE["$key"] = $var;
    }
}
