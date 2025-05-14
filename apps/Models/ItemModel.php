<?php
class ItemModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getAllItems() {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                ORDER BY i.id_item DESC";
        return $this->db->select($sql);
    }

    public function getItemsByCategory($category_id) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.id_category_item = ?";
        return $this->db->select($sql, [$category_id]);
    }

    public function getItemById($id) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.id_item = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function getRelatedItems($item_id) {
        $item = $this->getItemById($item_id);
        if (!$item) return [];

        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.id_category_item = ? 
                AND i.id_item != ? 
                LIMIT 4";
        return $this->db->select($sql, [$item['id_category_item'], $item_id]);
    }

    public function searchItems($keyword) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.title_item LIKE ? 
                OR i.desc_item LIKE ? 
                OR c.name_cate_item LIKE ?";
        $params = ["%$keyword%", "%$keyword%", "%$keyword%"];
        return $this->db->select($sql, $params);
    }

    public function getItemsByPriceRange($min_price, $max_price) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.price_item BETWEEN ? AND ?";
        return $this->db->select($sql, [$min_price, $max_price]);
    }

    public function getLatestItems($limit = 8) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                ORDER BY i.id_item DESC 
                LIMIT ?";
        return $this->db->select($sql, [$limit]);
    }

    public function getFeaturedItems($limit = 4) {
        $sql = "SELECT i.*, c.name_cate_item 
                FROM tbl_items i 
                LEFT JOIN tbl_category_items c ON i.id_category_item = c.id_cate_item 
                WHERE i.quantity_item > 10 
                ORDER BY i.id_item DESC 
                LIMIT ?";
        return $this->db->select($sql, [$limit]);
    }

    public function insertItem($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function updateItem($table, $data, $cond) {
        return $this->db->update($table, $data, $cond);
    }

    public function deleteItem($table, $cond) {
        return $this->db->delete($table, $cond);
    }

    public function updateItemQuantity($item_id, $quantity) {
        $sql = "UPDATE tbl_items SET quantity_item = quantity_item - ? WHERE id_item = ? AND quantity_item >= ?";
        $data = ['quantity_item' => $quantity];
        $cond = "id_item = :item_id AND quantity_item >= :min_quantity";
        $condData = [':item_id' => $item_id, ':min_quantity' => $quantity];
        return $this->db->update('tbl_items', $data, $cond, $condData);
    }

    public function checkItemAvailability($item_id, $quantity) {
        $sql = "SELECT quantity_item 
                FROM tbl_items 
                WHERE id_item = ?";
        $result = $this->db->selectOne($sql, [$item_id]);
        return $result && $result['quantity_item'] >= $quantity;
    }
} 