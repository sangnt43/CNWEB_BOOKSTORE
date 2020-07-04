<?php
class BookCategory extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("BookCategory_model", "PC");
    }
    
    public function getAllCategory()
    {
        if (!function_exists("BookCategoryMap")) {
            function BookCategoryMap($item)
            {
                return [
                    "id" => $item["Id"],
                    "text" => $item["Name"],
                    "seo" => $item["Seo"]
                ];
            }
        }
        $res = $this->PC->getAllShort();
        echo json_encode(array_map("BookCategoryMap", $res));
    }
    public function getAll()
    {
        $res = $this->PC->get();
        echo json_encode(["data" => $res]);
    }
    public function getById($id)
    {
        if (!isset($id)) return;
        $data = $this->PC->getById($id);
        if ($data == NULL)
            return $this->response($this->json_data(0, "Thể loại không tồn tại"));
        return $this->response($this->json_data(1, "Tìm thấy", $data));
    }
    public function index()
    {
        $this->view("index");
    }
    public function add()
    {
        $this->view("add");
    }
    public function createBookCategory()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");

        $bookC = [
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "seo" => $this->input->post("seo")
        ];

        if ($bookC['name'] == "" || $bookC['description'] == "" || $bookC['seo'] == "")
            return $this->response($this->json_data(0, "Thêm loại sản phẩm thất bại"));

        try {
            $res = $this->PC->create($bookC);

            return $this->response($this->json_data(1, "Thêm loại sản phẩm thành công", ["returnUrl" => base_url("Admin/BookCategory")]));
        } catch (Exception $e) {
            return $this->response($this->json_data(0, "Thêm loại sản phẩm thất bại"));
        }
    }
    public function edit($id)
    {
        if (!isset($id)) redirect("Admin/BookCategory");
        $this->view("edit", ['id' => $id]);
    }
    public function updateBookCategory($id)
    {
        if (!isset($id)) return;
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");

        $book = ($this->input->post());

        $res = ($this->PC->update($id, $book));

        if ($res == NULL)
            return $this->response($this->json_data(0, "Cập nhật loại sản phẩm thất bại"));

        return $this->response($this->json_data(1, "Cập nhật loại sản phẩm thành công", ["returnUrl" => base_url("Admin/BookCategory")]));
    }
    public function delete($id)
    {
        if (!isset($id)) return;
        if ($this->PC->delete($id) != NULL)
            return  $this->response($this->json_data(1, "Xóa loại sản phẩm thành công"));
        else $this->response($this->json_data(0, "Xóa loại sản phẩm thất bại"));
    }
}
