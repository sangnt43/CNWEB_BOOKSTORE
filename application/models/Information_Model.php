<?php defined('BASEPATH') or exit('No direct script access allowed');

class Information_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("Informations");
    }
    // public function get(?string $id = null)
    // {
    //     return $this->db->get_where($this->table, ["Id" => $id])->row_array();
    // }
}
