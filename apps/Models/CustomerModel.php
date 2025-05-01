<?php
class CustomerModel extends BaseModel {
    private $table = 'tbl_customer';

    public function __construct() {
        parent::__construct();
    }

    // Lấy thông tin khách hàng theo ID
    public function getCustomerById($customer_id) {
        $sql = "SELECT * FROM $this->table WHERE customer_id = ?";
        return $this->db->select($sql, [$customer_id]);
    }

    // Lấy thông tin khách hàng theo email
    public function getCustomerByEmail($email) {
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        return $this->db->select($sql, [$email]);
    }

    // Cập nhật thông tin khách hàng
    public function updateCustomer($data, $customer_id) {
        return $this->db->update($this->table, $data, "customer_id = :customer_id", [':customer_id' => $customer_id]);
    }

    // Thêm khách hàng mới (đăng ký)
    public function insertCustomer($data) {
        return $this->db->insert($this->table, $data);
    }

    // Đổi mật khẩu
    public function changePassword($customer_id, $new_password) {
        $updateData = [
            'password' => $new_password
        ];
        return $this->db->update($this->table, $updateData, "customer_id = :customer_id", [':customer_id' => $customer_id]);
    }

    // Kiểm tra đăng nhập
    public function checkLogin($email, $password) {
        $sql = "SELECT * FROM $this->table WHERE email = ? AND password = ?";
        return $this->db->select($sql, [$email, $password]);
    }

    // Kiểm tra email tồn tại
    public function checkEmailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM $this->table WHERE email = ?";
        $result = $this->db->select($sql, [$email]);
        return $result[0]['count'] > 0;
    }

    // Lấy danh sách khách hàng (cho admin)
    public function getAllCustomers() {
        $sql = "SELECT * FROM $this->table";
        return $this->db->select($sql);
    }

    // Xóa khách hàng
    public function deleteCustomer($customer_id) {
        return $this->db->delete($this->table, "customer_id = ?", [$customer_id]);
    }

    // Tìm kiếm khách hàng
    public function searchCustomers($keyword) {
        $sql = "SELECT * FROM $this->table WHERE customer_name LIKE ? OR email LIKE ?";
        $params = ["%$keyword%", "%$keyword%"];
        return $this->db->select($sql, $params);
    }

    // Đếm tổng số khách hàng
    public function countCustomers() {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->db->select($sql);
        return $result[0]['total'];
    }

    // Lấy khách hàng mới nhất
    public function getRecentCustomers($limit = 5) {
        $sql = "SELECT * FROM $this->table ORDER BY customer_id DESC LIMIT ?";
        return $this->db->select($sql, [$limit]);
    }
}
