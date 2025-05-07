<?php
class CustomerController extends BaseController {
    private $customerModel;
    private $cartModel;

    public function __construct() {
        parent::__construct();
        $this->customerModel = $this->load->model('CustomerModel');
        $this->cartModel = $this->load->model('CartModel');
    }

    // Hiển thị trang thông tin khách hàng
    public function index() {
        Session::init();
        if (!Session::get('customer_id')) {
            header("Location:" . Base_URL . "CustomerLoginController");
            exit();
        }
        
        $customer_id = Session::get('customer_id');
        $customerInfo = $this->customerModel->getCustomerById($customer_id);
        
        // Get customer's orders
        $orders = $this->cartModel->getAllOrders();
        $customerOrders = array_filter($orders, function($order) use ($customer_id) {
            return $order['customer_id'] == $customer_id;
        });

        // Get order items for each order
        $ordersWithItems = [];
        foreach ($customerOrders as $order) {
            $order['items'] = $this->cartModel->getOrderItems($order['order_id']);
            $ordersWithItems[] = $order;
        }

        $this->load->view('header');
        $this->load->view('customer', [
            'customerInfo' => $customerInfo[0],
            'orders' => $ordersWithItems
        ]);
        $this->load->view('footer');
    }

    // Xử lý cập nhật thông tin khách hàng
    public function updateProfile() {
        Session::init();
        $customer_id = Session::get('customer_id');
        
        if (!$customer_id) {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng đăng nhập']);
            exit();
        }

        $data = [
            'customer_name' => $_POST['customer_name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address']
        ];

        $result = $this->customerModel->updateCustomer($data, $customer_id);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Cập nhật thông tin thành công']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Cập nhật thông tin thất bại']);
        }
        exit();
    }

    // Xử lý đổi mật khẩu
    public function changePassword() {
        Session::init();
        $customer_id = Session::get('customer_id');
        
        if (!$customer_id) {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng đăng nhập']);
            exit();
        }

        $old_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        
        // Kiểm tra mật khẩu cũ
        $customerInfo = $this->customerModel->getCustomerById($customer_id);
        if ($customerInfo[0]['password'] != $old_password) {
            echo json_encode(['status' => 'error', 'message' => 'Mật khẩu cũ không đúng']);
            exit();
        }

        $result = $this->customerModel->changePassword($customer_id, $new_password);
        
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Đổi mật khẩu thành công']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Đổi mật khẩu thất bại']);
        }
    }

    // Hiển thị form chỉnh sửa thông tin
    public function editProfile() {
        Session::init();
        if (!Session::get('customer_id')) {
            header("Location:" . Base_URL . "CustomerLoginController");
            exit();
        }

        $customer_id = Session::get('customer_id');
        $customerInfo = $this->customerModel->getCustomerById($customer_id);

        $this->load->view('header');
        $this->load->view('editProfile', ['customerInfo' => $customerInfo[0]]);
        $this->load->view('footer');
    }

    // Hiển thị form đổi mật khẩu
    public function showChangePassword() {
        Session::init();
        if (!Session::get('customer_id')) {
            header("Location:" . Base_URL . "CustomerLoginController");
            exit();
        }

        $this->load->view('header');
        $this->load->view('change_password');
        $this->load->view('footer');
    }

    // Xử lý đăng xuất
    public function logout() {
        Session::init();
        Session::destroy();
        header("Location:" . Base_URL . "CustomerLoginController");
    }

    // Xử lý đăng ký khách hàng
    public function register_process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $phone = $_POST['phone'];

            // Kiểm tra mật khẩu xác nhận
            if ($password !== $confirm_password) {
                header("Location:" . Base_URL . "CustomerLoginController/register?error=Mật khẩu xác nhận không khớp");
                exit();
            }

            // Kiểm tra email đã tồn tại chưa
            if ($this->customerModel->checkEmailExists($email)) {
                header("Location:" . Base_URL . "CustomerLoginController/register?error=Email đã tồn tại");
                exit();
            }

            // Tạo dữ liệu khách hàng mới
            $data = [
                'customer_name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password // Trong thực tế nên mã hóa mật khẩu
            ];

            // Thêm khách hàng mới vào database
            $result = $this->customerModel->insertCustomer($data);

            if ($result) {
                // Đăng ký thành công, chuyển hướng đến trang đăng nhập
                header("Location:" . Base_URL . "CustomerLoginController?success=Đăng ký thành công");
            } else {
                header("Location:" . Base_URL . "CustomerLoginController/register?error=Đăng ký thất bại");
            }
            exit();
        }
    }
} 