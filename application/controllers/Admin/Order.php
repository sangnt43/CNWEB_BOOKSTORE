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
        $data['orders'] =  $this->order->getAllShort();
        $this->view("index", $data);
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
    public function getAllStatus()
    {
        echo json_encode($this->order->getAllStatus());
    }
    public function changeStatus($orderId, $statusId)
    {
        $res = $this->order->update($orderId, [
            "StatusId" => $statusId
        ]);
        $status = $this->order->getStatus($statusId);
        if ($res != 0) {
            echo json_encode(['exitcode' => 200, "status" => $status]);
        } else echo json_encode(['exitcode' => 204]);
    }
}
