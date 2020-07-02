<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaction extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Order_Model", "repo");
    }

    public function index($id)
    {
        if (isset($_SERVER['HTTP_REFERER']))
            $this->__LAYOUT__ = "iframe";

        $data['order'] = $this->repo->get($id);
        if (empty($data['order'])) show_404();

        $data['books'] = $this->repo->getBooksByOrder($id);

        $this->view("index", $data);
    }
}
