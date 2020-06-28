<?php

if (!function_exists("login")) {
    function save($data)
    {
        get_instance()->session->set_userdata("MY_User", $data);
    }
}

if (!function_exists("currentUser")) {
    function currentUser()
    {
        $session = get_instance()->session;
        if ($session->has_userdata("My_User"))
            return NULL;
        return $session->userdata("MY_User");
    }
}

if (!function_exists("logout")) {
    function logout()
    {
        session_destroy();
    }
}
