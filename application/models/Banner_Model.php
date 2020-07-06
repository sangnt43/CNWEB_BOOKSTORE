<?php defined('BASEPATH') or exit('No direct script access allowed');

class Banner_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("banners");
    }
    private function _mapImage($data)
    {
        if (file_exists(PUBPATH . $data["Image"]))
            $data["Image"] = base_url("public/" . $data["Image"]);
        else
            $data["Image"] = base_url("public/banners/default.jpg");
        return $data;
    }
    private function _map($data)
    {
        if (!isset($data)) return;
        $data = array_map(array($this, "_mapImage"), $data);
        return $data;
    }
    public function get(?string $id = null)
    {
        return $this->_map(
            $this->db->get_where($this->table, ["IsActive" => 1])->result_array()
        );
    }
    public function getAll()
    {
        return $this->_map(
            $this->db->get_where($this->table)->result_array()
        );
    }
}
