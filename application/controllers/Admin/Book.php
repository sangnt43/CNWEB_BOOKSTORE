<?php

class Book extends MY_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->__LAYOUT__ = "main";
        $this->load->model("Book_Model", "repo");
        $this->load->model("Auth_Model");
        $this->load->model("Publisher_Model");
    }

    public function index()
    {
        $data['books'] = $this->repo->get();
        return $this->view("index", $data);
    }

    public function add()
    {
        $data = [];
        if (!empty($this->input->post())) {
            $res = $this->_add();
            if (empty($res)) redirect(base_url("Admin/Book"));
            else $data['error'] = $res;
        }

        $data['authes'] = $this->Auth_Model->get();
        $data['publishers'] = $this->Publisher_Model->get();

        return $this->view("add", $data);
    }

    private function _add()
    {
        $error = [];
        $id = ObjectId();

        $book = [
            "Id" => $id,
            "Name" => $this->input->post("Name"),
            "Description" => $this->input->post("Description"),
            "BookCategoryId" => $this->input->post("BookCategoryId"),
            "Images" => $this->input->post("Images"),
            "Seo" => $this->input->post("Seo"),
            "Discount" => $this->input->post("Discount"),
            "Price" => $this->input->post("Price")
        ];

        if ($this->input->post("AuthId") != "")
            $book['Info_Auth'] = $this->input->post("AuthId");
        else $book['Info_Auth'] = $this->Auth_Model->create($this->input->post("Auth"));

        if ($this->input->post("PublisherId") != "")
            $book['Info_PublisherId'] = $this->input->post("PublisherId");
        else $book['Info_PublisherId'] = $this->Publisher_Model->create($this->input->post("Publisher"));

        if (isset($_FILES["Avatar"]) && !empty($_FILES["Avatar"]['name'])) {
            $upload = uploadFile("Avatar", PUBPATH . "images", $id, 800, 1200);
            if ($upload['success'] == 0) $error["upload"] = $upload['error'];
            else $book['Avatar'] = "images/" . $upload['data']["file_name"];
        } else $book['Avatar'] = "images/default.jpg";

        $res = $this->repo->create($book);

        if ($res == 0) $error['data'] = $book;

        return $error;
    }

    public function edit($id)
    {
        $data['book'] = $this->repo->get($id);

        if (empty($data['book']))
            redirect(base_url("Admin/Book"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);

            if (empty($res)) redirect(base_url("Admin/Book")); // added
            else $data['error'] = $res;
        }

        $data['authes'] = $this->Auth_Model->get();
        $data['publishers'] = $this->Publisher_Model->get();

        return $this->view("edit", $data);
    }

    private function _edit($id)
    {
        $error = [];

        $book = [
            "Name" => $this->input->post("Name"),
            "Description" => $this->input->post("Description"),
            "BookCategoryId" => $this->input->post("BookCategoryId"),
            "Images" => $this->input->post("Images"),
            "Seo" => $this->input->post("Seo"),
            "Discount" => $this->input->post("Discount"),
            "Price" => $this->input->post("Price")
        ];

        if ($this->input->post("AuthId") != "") $book['Info_Auth'] = $this->input->post("AuthId");
        else $book['Info_Auth'] = $this->Auth_Model->create($this->input->post("Auth"));

        if ($this->input->post("PublisherId") != "") $book['Info_PublisherId'] = $this->input->post("PublisherId");
        else $book['Info_PublisherId'] = $this->Publisher_Model->create($this->input->post("Publisher"));

        if (isset($_FILES["Avatar"]) && !empty($_FILES["Avatar"]['name'])) {
            $upload = uploadFile("Avatar", PUBPATH . "images", $id, 800, 1200);
            if ($upload['success'] == 0) $error["upload"] = $upload['error'];
            else $book['Avatar'] = "images/" . $upload['data']["file_name"];
        }

        $res = $this->repo->update($id, $book);

        if ($res == 0 && $_FILES['Avatar']['name'] == '') $error['data'] = $book;

        return $error;
    }

    public function delete($id)
    {
        $model = $this->repo->get($id);

        if (isset($model['Id'])) {
            if (is_file(PUBPATH . $model["Avatar"]))
                unlink(PUBPATH . $model["Avatar"]);
            $this->repo->delete($id);
            echo '{"exitcode":"200","message":"thành công"}';
        } else {
            echo '{"exitcode":"204","message":"thất bại"}';
        }
    }
}
