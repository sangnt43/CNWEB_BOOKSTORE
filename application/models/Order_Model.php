<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("orders");
    }
    public function get(?string $id = null)
    {
        return $this->db->get_where($this->table, ["Id" => $id])->row_array();
    }
    public function getBooksByOrder($id)
    {
        return $this->db
            ->select("books.Name,books.Price,order_details.Quantity,books.Seo")
            ->join("books", "order_details.BookId = books.Id")
            ->get_where("order_details", ['OrderId' => $id])
            ->result_array();
    }
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }
    public function addList($array)
    {
        $this->db->insert_batch("order_details", $array);
        return $this->db->affected_rows();
    }
}
