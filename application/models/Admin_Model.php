<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("admins");
    }
    public function login($data)
    {
        return $this->db
            ->get_where($this->table, ['Username' => $data['username'], "Password" => $data['password']])
            ->row_array();
    }
}
