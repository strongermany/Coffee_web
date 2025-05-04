<?php
    class OrderController extends BaseController{
        public function __construct() {
            parent::__construct();
            Session::checkSession();
        }
        public function index(){
            return $this->order();
        }
        public function order(){
          
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/order/orderHandel');
            $this->load->view('cpanel/footer');
        }
        public function addOrder(){
            $cartModel = $this->load->model('CartModel');
            $orders = $cartModel->getAllOrders();
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/order/addOrder', ['orders' => $orders]);
            $this->load->view('cpanel/footer');
        }
        public function confirmPaid() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
                $orderId = $_POST['order_id'];
                $cartModel = $this->load->model('CartModel');
                $cartModel->updateOrderStatus($orderId, 'paid');
            }
            header('Location: ' . Base_URL . 'OrderController/addOrder');
            exit;
        }
    } 

?>