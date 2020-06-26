<?php defined('BASEPATH') or exit('No direct script access allowed');

class BookCategory_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("book_categories");
    }
    public function getBySeo($seo)
    {
        return $this->db
            ->get_where($this->table, ["Seo" => $seo])->row_array();
    }
}
