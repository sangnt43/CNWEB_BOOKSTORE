<?php defined('BASEPATH') or exit('No direct script access allowed');

class Book_Model extends My_Model
{
    private $item_per_page = 20;

    public function __construct()
    {
        parent::__construct("books");
    }
    private function _mapImage($img)
    {
        return base_url("public/$img");
    }
    private function _map($data, $isShort = true)
    {
        if (!isset($data)) return;

        if (isset($data['Id'])) {
            $data['Avatar'] = $this->_mapImage($data['Avatar']);
            $data['Seo'] = empty(currentAdmin()) ? base_url("$data[Seo]") : $data['Seo'];
            if ($isShort == TRUE) {
                unset($data['Images']);
                unset($data['Info_Auth']);
                unset($data['Info_PublisherId']);
                $str = explode(' ', $data['Name']);

                if (empty(currentAdmin()) && count($str) > 4)
                    $data['Name'] = join(" ", array_splice($str, 0, 4)) . "...";
            }
            if (!empty($data['Images']) && empty(currentAdmin()))
                $data['Images'] = array_map(array($this, "_mapImage"), explode(',', $data['Images']));
            else if (!empty($data['Images']))
                $data['Images'] = explode(',', $data['Images']);
        } else {
            $data = array_map(array($this, "_map"), $data);
        }
        return $data;
    }
    public function getRecommends()
    {
        // return $;
        return $this->_map(
            $this->db
                ->limit(4, 0)
                ->order_by("Count_Buy", "DESC")
                ->get($this->table)
                ->result_array()
        );
    }

    public function getTopBuy()
    {
        return
            $this->_map(
                $this->db
                    ->limit(10, 0)
                    ->order_by("Count_Buy")
                    ->get("books")
                    ->result_array()
            );
    }

    public function get(string $id = null)
    {
        if ($id == null)
            return $this->_map(
                $this->db
                    ->order_by('books.Id', "DESC")
                    ->get($this->table)->result_array(),
                true
            );
        $data = $this->db
            ->select([
                "books.*",
                "book_authors.Name as Auth",
                "book_categories.Name as Category_Name",
                "book_categories.Seo as Category_Seo",
                "publishers.Name as Publisher"
            ])
            ->join("book_authors", "book_authors.Id = books.Info_Auth", "LEFT")
            ->join("book_categories", "book_categories.Id = books.BookCategoryId", "LEFT")
            ->join("publishers", "publishers.Id = books.Info_PublisherId", "LEFT")
            ->get_where($this->table, ["books.Id" => $id])->row_array();
        return $this->_map($data, false);
    }


    public function getAllShort()
    {
        return $this->_map(
            $this->db
                ->select("books.*,book_categories.Name as Category")
                ->join("book_categories", "books.BookCategoryId = book_categories.Id")
                ->get($this->table)->result_array(),
            true
        );
    }

    public function countPage($query = null)
    {
        if ($query == null)
            return ceil($this->db->from($this->table)->count_all_results() / $this->item_per_page);
        return ceil($query->count_all_results() / $this->item_per_page);
    }

    public function page($page = 1)
    {
        return [
            "totalPage" => $this->countPage($this->db->from($this->table)),
            "books" => $this->_map(
                $this->db->from($this->table)
                    ->order_by("Id", "Desc")
                    ->limit($this->item_per_page, ($page - 1) * $this->item_per_page)
                    ->get()->result_array()
            )
        ];
    }

    public function search($key, $page = 1, $limit = null)
    {
        $data = $this->db;
        if ($limit != null) {
            return  $this->_map(
                $data->limit($limit, 0)->get_where($this->table, "Name like N'%$key%'")->result_array()
            );
        }

        return [
            "totalPage" =>  $this->countPage($this->db->from($this->table)->where("Name like N'%$key%'")),
            "books" => $this->_map(
                $this->db
                    ->limit($this->item_per_page, ($page - 1) * $this->item_per_page)
                    ->get_where($this->table, "Name like N'%$key%'")
                    ->result_array()
            )
        ];
    }

    public function getByCategory($categoryId, $page = 1)
    {
        return [
            "totalPage" => $this->countPage(
                $this->db->from($this->table)->where(["BookCategoryId" => $categoryId])
            ),
            "books" => $this->_map(
                $this->db
                    ->limit($this->item_per_page, ($page - 1) * $this->item_per_page)
                    ->order_by("Id", "Desc")
                    ->get_where($this->table, ["BookCategoryId" => $categoryId])
                    ->result_array()
            )
        ];
    }

    public function getBySeo($categoryId, $seo)
    {
        return
            $this->_map(
                $this->db
                    ->get_where($this->table, ["Seo" => $seo, "BookCategoryId" => $categoryId])
                    ->row_array(),
                false
            );
    }

    public function getByList($array)
    {
        $array = array_map(function ($e) {
            return "'$e'";
        }, $array);
        return $this->_map(
            $this->db->query("SELECT * FROM books where Id in(" . join(',', $array) . ")")->result_array()
        );
    }
}
