<?php

class Dashboard extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        return $this->view("index");
    }
}
