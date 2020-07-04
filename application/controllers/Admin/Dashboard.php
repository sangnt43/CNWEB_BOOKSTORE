<?php 

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->session->set_flashdata("remind", [
            "success" => "1",
            "message" => "Thanh toán thành công",
            "type" => "success",
            "script" => "<script>localStorage.clear();</script>"
        ]);
        redirect(base_url());
    }
}