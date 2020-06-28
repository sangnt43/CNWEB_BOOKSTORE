<?php defined('BASEPATH') or exit('No direct script access allowed');

class Contact_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("contacts");
    }
    public function get(?string $id = null)
    {
        if (empty($id))
            return $this->db->get($this->table);
        else return $this->db->get_where($this->table, ["Id" => $id]);
    }
    public function addContact($name, $email, $message)
    {
        $date = date("Y/m/d H:i:s");
        $ip = get_client_ip();
        $this->db->insert($this->table, [
            "Id" => ObjectId(),
            "Name" => $name,
            "Email" => $email,
            "Message" => $message,
            "Ip" => $ip,
            "PostDate" => $date
        ]);
        return $this->db->affected_rows();
    }
}
