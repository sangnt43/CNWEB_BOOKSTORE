<?php defined('BASEPATH') or exit('No direct script access allowed');

class Book_Model extends My_Model
{
    public function __construct()
    {
        parent::__construct("books");
    }
    private function __mapImage($img)
    {
        return base_url("publics/$img");
    }
    private function _mapData($data, $isShort = true)
    {
        if (!isset($data)) return;
        
        if (isset($data['Id'])) {
            $data['Avatar'] = $this->__mapImage($data['Avatar']);
            $data['Seo'] = base_url("$data[Seo]");
            if (!empty($data['Images']))
                $data['Images'] = array_map(array($this, "__mapImage"), explode(',', $data['Images']));
            if ($isShort && strlen($data['Name']) > 20) {
                $data['Name'] = substr($data['Name'], 0, 20) . "...";
            }
        } else {
            $data = array_map(array($this, "_mapData"), $data);
        }
        return $data;
    }
    public function getRecommends()
    {
        // return $;
        return $this->_mapData(
            $this->db
                ->limit(5, 0)
                ->order_by("Count_Buy", "DESC")
                ->get($this->table)
                ->result_array()
        );
    }

    public function getTopBuy()
    {
        return
            $this->_mapData(
                $this->db
                    ->limit(20, 0)
                    ->order_by("Count_Buy")
                    ->get("books")
                    ->result_array()
            );
    }

    public function get(string $id = null)
    {
        if ($id == null)
            return $this->_mapData(
                $this->db->get($this->table)->result_array()
            );
        return
            $this->_mapData(
                $this->db
                    ->select([
                        "books.*",
                        "book_authors.Name as Auth",
                        "book_categories.Name as Category_Name",
                        "book_categories.Seo as Category_Seo",
                        "publishers.Name as Publisher"
                    ])
                    ->join("book_authors", "book_authors.Id = books.Info_Auth")
                    ->join("book_categories", "book_categories.Id = books.BookCategoryId")
                    ->join("publishers", "publishers.Id = books.Info_PublisherId")
                    ->get_where($this->table, ["books.Id" => $id])->row_array(),
                false
            );
    }

    public function page($page = 1)
    {
        return
            $this->_mapData(
                $this->db
                    ->limit(20, ($page - 1) * 20)
                    ->get($this->table)
                    ->result_array()
            );
    }

    public function search($key, $limit = null)
    {
        $data = $this->db;
        if ($limit != null) $data = $data->limit($limit, 0);

        return $this->_mapData(
            $data->get_where("books", "Name like N'%$key%'")
        );
    }

    public function getByCategory($categoryId)
    {
        return
            $this->_mapData(
                $this->db
                    ->get_where($this->table, ["BookCategoryId" => $categoryId])
                    ->result_array()
            );
    }

    public function getBySeo($categoryId, $seo)
    {
        return
            $this->_mapData(
                $this->db
                    ->get_where($this->table, ["Seo" => $seo, "BookCategoryId" => $categoryId])
                    ->row_array()
            );
    }
}
