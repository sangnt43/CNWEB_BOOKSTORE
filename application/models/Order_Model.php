<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("infomations");
    }
    public function get(?string $id = null)
    {
        return [
            "Id" => $id,
            "TransactionId" => $id,
            "CustomerInfo_Id" => 123,
            "CustomerInfo_FullName" => "admin",
            "CustomerInfo_Address" => "test",
            "CustomerInfo_ShippingPrice" => 5,
            "CustomerInfo_Phone" => 12345678,
            "CustomerInfo_Email" => "admin@admin.com",
            "Status" => 1,
            "Voucher" => null,
            "Total" => 125,
            "CreateDate" => time(),
            "UpdateDate" => time()
        ];
    }
    public function getBooksByOrder($id)
    {
        return [
            [
                "Name" => "The Ring of Truth",
                "Price" => 10,
                "Quantity" => 1
            ],
            [
                "Name" => "How To Be A Bwase",
                "Price" => 10,
                "Quantity" => 2
            ]
        ];
    }
}
