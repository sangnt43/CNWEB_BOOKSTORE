<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
    }

    public function checkout()
    {
    }
    public function shippingStatus()
    {
    }
}
