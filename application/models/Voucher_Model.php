<?php
class Voucher_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("vouchers");
    }

    public function get(?string $id = null)
    {
        return $this->db->get_where($this->table, ["Code" => $id]) -> row_array();
    }
}
