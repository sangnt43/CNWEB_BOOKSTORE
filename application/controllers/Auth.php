<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("User_model", "repo");
    }
    public function login()
    {
        if (!empty(currentUser())) {
            echo  json_encode([
                "message" => "Success"
            ]);
            return;
        }
        if ($this->input->post("username") == "" || $this->input->post("password") == "")
            show_404();

        $res = $this->repo->login(
            $this->input->post("username"),
            $this->input->post("password")
        );

        if (empty($res)) echo json_encode([
            "message" => "Error"
        ]);
        else echo json_encode([
            "message" => "Success"
        ]);
    }
    # region Return View
    public function changePassword()
    {
        if (empty(currentUser())) show_404();

        $new_password = $this->input->post("username");
        $password = $this->input->post("password");

        if ($password == "" || $new_password == "") show_404();
        if ($password == $new_password) echo json_encode([
            "message" => "Same"
        ]);
        else {
            $this->repo->changePassword($new_password);

            echo json_encode([
                "message" => "Success"
            ]);
        }
    }
    public function profile()
    {
        if (empty(currentUser())) show_404();

        $data["user"] = $this->repo->getCurrentUser();

        return $this->view("index", $data);
    }
    public function forget()
    {
        echo "ASD";
    }
    # endregion
    public function logout()
    {
        if (empty(currentUser())) show_404();
        logout();
        redirect(base_url());
    }

    public function register()
    {
    }
}
