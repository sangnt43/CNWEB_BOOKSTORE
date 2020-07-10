<?php
class Banner extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Banner_model", "repo");
    }

    public function index()
    {
        $data['banners'] = $this->repo->getAll();

        return $this->view("index", $data);
    }
    public function add()
    {
        $data = [];
        if (!empty($this->input->post())) {
            $res = $this->_add();
            if (empty($res)) redirect(base_url("Admin/Banner"));
            else $data['error'] = $res;
        }

        return $this->view("add", $data);
    }

    private function _add()
    {
        $error = [];
        $id = ObjectId();

        $banner = [
            "Id" => $id,
            "Title" => $this->input->post("Title"),
            "Content" => $this->input->post("Content"),
            "Url" => $this->input->post("Url"),
            "btn_text" => $this->input->post("btn_text"),
            "IsActive" => empty($this->input->post("IsActive")) ? 0 : 1
        ];

        $upload = uploadFile("Image", PUBPATH . "banners", $id);

        if ($upload['success'] == 0) $error["upload"] = $upload['error'];
        else $banner['Image'] = "banners/" . $upload['data']["file_name"];

        if (isset($banner['Image'])) $res = $this->repo->create($banner);
        else $error['data'] = $banner;

        return $error;
    }

    public function edit($id)
    {
        $data['banner'] = $this->repo->get($id);

        if (empty($data['banner']))
            redirect(base_url("Admin/Banner"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);

            if (empty($res)) redirect(base_url("Admin/Banner")); // added
            else $data['error'] = $res;
        }

        return $this->view("edit", $data);
    }

    private function _edit($id)
    {
        $error = [];

        $banner = [
            "Title" => $this->input->post("Title"),
            "Content" => $this->input->post("Content"),
            "Url" => $this->input->post("Url"),
            "btn_text" => $this->input->post("btn_text"),
            "IsActive" => empty($this->input->post("IsActive")) ? 0 : 1
        ];

        if (isset($_FILES["Image"]) && !empty($_FILES["Image"]['name'])) {
            $upload = uploadFile("Image", PUBPATH . "banners", $id);
            if ($upload['success'] == 0) $error["upload"] = $upload['error'];
            else $banner['Image'] = "banners/" . $upload['data']["file_name"];
        }

        $res = $this->repo->update($id, $banner);

        if($res == 0) $error['data'] = $banner;

        return $error;
    }

    public function delete($id)
    {
        $model = $this->repo->get($id);

        if (isset($model['Id'])) {
            if (is_file(PUBPATH . $model["Image"]))
                unlink(PUBPATH . $model["Image"]);
            $this->repo->delete($id);
            echo '{"exitcode":"200","message":"thành công"}';
        } else {
            echo '{"exitcode":"204","message":"thất bại"}';
        }
    }

    public function changeActive($id)
    {
        $model = $this->repo->get($id);

        if (isset($model['Id'])) {
            $res = $this->repo->update($id, ['IsActive' => $this->input->post('IsActive')]);
            if ($res != 0) {
                echo '{"exitcode":"200","message":"thành công"}';
                return;
            }
        }
        echo '{"exitcode":"204","message":"thất bại"}';
    }
}
