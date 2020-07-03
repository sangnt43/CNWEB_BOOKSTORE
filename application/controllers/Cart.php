<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Book_Model", "repo");
    }
    public function index()
    {
        $data['recommendes'] = $this->repo->getRecommends();
        return $this->view("index", $data);
    }
    public function checkout()
    {
        if ($this->input->post("fromCart") == "") redirect(base_url());

        $res = $this->repo->getByList($this->input->post("id"));
        $quantity = $this->input->post("quantity");

        $total = 0;

        array_walk($res, function (&$item, $index) use ($quantity, &$total) {
            $item['Total'] = $item['Price'] * $quantity[$index] * (1 - ($item['Discount'] ? $item['Discount'] / 100 : 0));
            $item['Quantity'] = $quantity[$index];
            $total += $item['Total'];
        });

        $this->load->model("Payment_Model");

        $data = [
            "books" => $res,
            "total" => $total,
            "payments" => $this->Payment_Model->get()
        ];

        if (!empty(currentUser()))
            $data['user'] = currentUser();

        return $this->view("checkout", $data);
    }
    public function checkout_()
    {
        if (empty($this->input->post())) redirect(base_url());
        $this->load->model("Voucher_Model");
        $this->load->model("Order_Model");


        $data = [

            "Id" => ObjectId(),
            "Total" => $this->input->post("total"),
            "PaymentId" => $this->input->post("payment_type"),
            "CustomerInfo_FullName" => $this->input->post("fullname"),
            "CustomerInfo_Address" => $this->input->post("address"),
            "CustomerInfo_ShippingPrice" => 0,
            "CustomerInfo_Phone" => $this->input->post("phone"),
            "CustomerInfo_Email" => $this->input->post("email"),
            "CreatedDate" => date("Y-m-d H:i:s"),
            "UpdatedDate" =>  date("Y-m-d H:i:s")

        ];

        if (!empty(currentUser()))
            $data['CustomerInfo_Id'] = currentUser()['Id'];

        if ($this->input->post("voucher") == "") {
            $res = $this->Voucher_Model->get($this->input->post("voucher"));
            if (!empty($res)) {
                $data['Total'] = $data['Total'] * (1 - $res['Discount']);
                $data['Voucher'] = $res['Code'];
            }
        }

        $res = $this->Order_Model->save($data);

        if ($res) {
            $_res = $this->Order_Model->addList(array_map(function ($book, $quantity) use ($data) {
                return [
                    "OrderId" => $data['Id'],
                    "BookId" => $book,
                    "Quantity" => $quantity
                ];
            }, $this->input->post("books"), $this->input->post("quantities")));

            $this->session->set_flashdata("remind", [
                "success" => "1",
                "message" => "Thanh toán thành công",
                "type" => "success",
                "script" => "<script>localstore.clear();</script>"
            ]);
            redirect(base_url());
        } else {
            $this->session->set_flashdata("remind", [
                "success" => "0",
                "message" => "Thanh toán thất bại",
                "type" => "danger"
            ]);
            redirect(base_url("cart"));
        }
    }
}
