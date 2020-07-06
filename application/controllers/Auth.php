<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("User_model", "repo");

        $this->clear_breadcrum("Tài khoản", "profile");
    }
    public function login()
    {
        if (!empty(currentUser())) {
            echo  json_encode([
                "message" => "Success"
            ]);
            return;
        }

        $this->__LAYOUT__ = null;
        $data = [];

        if (!empty($this->input->post())) {
            $res = $this->repo->login(
                $this->input->post("username"),
                $this->input->post("password")
            );

            if (empty($res)) {
                $data['username'] = $this->input->post("username");
                $data["success"] = "0";
                $data["message"] = "Tài khoản hoặc mật khẩu sai";
            } else {
                save($res);

                $this->session->set_flashdata("remind", [
                    "success" => "1",
                    "message" => "Đăng nhập thành công",
                    "type" => "success"
                ]);

                redirect(base_url());
            }
        }

        return $this->view("login", $data);
    }
    # region Return View
    public function changePassword()
    {
        if (empty(currentUser())) show_404();

        $new_password = $this->input->post("new_password");
        $password = $this->input->post("password");

        if ($password == "" || $new_password == "") show_404();
        else if ($password == $new_password) echo json_encode([
            "success" => 0,
            "message" => "Same"
        ]);
        else {
            $res = $this->repo->checkPassword($password);
            if (empty($res)) echo json_encode([
                "success" => -1,
                "message" => "Password Not Correct"
            ]);

            $this->repo->changePassword($new_password);

            echo json_encode([
                "success" => 1,
                "message" => "Success"
            ]);
        }
    }
    public function changeProfile()
    {
        if (empty(currentUser())) show_404();

        $user = [
            "FullName" => $this->input->post("FullName"),
            "Address" => $this->input->post("Address"),
            "Phone" => $this->input->post("Phone"),
            "Email" => $this->input->post("Email")
        ];


        $res = $this->repo->changeProfile($user);

        // error
        if ($res == 0) {

            debug($res);

            echo json_encode([
                "success" => 0,
                "message" => "Thất Bại"
            ]);
        } else {
            foreach ($user as $key => $value)
                $_SESSION['My_User'][$key] = $value;

            echo json_encode([
                "success" => 1,
                "message" => "Thành Công"
            ]);
        }
    }
    public function profile()
    {
        if (empty(currentUser())) show_404();

        $data["user"] = $this->repo->getCurrentUser();

        $this->push_breadcrum("Thông tin tài khoản");
        if (!IsAjax()) {
            return $this->view("profile", $data);
        } else {
            return $this->response($data);
        }
    }
    public function forget_()
    {
        $data = [];
        if ($this->input->post("email") != "") {
            $res = $this->repo->findByEmail($this->input->post("email"));
            if (isset($res)) {
                cache(hash("sha256", json_encode($res)), $res);
                $data = [
                    "email" => $this->input->post("email"),
                    "message" => "Thành Công",
                    "success" => true
                ];
            } else $data = [
                "email" => $this->input->post("email"),
                "message" => "Thất Bại",
                "success" => false
            ];
        }

        return $this->view("_forget", $data);
    }
    public function forget($token)
    {
        // cache data 1p
        if ($this->cache->get($token) == "") redirect(base_url());
        $data = [];
        if ($this->input->post("new_password") != "") {
            $res = $this->repo->updatePassword($_SESSION['user']["Id"], $this->input->post("new_password"));
            if ($res == 1) {
                $this->cache->delete($token);
                redirect(base_url("Home"));
            } else $data["error_message"] = "Thất bại";
        }

        $_SESSION['user'] = $this->cache->get($token);

        return $this->view("forget", $data);
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
        if (!empty(currentUser())) {
            echo  json_encode([
                "message" => "Success"
            ]);
            return;
        }

        $this->__LAYOUT__ = null;
        $data = [];

        if (!empty($this->input->post())) {
            // register
            $res = $this->repo->register($this->input->post());
            if (!empty($res)) {
                redirect(base_url("login"));
            } else {
                $data['message'] = "Thất bại";
                $data['success'] = "0";
            }
        }

        return $this->view("register", $data);
    }

    public function transaction()
    {
        if (empty(currentUser())) show_404();

        $data['transactions'] = $this->repo->getAllTransaction();

        $this->push_breadcrum("Thông tin tài khoản");

        $data['navi'] = "transaction";
        if (!IsAjax())
            return $this->view("profile", $data);
        return $this->response($data);
    }

    public function wichList()
    {
        $this->load->model("Book_Model", "book");

        $data["wich"] = $this->book->getByList(explode(",", get_cookie("wich")));

        $data['navi'] = "wich";

        if (!empty(currentUser())) {
            $this->push_breadcrum("Thông tin tài khoản");
            if (IsAjax()) {
                return $this->response($data);
            } else {
                return $this->view("profile", $data);
            }
        } else {
            $this->clear_breadcrum("Danh sách yêu thích");
            return $this->view("wich", $data);
        }
    }
}
