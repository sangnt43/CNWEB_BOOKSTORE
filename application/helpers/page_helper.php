<?php

if (!function_exists("isCurrentTab")) {
    function isCurrentTab($tab)
    {
        $_navi = get_instance()->session->flashdata("_navi_");
        return strpos($_navi, $tab) !== FALSE ? true : false;
    }
}
if (!function_exists("getBanner")) {
    function getBanber()
    {
        $ci = get_instance();
        $ci->load->model("Banner_Model");
        $data['banners'] = $ci->Banner_Model->get();
        $ci->load->view("layouts/banner.php", $data);
    }
}

if (!function_exists("getAllCategories")) {
    function getAllCategories()
    {
        $ci = get_instance();
        $ci->load->model("BookCategory_Model");
        return $ci->BookCategory_Model->get();
    }
}

if (!function_exists("showNoti")) {
    function showNoti($message, $type)
    {
        $ci = get_instance();

        return $ci->load->view("layouts/noti.php", ["message" => $message, "type" => $type]);
    }
}

if (!function_exists("checkNoti")) {
    function checkNoti()
    {
        $ci = get_instance();
        $data = $ci->session->flashdata('remind');

        if (isset($data['script']))
            echo $data['script'];

        if ($data != "")
            return $ci->load->view("layouts/noti.php", ["message" => $data['message'], "type" => $data['type']]);
    }
}

if (!function_exists("isCurrentController")) {
    function isCurrentController($controller)
    {
        if (!isset($_SESSION['navi'])) return false;
        if (is_array($controller)) {
            foreach ($controller as $con)
                if ($_SESSION["navi"] == strtolower($con)) return true;
            return false;
        }
        return  $_SESSION["navi"] == strtolower($controller);
    }
}
if (!function_exists("checkRoleController")) {
    function checkRoleController($controller)
    {
        if (!empty(currentAdmin()) || !isset(currentAdmin()['permission']))
            return false;
        if (is_array($controller)) {
            foreach ($controller as $con)
                if (isset(currentAdmin()['permission'][$con])) return true;
            return false;
        }
        return  isset(currentAdmin()['permission'][$controller]);
    }
}
if (!function_exists("checkRoleWithController")) {
    function checkRoleWithController($contorller)
    {
        $prop = config_item("permission");
        if (!isset($_SESSION[$prop])) return false;
        if (!is_array($contorller)) {
            return isset($_SESSION[$prop][$contorller]);
        }

        foreach ($contorller as $ctl)
            if (!isset($_SESSION[$prop][$ctl])) return false;

        return true;
    }
}
