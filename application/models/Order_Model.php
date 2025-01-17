<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("orders");
    }
    public function get(?string $id = null)
    {
        if (!empty(currentUser()))
            return $this->db->get_where($this->table, ["Id" => $id, "CustomerInfo_Id" => currentUser()['Id']])->row_array();
        else if (!empty(currentAdmin()))
            return $this->db->get_where($this->table, ["Id" => $id])->row_array();
        return $this->db->get_where($this->table, ["Id" => $id, "StatusId !=", "000000000000000000000000"])->row_array();
    }
    public function getBooksByOrder($id)
    {
        return $this->db
            ->select("books.Name,books.Price,order_details.Quantity,books.Seo")
            ->join("books", "order_details.BookId = books.Id")
            ->get_where("order_details", ['OrderId' => $id])
            ->result_array();
    }
    public function getAllShort()
    {
        return $this->db
            ->select("orders.*,order_statues.Status,order_statues.StatusCode")
            ->join("order_statues", "order_statues.Id = orders.StatusId")
            ->get($this->table)->result_array();
    }
    public function getStatus($id)
    {
        return $this->db->get_where("order_statues", ['Id' => $id])->row_array();
    }
    public function getAllStatus()
    {
        return $this->db->order_by("StatusCode")->get("order_statues")->result_array();
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
