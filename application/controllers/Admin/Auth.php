<?php

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_Model", "repo");
    }
    public function index()
    {
        return $this->view("login", ['IsAdmin' => true]);
    }

    public function login()
    {
        if (empty($this->input->post()))
            redirect(base_url("Admin/login"));

        $data = [];

        $user = [
            "username" => $this->input->post("username"),
            "password" => md5($this->input->post("password"))
        ];

        $res = $this->repo->login($user);

        if (empty($res)) {
            $data['username'] = $this->input->post("username");
            $data["success"] = "0";
            $data["message"] = "Thất bại";
        } else {
            save($res, true);
            redirect(base_url("Admin/Order"));
        }

        redirect(base_url("Admin/login"));
    }
    public function logout()
    {
        if (empty(currentAdmin())) show_404();
        logout();
        redirect(base_url("Admin/login"));
    }
}
