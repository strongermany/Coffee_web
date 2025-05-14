<?php
class CategoryItemModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM tbl_category_items ORDER BY id_cate_item DESC";
        return $this->db->select($sql);
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM tbl_category_items WHERE id_cate_item = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function insertCategory($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function updateCategory($table, $data, $cond) {
        return $this->db->update($table, $data, $cond);
    }

    public function deleteCategory($table, $cond) {
        return $this->db->delete($table, $cond);
    }
} 