<?php defined('BASEPATH') or exit('No direct script access allowed');

class Payment_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("payment_type");
    }
}
