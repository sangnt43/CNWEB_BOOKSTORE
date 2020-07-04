<?php
class Order extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Order_Model", "order");
    }
    public function index()
    {
        $this->view("index");
    }
    public function getAll()
    {
        $this->response(["data" => $this->order->getAllShort()]);
    }
    public function getById($id)
    {
        if (!isset($id)) return;

        $data = $this->order->get($id);

        if ($data == NULL)
            return $this->response($this->json_data(0, "Đơn hàng không tồn tại"));

        $data['books'] = $this->order->getBooksByOrder($id);
        return $this->response($this->json_data(1, "Tìm thấy", $data));
    }
    public function delete($id)
    {
        if (!isset($id)) return;
        if ($this->order->delete($id) != NULL)
            return  $this->response($this->json_data(1, "Xóa đơn hàng thành công"));
        else $this->response($this->json_data(0, "Xóa đơn hàng thất bại"));
    }
    public function changeStatus()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");
        $data = [
            "code" => $this->input->post("statusId"),
            "title" => $this->input->post("statusText")
        ];
        if ($this->order->changeStatus($this->input->post("id"), $data) != NULL) {
            if ($data['code'] == 13) {
                $this->load->model('Product_model');
                $params = $this->order->getAllProductWithQuantity($this->input->post("id"));
                $this->Product_model->updateQuantity($params);
            }
            return $this->response($this->json_data(1, "Cập nhật trạng thái thành công"));
        } else $this->response($this->json_data(0, "Cập nhật trạng thái thất bại"));
    }
    public function changeQuick()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");
        $data = [
            "idGhn" => $this->input->post("idGhn")
        ];
        $res = $this->order->changeQuick($this->input->post("id"), $data);
        if ($res != NULL)
            return  $this->response($this->json_data(1, "Cập nhật trạng thái thành công", ['response' => $res]));
        else $this->response($this->json_data(0, "Cập nhật trạng thái thất bại"));
    }
}
