<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";

        $this->load->Model("Book_Model", "repo");
    }

    public function index()
    {
        $data["recommendes"] = $this->repo->getRecommends();
        $data["books"] = $this->repo->page(1);

        $this->view("index", $data);
    }
    public function category($seo)
    {
        $data["recommendes"] = $this->repo->getRecommends();

        $data['books'] = $this->repo->getByCategory($seo);

        $this->push_breadcrum('category');

        if (isset(getallheaders()['HTTP_X_REQUESTED_WITH'])) {
            return $this->response($data);
        } else {
            return $this->view("index", $data);
        }
    }
    public function get($category, $seo)
    {
        $this->load->model("BookCategory_Model", "Categories");
        $data["category"] = $this->Categories->getBySeo($category);
        $data["recommendes"] = $this->repo->getRecommends();

        if (isset($data["category"]))
            $data['book'] = $this->repo->getBySeo($data["category"]["Id"], "$category/$seo");

        if (!isset($data['book'])) show_404();

        $this->push_breadcrum($data['book']['Name']);

        if (isset(getallheaders()['HTTP_X_REQUESTED_WITH'])) {
            return $this->response($data);
        } else {
            return $this->view("book", $data);
        }
    }
}
