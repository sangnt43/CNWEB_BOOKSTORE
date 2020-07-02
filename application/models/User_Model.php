<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("customers");
    }
    private function _map($data)
    {
        if (empty($data)) return NULL;
        if (file_exists(PUBPATH . $data["Image"]))
            $data["Avatar"] = base_url("public/" . $data["Avatar"]);
        else $data["Avatar"] = base_url("public/avatar/default.jpg");
        return $data;
    }
    public function login($username, $password)
    {
        return $this->_map(

            $this->db->get_where($this->table, ["username" => $username, "password" => md5($password)])->row_array()

        );
    }

    public function findByEmail($email)
    {
        $this->db->get_where($this->table, ["Email" => $email])->row_array();
    }

    public function register($data)
    {
    }

    public function getCurrentUser()
    {
        $currentUser = currentUser();
        if (empty($currentUser)) return NULL;
        return $this->_map(

            $this->db->get_where($this->table, ["Id" => $currentUser["Id"]])->row_array()

        );
    }

    public function getAllTransaction()
    {
        $currentUser = currentUser();
        if (empty($currentUser)) return NULL;

        return $this->db->join("order_statues", "order_statues.Id = orders.StatusId")->get_where("orders", ["CustomerInfo_Id" => $currentUser['Id']])->result_array();
    }

    public function checkPassword($password)
    {

        $currentUser = currentUser();
        if (empty($currentUser)) return NULL;

        return $this->db->where(["Id" => $currentUser["Id"], "Password" => md5($password)])
            ->from($this->table)->count_all_results() == 1 ? 1 : NULL;
    }

    public function changePassword($password)
    {
        $currentUser = currentUser();
        if (empty($currentUser)) return NULL;

        $this->db->where(["Id" => $currentUser["Id"]])
            ->update($this->table, ["password" => md5($password)]);
    }

    public function changeProfile($data)
    {
        $currentUser = currentUser();
        if (empty($currentUser)) return NULL;

        $this->db->where(["Id" => $currentUser['Id']])
            ->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function updatePassword($Id, $password)
    {
        $this->db->where(["Id" => $Id])
            ->update($this->table, ["password" => md5($password)]);
    }
}
