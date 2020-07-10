<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("admins");
    }
    private function _map($data)
    {
        if (!isset($data['Id'])) {
            $data = array_map(function ($e) {
                $e['Password'] = "";
                return $e;
            }, $data);
        } else {
            $data['Password'] = "";
        }
        return $data;
    }
    public function get(?string $id = null)
    {
        return $this->_map(parent::get($id));
    }
    public function login($data)
    {
        return $this->db
            ->get_where($this->table, ['Username' => $data['username'], "Password" => $data['password']])
            ->row_array();
    }
    public function getByGroup($id)
    {
        return array_map(function ($e) {
            return $e['Id'];
        }, $this->db->select("Id")->get_where($this->table, ['GroupId' => $id])->result_array());
    }
}
