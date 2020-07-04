<?php

class Book extends MY_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->__LAYOUT__ = "main";
        $this->load->model("Book_Model", "Book");
    }
    public function index()
    {
        return $this->view("index");
    }
    public function getAll()
    {
        echo json_encode(["data" => $this->Book->getAllShort()]);
    }
    public function getById($id)
    {
        if (!isset($id)) return;
        $data = $this->Book->get($id);
        if ($data == NULL)
            return $this->response($this->json_data(0, "sản phẩm không tồn tại"));
        if (isset($data['avatar']))
            $data['avatar'] = $data['avatar'] . "?" . time();
        return $this->response($this->json_data(1, "Tìm thấy", $data));
    }
    public function add()
    {
        return $this->view("add");
    }
    public function createBook()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");
        $Book = [
            "id" => ObjectId(),
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "images" => $this->input->post("imageList"),
            "bookCategory" => $this->input->post("BookCategory"),
            "price" => $this->input->post("price"),
            "quantity" => $this->input->post("quantity"),
            "seo" => $this->input->post("seo"),
        ];

        if ($Book['name'] == "" || $Book['BookCategory'] == "")
            return $this->response($this->json_data(0, "Thêm sản phẩm thất bại"));

        $tmpAvatar = uploadImage("avatar", "Books", $Book['id']);

        if ($tmpAvatar ==  NULL)
            return $this->response($this->json_data(2, "Ảnh sai định dạng"));

        try {
            $res = $this->Book->create($Book);

            moveFile($tmpAvatar, $res['avatar']);

            return $this->response($this->json_data(1, "Thêm sản phẩm thành công", ["returnUrl" => base_url("Admin/Book")]));
        } catch (Exception $e) {
            unlink(PUBPATH . $tmpAvatar);
            return $this->response($this->json_data(0, "Thêm sản phẩm thất bại"));
        }
    }
    public function edit($id)
    {
        if (!isset($id)) redirect("Admin/Book");
        $this->view("edit", ['id' => $id]);
    }
    public function updateBook($id)
    {
        if (!isset($id)) return;
        $avatar = uploadImage("avatar", "Books", $id);

        if (empty($this->input->post()) && !isset($avatar)) return new ErrorException("Not Found", "0");

        $Book = ($this->input->post());

        if ($avatar != NULL)
            $Book['avatar'] = $avatar;

        $res = ($this->Book->update($id, $Book));

        if ($res == NULL)
            return $this->response($this->json_data(0, "Cập nhật sản phẩm thất bại"));

        return $this->response($this->json_data(1, "Cập nhật sản phẩm thành công", ["returnUrl" => base_url("Admin/Book")]));
    }
    public function changeActive()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");

        if ($this->Book->changeActive($this->input->post("id"), $this->input->post("value")) != NULL)
            return  $this->response($this->json_data(1, "Cập nhật trạng thái thành công"));
        else $this->response($this->json_data(0, "Cập nhật trạng thái thất bại"));
    }
    public function delete($id)
    {
        if (!isset($id)) return;
        if ($this->Book->delete($id) != NULL)
            return  $this->response($this->json_data(1, "Xóa sản phẩm thành công"));
        else $this->response($this->json_data(0, "Xóa sản phẩm thất bại"));
    }
}
