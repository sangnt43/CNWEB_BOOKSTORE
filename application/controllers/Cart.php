<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Book_Model", "repo");
    }
    public function index()
    {
        $data['recommendes'] = $this->repo->getRecommends();
        return $this->view("index",$data);
    }
    public function checkout()
    {
    }
}
