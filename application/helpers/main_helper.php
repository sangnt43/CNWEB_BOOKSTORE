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

if (!function_exists("IsAjax")) {
    function IsAjax()
    {
        return isset(getallheaders()['HTTP_X_REQUESTED_WITH']);
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

if (!function_exists('multiexplode')) {
    function multiexplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
}

if (!function_exists("makeEditable")) {
    function makeEditable($path)
    {
        if (!is_writable($path)) chmod($path, 0750);
    }
}

if (!function_exists('createDirectory')) {
    function createDirectory($path)
    {
        if ($path[0] == "\\" || $path[0] == "/") $path = substr($path, 1);
        if (is_dir(PUBPATH . $path)) return;

        if (!function_exists('tryCreateDirectory')) {
            function tryCreateDirectory($path)
            {
                if (!is_dir($path)) mkdir($path);
                makeEditable($path);
            }
        }
        $paths = multiexplode(["\\", "/"], $path);
        $path = PUBPATH;
        foreach ($paths as $_path) {
            $path .= $_path;
            tryCreateDirectory($path);
            $path .= "/";
        }
    }
}

if (!function_exists("uploadFile")) {
    function uploadFile($name, $path = "images", $filename = null, $width = 1200, $height = 800)
    {
        $ci = get_instance();

        $config['upload_path']          = $path;
        $config['overwrite']            = TRUE;
        if (!empty($filename))
            $config['file_name']        = $filename;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|webp';
        $config['max_size']             = 5 * 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $ci->load->library('upload', $config);

        if (!$ci->upload->do_upload($name))
            return [
                "success" => "0",
                "error" =>  $ci->upload->display_errors()
            ];
        else
            return [
                "success" => 1,
                "data" => $ci->upload->data()
            ];
    }
}

if (!function_exists("moveFile")) {
    function moveFile()
    {
    }
}

if (!function_exists("deleteFile")) {
    function deleteFile($path)
    {
        if (is_file($path))
            unlink($path);
    }
}
