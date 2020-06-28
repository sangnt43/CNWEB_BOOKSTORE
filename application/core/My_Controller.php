<?php defined('BASEPATH') or exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    protected $__LAYOUT__;
    protected $__TITLE__;
    protected $__NAVI__;
    protected $__FOLDER__;
    private   $__BREADCRUM__;

    public function __construct()
    {
        $this->__TITLE__ = get_class($this);
        $this->__FOLDER__ = $this->__NAVI__ = strtolower(get_class($this));

        parent::__construct();

        $this->push_breadcrum(get_class($this), get_class($this));
    }

    protected function view($view = "index", $data = [])
    {
        $data['_title_'] = $this->__TITLE__;

        if (isset($data['navi'])) {
            $this->session->set_flashdata('_navi_', join('_', [$this->__NAVI__, $data['navi']]));
            unset($data['navi']);
        } else
            $this->session->set_flashdata('_navi_', join('_', [$this->__NAVI__, strtolower($view)]));

        if (!empty($this->__BREADCRUM__))
            $data['breadcrumbs'] = $this->__BREADCRUM__;

        if (isset($this->__FOLDER__)) $view = "$this->__FOLDER__/$view";

        $data['_js_'] = "$view/js";

        if (isset($this->__LAYOUT__)) {
            $data['_view_'] = "$view/view";
            $view = "layouts/$this->__LAYOUT__";
        } else $view = "$view/view";

        $this->load->view($view, $data);
    }

    protected function response($data)
    {
        $data['_title_'] = $this->__TITLE__;

        if (!empty($this->__BREADCRUM__))
            $data['breadcrumbs'] = $this->__BREADCRUM__;

        echo json_encode($data);
    }

    protected function clear_breadcrum($name = null, $url = null)
    {
        $this->__BREADCRUM__ = [];
        if ($name != null)
            $this->push_breadcrum($name, $url);
    }

    protected function push_breadcrum($name, $url = null)
    {
        $this->__BREADCRUM__[] = [
            "name" => $name,
            "url" => $url == null ? null : $url
        ];
    }
}
