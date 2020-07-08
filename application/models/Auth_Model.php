<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("book_authors");
    }

    public function create($data)
    {
        $id = ObjectId();
        $code = str_replace(" ", "", strtolower($data));
        $res = parent::create([
            "Id" => $id,
            "Name" => $data,
            "Code" => $code
        ]);
        if ($res != 0) return $id;
        return NULL;
    }
}
