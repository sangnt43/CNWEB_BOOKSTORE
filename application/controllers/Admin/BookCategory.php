<?php
class BookCategory extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("BookCategory_model", "repo");
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
        $res = $this->repo->getAllShort();
        echo json_encode(array_map("BookCategoryMap", $res));
    }
    public function getById($id)
    {
        if (!isset($id)) return;
        $data = $this->repo->getById($id);
        if ($data == NULL)
            return $this->response($this->json_data(0, "Thể loại không tồn tại"));
        return $this->response($this->json_data(1, "Tìm thấy", $data));
    }
    public function index()
    {
        $data['categories'] = $this->repo->get();

        $this->view("index", $data);
    }
    public function add()
    {
        $data = [];
        if (!empty($this->input->post())) {
            $res = $this->_add();
            if (empty($res)) redirect(base_url("Admin/BookCategory"));
            else $data['error'] = $res;
        }

        return $this->view("add", $data);
    }

    private function _add()
    {
        $error = [];
        $id = ObjectId();

        $category = [
            "Id" => $id,
            "Name" => $this->input->post("Name"),
            "Seo" => $this->input->post("Seo")
        ];

        $res = $this->repo->create($category);

        if ($res == 0) $error['data'] = $category;

        return $error;
    }
    public function edit($id)
    {
        $data['category'] = $this->repo->get($id);

        if (empty($data['category']))
            redirect(base_url("Admin/BookCategory"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);
            if (empty($res)) redirect(base_url("Admin/BookCategory")); // added
            else $data['error'] = $res;
        }

        return $this->view("edit", $data);
    }
    private function _edit($id)
    {
        $error = [];

        $book = [
            "Name" => $this->input->post("Name"),
            "Seo" => $this->input->post("Seo")
        ];

        $res = $this->repo->update($id, $book);

        return $error;
    }
    public function delete($id)
    {
        $model = $this->repo->get($id);

        if (isset($model['Id'])) {
            $res = $this->repo->delete($id);
            echo '{"exitcode":"200","message":"thành công"}';
        } else {
            echo '{"exitcode":"204","message":"thất bại"}';
        }
    }
}
