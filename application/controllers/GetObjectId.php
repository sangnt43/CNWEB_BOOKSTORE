<?php 

class GetObjectId extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        for($i = 0; $i < 30; $i++)
            $data[] = ObjectId();
            
        debug($data);
    }

}