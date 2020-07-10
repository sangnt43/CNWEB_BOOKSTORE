<?php

class Manager extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->__LAYOUT__ = "main";

        $this->load->model("Admin_Model", "repo");
    }
    public function index()
    {
        $data['admins'] = $this->repo->get();

        return $this->view("index", $data);
    }
    public function add()
    {
        $data = [];
        if (!empty($this->input->post())) {
            $res = $this->_add();
            if (empty($res)) redirect(base_url("Admin/Manager"));
            else $data['error'] = $res;
        }

        return $this->view("add", $data);
    }
    private function _add()
    {
        $error = [];
        $id = ObjectId();

        $admin = [
            "Id" => $id,
            "Username" => $this->input->post("Username"),
            "Password" => md5($this->input->post("Password")),
            "FullName" => $this->input->post("FullName"),
            "GroupId" => "111111111111111111111111"
        ];

        $res = $this->repo->create($admin);

        return $error;
    }
    public function edit($id)
    {
        $data['admin'] = $this->repo->get($id);

        if (empty($data['admin']))
            redirect(base_url("Admin/Manager"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);

            if (empty($res)) redirect(base_url("Admin/Manager")); // added
            else $data['error'] = $res;
        }

        return $this->view("edit", $data);
    }
    private function _edit($id)
    {
        $error = [];

        $admin = ["FullName" => $this->input->post("FullName")];

        if ($this->input->post("Password") != "")
            $admin["Password"] = md5($this->input->post("Password"));

        $res = $this->repo->update($id, $admin);

        if ($res == 0) $error['data'] = $admin;

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
