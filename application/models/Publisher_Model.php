<?php defined('BASEPATH') or exit('No direct script access allowed');

class Publisher_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("publishers");
    }
    public function create($data)
    {
        $id = ObjectId();
        $res = parent::create([
            "Id" => $id,
            "Name" => $data
        ]);

        if ($res != 0) return $id;
        return NULL;
    }
}
