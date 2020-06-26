<?php

if (!function_exists("isCurrentTab")) {
    function isCurrentTab($tab)
    {
        $_navi = get_instance()->session->flashdata("_navi_");
        return strpos($_navi, $tab) !== FALSE ? true : false;
    }
}
