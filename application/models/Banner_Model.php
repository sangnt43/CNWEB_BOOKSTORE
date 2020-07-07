<?php defined('BASEPATH') or exit('No direct script access allowed');

class Banner_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("banners");
    }
    private function _mapImage($data)
    {
        $data['IsActive'] = $data['IsActive'] == 0 ? FALSE : TRUE;
        if (file_exists(PUBPATH . $data["Image"]))
            $data["Image"] = base_url("public/" . $data["Image"]);
        else
            $data["Image"] = base_url("public/banners/default.jpg");
        return $data;
    }
    private function _map($data)
    {
        if (!isset($data)) return;
        if (isset($data[0]))
            $data = array_map(array($this, "_mapImage"), $data);
        else $data = $this->_mapImage($data);
        return $data;
    }
    public function get(?string $id = null)
    {
        if (empty($id))
            return $this->_map(
                $this->db->get_where($this->table, ["IsActive" => 1])->result_array()
            );
        else return $this->_map(
            $this->db->get_where($this->table, ['Id' => $id])->row_array()
        );
    }
    public function getAll()
    {
        return $this->_map(
            $this->db->order_by("Id DESC")->get_where($this->table)->result_array()
        );
    }
}
