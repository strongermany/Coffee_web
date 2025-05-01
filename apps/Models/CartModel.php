<?php
class CartModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($customerId, $productId, $quantity = 1) {
        $sql = "SELECT * FROM tbl_cart WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId, $productId]);
        $item = $stmt->fetch();
        if ($item) {
            $sql = "UPDATE tbl_cart SET quantity = quantity + ? WHERE cart_id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$quantity, $item['cart_id']]);
        } else {
            $sql = "INSERT INTO tbl_cart (customer_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$customerId, $productId, $quantity]);
        }
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartQuantity($customerId, $productId, $quantity) {
        $sql = "UPDATE tbl_cart SET quantity = ? WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $customerId, $productId]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($customerId, $productId) {
        $sql = "DELETE FROM tbl_cart WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$customerId, $productId]);
    }

    // Lấy tất cả sản phẩm trong giỏ hàng của user
    public function getCartItems($customerId) {
        $sql = "SELECT c.*, p.* FROM tbl_cart c JOIN tbl_product p ON c.product_id = p.Id_product WHERE c.customer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId]);
        return $stmt->fetchAll();
    }

    // Lấy tổng số lượng sản phẩm trong giỏ hàng
    public function getCartCount($customerId) {
        $sql = "SELECT SUM(quantity) as total FROM tbl_cart WHERE customer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId]);
        $result = $stmt->fetch();
        return $result ? (int)$result['total'] : 0;
    }

    // Lấy tổng giá trị giỏ hàng
    public function getCartTotal($customerId) {
        $sql = "SELECT c.quantity, p.Price_product FROM tbl_cart c JOIN tbl_product p ON c.product_id = p.Id_product WHERE c.customer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId]);
        $items = $stmt->fetchAll();
        $total = 0;
        foreach ($items as $item) {
            $total += $item['quantity'] * $item['Price_product'];
        }
        return $total;
    }

    // Tạo đơn hàng mới
    public function createOrder($orderData) {
        // Thêm thông tin đơn hàng
        $sql = "INSERT INTO orders (customer_name, customer_phone, customer_email, 
                customer_address, total_amount, payment_method, note) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, 
            $orderData['customer_name'],
            $orderData['customer_phone'],
            $orderData['customer_email'],
            $orderData['customer_address'],
            $orderData['total_amount'],
            $orderData['payment_method'],
            $orderData['note']
        );
        
        $orderId = $this->db->lastInsertId();
        
        // Thêm chi tiết đơn hàng
        if ($orderId) {
            foreach ($_SESSION['cart'] as $item) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                        VALUES (?, ?, ?, ?)";
                $this->db->query($sql, 
                    $orderId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price']
                );
            }
            
            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            return $orderId;
        }
        return false;
    }

    // Lấy thông tin đơn hàng
    public function getOrder($orderId) {
        $sql = "SELECT * FROM orders WHERE order_id = ?";
        return $this->db->query($sql, $orderId)->fetch();
    }

    // Lấy chi tiết đơn hàng
    public function getOrderItems($orderId) {
        $sql = "SELECT oi.*, p.name, p.image 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.product_id 
                WHERE oi.order_id = ?";
        return $this->db->query($sql, $orderId)->fetchAll();
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $status) {
        $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
        return $this->db->query($sql, $status, $orderId);
    }

    // Thêm đơn hàng mới, trả về orderId
    public function insertOrder($orderData) {
        $fields = array_keys($orderData);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $sql = "INSERT INTO tbl_orders (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($orderData));
        return $this->db->lastInsertId();
    }

    // Thêm sản phẩm vào chi tiết đơn hàng
    public function insertOrderItem($itemData) {
        $fields = array_keys($itemData);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $sql = "INSERT INTO tbl_order_items (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(array_values($itemData));
    }
    public function getCartOrderCount($customerId) {
        $sql = "SELECT COUNT(*) as order_count FROM tbl_cart WHERE customer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId]);
        $result = $stmt->fetch();
       
        return $result ? (int)$result['order_count'] : 0;
    }
}
?> 