<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Infomation extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";

        $this->load->model("Infomation_Model", "repo");

        $this->clear_breadcrum();
    }

    public function about()
    {
        $data = $this->repo->get("about");
        $data['navi'] = "about";
        $this->push_breadcrum("About");
        $this->view("index", $data);
    }

    public function faq()
    {
        $data = $this->repo->get("faq");
        $data['navi'] = "faq";

        $this->push_breadcrum("Faq");

        $this->view("index", $data);
    }

    public function policy()
    {

        $data = $this->repo->get("policy");
        $data['navi'] = "policy";

        $this->push_breadcrum("Policy");

        $this->view("index", $data);
    }

    public function contact()
    {
        $data = $this->repo->get("contact");
        $data['navi'] = "contact";

        $this->push_breadcrum("Contact");

        $this->view("index", $data);
    }

    public function shippingReturn()
    {
        $data = $this->repo->get("shipping-return");
        $data['navi'] = "shipping-return";

        $this->push_breadcrum("Shipping And Return");

        $this->view("index", $data);
    }
    public function termsCondition()
    {
        $data = $this->repo->get("terms-condition");
        $data['navi'] = "terms-condition";

        $this->push_breadcrum("Terms And Condition");

        $this->view("index", $data);
    }
}
