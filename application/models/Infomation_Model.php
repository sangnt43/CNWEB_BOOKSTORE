<?php defined('BASEPATH') or exit('No direct script access allowed');

class Infomation_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("infomations");
    }
    public function get(?string $id = null)
    {
        return $this->db->get_where($this->table, ["Id" => $id])->row_array();
    }
}
