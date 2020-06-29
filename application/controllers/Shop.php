<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";

        $this->load->Model("Book_Model", "repo");

        $this->clear_breadcrum("Tất cả", "all");
    }

    public function index()
    {
        $data["recommendes"] = $this->repo->getRecommends();
        $data["books"] = $this->repo->page(1);

        $this->view("index", $data);
    }
    public function getAll()
    {
        $page = $this->input->post("page") != "" ? $this->input->post("page") : 1;

        $data = $this->repo->page($page);

        if (isset(getallheaders()['HTTP_X_REQUESTED_WITH'])) {
            return $this->response($data);
        } else {
            $data["recommendes"] = $this->repo->getRecommends();
            return $this->view("index", $data);
        }
    }
    public function category($seo)
    {
        $this->load->model("BookCategory_Model", "category");

        $page = $this->input->post("page") != "" ? $this->input->post("page") : 1;

        $data["category"] = $this->category->getBySeo($seo);

        $this->push_breadcrum($data["category"]["Name"]);

        $data = array_merge($data, $this->repo->getByCategory($data["category"]["Id"], $page));

        if (isset(getallheaders()['HTTP_X_REQUESTED_WITH'])) {
            return $this->response($data);
        } else {
            $data["recommendes"] = $this->repo->getRecommends();

            return $this->view("index", $data);
        }
    }
    public function get($category, $seo)
    {
        $this->load->model("BookCategory_Model", "Categories");

        $data["category"] = $this->Categories->getBySeo($category);

        $this->push_breadcrum($data["category"]["Name"], $data["category"]["Seo"]);

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
