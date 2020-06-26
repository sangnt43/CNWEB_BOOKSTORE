<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
    }

    public function index()
    {
        $this->load->model("Book_Model", "repo");

        $data["recommendes"] = $this->repo->getRecommends();
        $data["top_buy"] = $this->repo->getTopBuy();

        $this->view("index", $data);
    }
}
