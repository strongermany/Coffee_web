<?php

    class CartController extends BaseController{
        protected $data = array();
        private $productModel;
        private $cartModel;

        public function __construct(){
            parent::__construct();
            $this->productModel = $this->load->model('ProductModel');
            $this->cartModel = $this->load->model('CartModel');
        }
        
        public function index(){
            Session::init();
            $this->bag();
        }
        
        public function bag(){
            Session::init();
            $customerId = Session::get('customer_id');
            $cartItems = [];
            $total = 0;
            $cart_count = 0;
            $customerInfo = null;
            if ($customerId) {
                $items = $this->cartModel->getCartItems($customerId);
                foreach ($items as $item) {
                    if (!isset($item['name']) || !isset($item['price'])) continue;
                    $cartItem = [
                        'product_id' => $item['product_id'] ?? $item['id_item'] ?? null,
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['quantity'] * $item['price']
                    ];
                    // Nếu là item thì truyền thêm images_item
                    if (($item['type'] ?? '') === 'item') {
                        $cartItem['images_item'] = $item['image'];
                    } else {
                        $cartItem['image'] = $item['image'];
                    }
                    $cartItems[] = $cartItem;
                    $total += $item['quantity'] * $item['price'];
                }
                $cart_count = $this->cartModel->getCartOrderCount($customerId);
                // Lấy thông tin khách hàng
                $customerModel = $this->load->model('CustomerModel');
                $customer = $customerModel->getCustomerById($customerId);
                if ($customer && isset($customer[0])) {
                    $customerInfo = $customer[0];
                }
            }
            $data = [
                'cartItems' => $cartItems,
                'total' => $total,
                'customerInfo' => $customerInfo
            ];
            $this->headerData['cart_count'] = $cart_count;
            $this->load->view('subheader', $this->headerData);
            $this->load->view('cart', $data);
            $this->load->view('footer');
        }

        public function add($id) {
            Session::init();
            $response = ['success' => false];
            $customerId = Session::get('customer_id');
            $type = isset($_GET['type']) ? $_GET['type'] : 'product'; // mặc định là product

            if (!$customerId) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'redirect' => Base_URL . 'LoginController/choice',
                    'message' => 'Bạn cần đăng nhập để thêm vào giỏ hàng'
                ]);
                exit();
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $quantity = 0;
                $input = json_decode(file_get_contents('php://input'), true);
                if (isset($input['quantity']) && is_numeric($input['quantity']) && $input['quantity'] > 0) {
                    $quantity = (int)$input['quantity'];
                }
                if ($quantity <= 0) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => 'Số lượng sản phẩm không hợp lệ!'
                    ]);
                    exit();
                }

                if ($type === 'item') {
                    $itemModel = $this->load->model('ItemModel');
                    $item = $itemModel->getItemById($id);
                    if ($item) {
                        $this->cartModel->addToCart($customerId, $id, $quantity, 'item');
                        $cart_count = $this->cartModel->getCartCount($customerId);
                        $response = [
                            'success' => true,
                            'message' => 'Đã thêm item vào giỏ hàng',
                            'cart_count' => $cart_count
                        ];
                    } else {
                        $response['message'] = 'Item không tồn tại';
                    }
                } else {
                    $product = $this->productModel->getProductById($id);
                    if ($product) {
                        $this->cartModel->addToCart($customerId, $id, $quantity, 'product');
                        $cart_count = $this->cartModel->getCartCount($customerId);
                        $response = [
                            'success' => true,
                            'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                            'cart_count' => $cart_count
                        ];
                    } else {
                        $response['message'] = 'Sản phẩm không tồn tại';
                    }
                }
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        public function updateQuantity() {
            Session::init();
            $response = ['success' => false];
            $customerId = Session::get('customer_id');
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $customerId) {
                $productId = $_POST['product_id'];
                $quantity = (int)$_POST['quantity'];
                $product = $this->productModel->getProductById($productId);
                if ($product && $quantity > 0 && $quantity <= $product['Quantity_product']) {
                    $this->cartModel->updateCartQuantity($customerId, $productId, $quantity);
                    $subtotal = $quantity * $product['Price_product'];
                    $cart_count = $this->cartModel->getCartCount($customerId);
                    $response = [
                        'success' => true,
                        'subtotal' => number_format($subtotal, 0, ',', '.'),
                        'cart_count' => $cart_count
                    ];
                } else {
                    $response['message'] = 'Số lượng không hợp lệ';
                }
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        public function remove() {
            Session::init();
            $response = ['success' => false];
            $customerId = Session::get('customer_id');
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $customerId) {
                $productId = $_POST['product_id'];
                $this->cartModel->removeFromCart($customerId, $productId);
                $cart_count = $this->cartModel->getCartCount($customerId);
          
                $response = [
                    'success' => true,
                    'message' => 'Đã xóa sản phẩm khỏi giỏ hàng',
                    'cart_count' => $cart_count
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        public function checkout() {
            Session::init();
            if (!Session::get('customer_login')) {
                header('Location: ' . Base_URL . 'LoginController/choice');
                return;
            }
           
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $customerId = Session::get('customer_id');
                $totalAmount = 0;
                $orderItems = [];
                // Lấy giỏ hàng từ database
                $cartItems = $this->cartModel->getCartItems($customerId);
                
                if (empty($cartItems)) {
                    $this->setFlash('error', 'Giỏ hàng của bạn đang trống!');
                    
                    header('Location: ' . Base_URL . 'cart');
                    return;
                }
                // Calculate total and validate stock
                foreach ($cartItems as $item) {
                    if (isset($item['product_id']) && $item['product_id']) {
                        $product = $this->productModel->getProductById($item['product_id']);
                        $totalAmount += $item['quantity'] * $product['Price_product'];
                        $orderItems[] = [
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $product['Price_product']
                        ];
                    } elseif (isset($item['item_id']) && $item['item_id']) {
                        $itemModel = $this->load->model('ItemModel');
                        $itemInfo = $itemModel->getItemById($item['item_id']);
                        $totalAmount += $item['quantity'] * $itemInfo['price_item'];
                        $orderItems[] = [
                            'item_id' => $item['item_id'],
                            'quantity' => $item['quantity'],
                            'price' => $itemInfo['price_item']
                        ];
                    }
                }
                // Create order
                $orderData = [
                    'customer_id' => $customerId,
                    'order_date' => date('Y-m-d H:i:s'),
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'shipping_address' => $_POST['customer_address'],
                    'payment_method' => $_POST['payment_method'],
                    'note' => isset($_POST['note']) ? $_POST['note'] : ''
                ];
                $orderId = $this->cartModel->insertOrder($orderData);
                if ($orderId) {
                    // Insert order items
                    foreach ($orderItems as $item) {
                        $itemData = [
                            'order_id' => $orderId,
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ];
                        if (isset($item['product_id'])) {
                            $itemData['product_id'] = $item['product_id'];
                            $this->cartModel->insertOrderItem($itemData);
                            $this->productModel->updateProductQuantity($item['product_id'], $item['quantity']);
                        } elseif (isset($item['item_id'])) {
                            $itemData['item_id'] = $item['item_id'];
                            $this->cartModel->insertOrderItem($itemData);
                            // Nếu muốn, update số lượng item ở đây
                            // $itemModel->updateItemQuantity($item['item_id'], $item['quantity']);
                        }
                    }
                    // Xóa giỏ hàng trong database
                    $this->cartModel->clearCart($customerId);
                    $this->updateCartCount($customerId);
                    $_SESSION['pending_order_id'] = $orderId; // Lưu lại order id để kiểm tra trạng thái
               
                    $this->setFlash('info', 'Vui lòng chờ admin xác nhận đơn hàng của bạn.');
                    
                    header('Location: ' . Base_URL . 'CartController/pendingOrder');
                    exit;
                } else {
                  
                    $this->setFlash('error', 'Có lỗi xảy ra khi đặt hàng');
                    header('Location: ' . Base_URL . 'CartController/listOrder');
                }
            }
        }
        
        private function updateCartCount($customerId = null) {
            $count = 0;
            if ($customerId) {
                $count = $this->cartModel->getCartCount($customerId);
            }
            $_SESSION['cart_count'] = $count;
        }
        
        private function setFlash($type, $message) {
            $_SESSION['flash'] = [
                'type' => $type,
                'message' => $message
            ];
        }

        public function listOrder() {
            Session::init();
            $customerId = Session::get('customer_id');
            $order = null;
            if ($customerId) {
                $order = $this->cartModel->getLatestOrderByCustomer($customerId);
            }
            $this->headerData['cart_count'] = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
            $data = ['order' => $order];
            $this->load->view('header', $this->headerData);
            $this->load->view('listOrdered', $data);
            $this->load->view('footer');
        }

        public function pendingOrder() {
           
            $this->load->view('pendingOrder');
        }

        public function checkOrderStatus() {
            Session::init();
            $orderId = isset($_SESSION['pending_order_id']) ? $_SESSION['pending_order_id'] : null;
          
            if ($orderId) {
                $order = $this->cartModel->getOrder($orderId);
            
                header('Content-Type: application/json');
                echo json_encode(['status' => $order['status']]);
            } else {
              
                echo json_encode(['status' => 'pending']);
            }
        }

      
    }

?>