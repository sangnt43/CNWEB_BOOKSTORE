<?php
class Banner extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Banner_model", "Banner");
    }
    public function getAll()
    {
        $res = $this->Banner->get();
        for ($i = 0; $i < count($res); $i++)
            if (isset($res[$i]['image']))
                $res[$i]['image'] = $res[$i]['image'] . "?" . time();
        echo json_encode(["data" => $res]);
    }
    public function getById($id)
    {
        $data = $this->Banner->getById($id);
        if ($data == NULL)
            return $this->response($this->json_data(0, "Thể loại không tồn tại"));
        if (isset($data['image']))
            $data['image'] = $data['image'] . "?" . time();
        return $this->response($this->json_data(1, "Tìm thấy", $data));
    }
    public function index()
    {
        $this->view("index");
    }
    public function add()
    {
        $this->view("add");
    }
    public function createBanner()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");

        $bannerC = [
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "url" => $this->input->post("url"),
            "deactiveDate" => $this->input->post("deactiveDate"),
            "activeDate" => $this->input->post("activeDate"),
            "type" => $this->input->post("type"),
            "isShowName" => $this->input->post("isShowName") == "true" ? 1 : 0,
            "isShowDescription" => $this->input->post("isShowDescription") == "true" ? 1 : 0,
            "sortOrder" => $this->input->post("sortOrder")
        ];

        if ($bannerC['name'] == "" || $bannerC['activeDate'] == "" || $bannerC['type'] == "")
            return $this->response($this->json_data(0, "Thêm banner thất bại"));

        $tmpAvatar = uploadImage("image", "banners", "tmp_" . time());

        try {
            $res = $this->Banner->create($bannerC);

            moveFile($tmpAvatar, $res['image']);

            return $this->response($this->json_data(1, "Thêm banner thành công", ["returnUrl" => base_url("Admin/Banner")]));
        } catch (Exception $e) {
            unlink(PUBPATH . $tmpAvatar);
            return $this->response($this->json_data(0, "Thêm banner thất bại"));
        }
    }
    public function edit($id)
    {
        if (!isset($id)) redirect("Admin/Banner");
        $this->view("edit", ['id' => $id]);
    }
    public function updateBanner($id)
    {
        if (!isset($id)) return;
        $image = uploadImage("image", "banners", $id);
        if (empty($this->input->post()) && !isset($image)) return new ErrorException("Not Found", "0");

        $banner = ($this->input->post());
        $banner['isShowName'] = $banner['isShowName'] == 'true' ? 1 : 0;
        $banner['isShowDescription'] = $banner['isShowDescription'] == 'true' ? 1 : 0;
        if (isset($image))
            $banner['image'] = $image;

        $res = ($this->Banner->update($id, $banner));

        if ($res == NULL)
            return $this->response($this->json_data(0, "Cập nhật banner thất bại"));

        return $this->response($this->json_data(1, "Cập nhật banner thành công", ["returnUrl" => base_url("Admin/Banner")]));
    }
    public function changeShow()
    {
        if (empty($this->input->post())) return new ErrorException("Not Found", "0");

        if ($this->input->post("ShowName") != '')
            $data = ["isShowName" => $this->input->post("ShowName")];
        else if ($this->input->post("ShowDescription") != '')
            $data = ["isShowDescription" => $this->input->post("ShowDescription")];

        if ($this->Banner->changeShow($this->input->post("id"), $data) != NULL)
            return  $this->response($this->json_data(1, "Cập nhật trạng thái thành công"));
        else $this->response($this->json_data(0, "Cập nhật trạng thái thất bại"));
    }
    public function delete($id)
    {
        if (!isset($id)) return;
        if ($this->Banner->delete($id) != NULL)
            return  $this->response($this->json_data(1, "Xóa thể loại banner thành công"));
        else $this->response($this->json_data(0, "Xóa thể loại banner thất bại"));
    }
}
