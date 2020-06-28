<?php defined('BASEPATH') or exit('No direct script access allowed');

class My_Model extends CI_Model
{
    protected $table;
    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function get(string $id = null)
    {
        if ($id == null)
            return $this->db->get($this->table)->result_array();
        return $this->db
            ->get_where("$this->table", ["$this->table.Id" => $id])->row_array();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $this->db->where(["id" => $id])
            ->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
