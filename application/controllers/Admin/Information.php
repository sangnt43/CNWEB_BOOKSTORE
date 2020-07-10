<?php
class Information extends My_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->__LAYOUT__ = "main";
        $this->load->model("Information_model", "repo");
    }

    public function index()
    {
        $data['informations'] = $this->repo->get();
        return $this->view("index", $data);
    }

    public function edit($id)
    {
        $data['information'] = $this->repo->get($id);

        if (empty($data['information']))
            redirect(base_url("Admin/Information"));

        if (!empty($this->input->post())) {
            $res = $this->_edit($id);

            if (empty($res)) redirect(base_url("Admin/Information")); // added
            else $data['error'] = $res;
        }

        return $this->view("edit", $data);
    }

    private function _edit($id)
    {
        $error = [];

        $information = [
            "Content" => $this->input->post("Content"),
        ];

        $res = $this->repo->update($id, $information);

        if ($res == 0) $error['data'] = $information;

        return $error;
    }
}
