<?php

class Group_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("groups");
    }
    public function removeUser($userList)
    {
        $userList = array_map(function ($e) {
            return "'$e'";
        }, $userList);
        $this->db->where("Id in(" . join(",", $userList) . ")")->update("admins", ['GroupId' => "111111111111111111111111"]);
        return $this->db->affected_rows();
    }
    public function addUser($groupId, $userList)
    {
        $userList = array_map(function ($e) {
            return "'$e'";
        }, $userList);
        $this->db->where("Id in(" . join(",", $userList) . ")")->update("admins", ['GroupId' => $groupId]);
        return $this->db->affected_rows();
    }
}
