<?php
class ProductModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getAllProducts() {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                ORDER BY p.Id_product DESC";
        return $this->db->select($sql);
    }

    public function getProductsByCategory($category_id) {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Id_category_product = ?";
        return $this->db->select($sql, [$category_id]);
    }

    public function getProductById($id) {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Id_product = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function getRelatedProducts($product_id) {
        $product = $this->getProductById($product_id);
        if (!$product) return [];

        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Id_category_product = ? 
                AND p.Id_product != ? 
                LIMIT 4";
        return $this->db->select($sql, [$product['Id_category_product'], $product_id]);
    }

    public function searchProducts($keyword) {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Title_product LIKE ? 
                OR p.Desc_product LIKE ? 
                OR c.Category LIKE ?";
        $params = ["%$keyword%", "%$keyword%", "%$keyword%"];
        return $this->db->select($sql, $params);
    }

    public function getProductsByPriceRange($min_price, $max_price) {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Price_product BETWEEN ? AND ?";
        return $this->db->select($sql, [$min_price, $max_price]);
    }

    public function getLatestProducts($limit = 8) {
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                ORDER BY p.Id_product DESC 
                LIMIT ?";
        return $this->db->select($sql, [$limit]);
    }

    public function getFeaturedProducts($limit = 4) {
        // Giả sử sản phẩm nổi bật là những sản phẩm có số lượng > 10
        $sql = "SELECT p.*, c.Category 
                FROM tbl_product p 
                LEFT JOIN tbl_category c ON p.Id_category_product = c.Id_Cate 
                WHERE p.Quantity_product > 10 
                ORDER BY p.Id_product DESC 
                LIMIT ?";
        return $this->db->select($sql, [$limit]);
    }

    public function updateProductQuantity($product_id, $quantity) {
        $sql = "UPDATE tbl_product SET Quantity_product = Quantity_product - ? WHERE Id_product = ? AND Quantity_product >= ?";
        $data = ['Quantity_product' => $quantity];
        $cond = "Id_product = :product_id AND Quantity_product >= :min_quantity";
        $condData = [':product_id' => $product_id, ':min_quantity' => $quantity];
        return $this->db->update('tbl_product', $data, $cond, $condData);
    }

    public function checkProductAvailability($product_id, $quantity) {
        $sql = "SELECT Quantity_product 
                FROM tbl_product 
                WHERE Id_product = ?";
        $result = $this->db->selectOne($sql, [$product_id]);
        return $result && $result['Quantity_product'] >= $quantity;
    }
} 