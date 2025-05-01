<?php
class CustomerLoginController extends BaseController {
    private $customerModel;

    public function __construct() {
        parent::__construct();
        $this->customerModel = $this->load->model('CustomerModel');
    }

    public function index() {
        Session::init();
        // Nếu đã đăng nhập thì chuyển về trang chủ
        if(Session::get('customer_login')) {
            header("Location:" . Base_URL . "index");
            exit();
        }
        $this->load->view('login', ['type' => 'customer']);
    }

    public function authentication_login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $result = $this->customerModel->checkLogin($email, $password);
        
        if($result) {
            Session::init();
            // Lưu thông tin đăng nhập vào session
            Session::set('customer_login', true);
            Session::set('customer_id', $result[0]['customer_id']);
            Session::set('customer_name', $result[0]['customer_name']);
            Session::set('customer_email', $result[0]['email']);

            // Chuyển hướng về trang chủ
            header("Location:" . Base_URL . "index");
        } else {
            // Nếu đăng nhập thất bại, quay lại trang đăng nhập với thông báo lỗi
            $message['msg'] = "Email hoặc mật khẩu không đúng";
            header("Location:" . Base_URL . "CustomerLoginController?error=1");
        }
    }

    public function logout() {
        Session::init();
        // Chỉ xóa session của khách hàng
        Session::unset('customer_login');
        Session::unset('customer_id');
        Session::unset('customer_name');
        Session::unset('customer_email');
        header("Location:" . Base_URL . "index");
    }

    public function register() {
        $this->load->view('register');
    }

    public function processRegister() {
        $data = [
            'customer_name' => $_POST['customer_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'password' => $_POST['password'],
            'address' => $_POST['address'] ?? ''
        ];

        // Kiểm tra email đã tồn tại chưa
        if($this->customerModel->checkEmailExists($data['email'])) {
            header("Location:" . Base_URL . "CustomerLoginController/register?error=email_exists");
            exit();
        }

        $result = $this->customerModel->insertCustomer($data);
        
        if($result) {
            // Đăng nhập luôn sau khi đăng ký thành công
            Session::init();
            Session::set('customer_login', true);
            Session::set('customer_id', $result);
            Session::set('customer_name', $data['customer_name']);
            Session::set('customer_email', $data['email']);
            
            header("Location:" . Base_URL . "index");
        } else {
            header("Location:" . Base_URL . "CustomerLoginController/register?error=failed");
        }
    }
}
?> 