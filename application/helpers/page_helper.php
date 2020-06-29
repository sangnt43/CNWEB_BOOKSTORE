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
        $ci->load->model("Banner_Model", "model");

        $data['banners'] = $ci->model->get();

        $ci->load->view("layouts/banner.php", $data);
    }
}

if (!function_exists("getAllCategories")) {
    function getAllCategories()
    {
        $ci = get_instance();
        $ci->load->model("BookCategory_Model", "model");
        return $ci->model->get();
    }
}
