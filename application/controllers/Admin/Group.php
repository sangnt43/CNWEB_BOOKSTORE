<?php
defined("BASEPATH") or exit;

class Group extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->__LAYOUT__ = "main";

        $this->load->model("Group_Model", "repo");
    }
    public function index()
    {
        $data['groups'] = $this->repo->get();
        return $this->view("index", $data);
    }
    private function _getControllerList()
    {
        $this->load->library("ControllerList");
        $list = $this->controllerlist->getControllers();
        foreach ($list as $key => $value) {
            $list[] = [
                'id' => $key,
                'parent' => '#',
                'text' => $key,
                'icon' => 'zmdi zmdi-folder zmdi-hc-fw'
            ];
            foreach ($value as $key1 => $value1) {
                $list[] = [
                    'id' =>  "$key/$value1",
                    'parent' =>  $key,
                    'text' => $value1,
                    'icon' => 'zmdi zmdi-file zmdi-hc-fw'
                ];
            }
            unset($list[$key]);
        }
        return $list;
    }
    public function add()
    {
        $data = [];
        if (!empty($this->input->post())) {
            $res = $this->_add();
            if (empty($res)) redirect(base_url("Admin/Group"));
            else $data['error'] = $res;
        }
        $data['controllerList'] = $this->_getControllerList();

        return $this->view("add", $data);
    }
    private function _add()
    {
        $error = [];
        $id = ObjectId();

        $group = [
            "Id" => $id,
            "Name" => $this->input->post("Name"),
            "Roles" => $this->input->post("Roles")
        ];

        $res = $this->repo->create($group);

        return $error;
    }
    public function edit($id)
    {
        $this->load->library("ControllerList");
        $data['group'] = $this->repo->get($id);

        if (empty($data['group']))
            redirect(base_url("Admin/Group"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);

            if (empty($res)) redirect(base_url("Admin/Group"));
            else $data['error'] = $res;
        }

        $data['controllerList'] = $this->_getControllerList();

        foreach (json_decode($data['group']['Roles'], true) as $key => $value)
            foreach ($value as $action)
                $data['controllerList'][(array_search("$key/$action", array_column($data['controllerList'], "id")))]['state'] = ["selected" => "true"];

        return $this->view("edit", $data);
    }
    private function _edit($id)
    {
        $error = [];

        $group = [
            "Name" => $this->input->post("Name"),
            "Roles" => $this->input->post("Roles"),
        ];

        $res = $this->repo->update($id, $group);

        if ($res == 0) $error['data'] = $group;

        return $error;
    }
    public function delete($id)
    {
        $model = $this->repo->get($id);

        if (isset($model['Id'])) {
            $this->repo->delete($id);
            echo '{"exitcode":"200","message":"thành công"}';
        } else {
            echo '{"exitcode":"204","message":"thất bại"}';
        }
    }
    public function userList($id)
    {
        $data['group'] = $this->repo->get($id);

        if (empty($data['group']))
            redirect(base_url("Admin/Group"));

        $this->load->model("Admin_Model", "user");
        $data['users'] = $this->user->get();
        $data['userInGroup'] = $this->user->getByGroup($id);

        if (!empty($this->input->post())) {
            $this->_removeUser($id);
            $this->_addUser($id);

            redirect(base_url("Admin/Group"));
        }

        return $this->view("userList", $data);
    }
    private function _removeUser($id)
    {
        $users = json_decode($this->input->post("removeList"));
        if (!empty($users))
            $this->repo->removeUser($users);
    }
    private function _addUser($id)
    {
        $users = json_decode($this->input->post("userList"));
        if (!empty($users))
            $this->repo->addUser($id, $users);
    }
}
