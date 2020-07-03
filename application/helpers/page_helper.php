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
