<?php

if (!function_exists("save")) {
    function save($data, $isAdmin = true)
    {
        get_instance()->session->set_userdata($isAdmin == true ? "My_Admin" : "MY_User", $data);
    }
}

if (!function_exists("currentUser")) {
    function currentUser()
    {
        $session = get_instance()->session;
        if (!$session->has_userdata("My_User"))
            return NULL;
        return $session->userdata("MY_User");
    }
}

if (!function_exists("currentAdmin")) {
    function currentAdmin()
    {
        $session = get_instance()->session;
        if (!$session->has_userdata("My_Admin"))
            return NULL;
        return $session->userdata("My_Admin");
    }
}

if (!function_exists("logout")) {
    function logout()
    {
        session_destroy();
    }
}

if (!function_exists("cache")) {
    function cache($key, $val = null)
    {
        $ci = get_instance();
        return $val == null ? $ci->cache->file->get($key) :  $ci->cache->file->save($key, $val, 3 * 60);
    }
}
