<?php
    
    class BaseController {
        
        protected $load;
        protected $headerData;
        protected $categoryModel;
        protected $itemCategoryModel;
        public function __construct() {
            $this->load = new Load();
            $this->categoryModel = $this->load->model('CategoryModel');
            $this->itemCategoryModel = $this->load->model('CategoryItemModel');
            $this->headerData = $this->getAllHeader();
        }

        // Lấy dữ liệu dùng chung cho header
        protected function getAllHeader() {
            Session::init(); // Đảm bảo session luôn được khởi tạo
            $customerId = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;
            $cart_count = 0;
            if ($customerId) {
                $cartModel = $this->load->model('CartModel');
                $cart_count = $cartModel->getCartOrderCount($customerId);
            }
            
            $data = array(
                'categories' => $this->categoryModel->getAllCategories(), // Danh mục cho dropdown
                'item_categories' => $this->itemCategoryModel->getAllCategories(), // Danh mục vật phẩm cho dropdown
                'cart_count' => $cart_count,
                'is_logged_in' => isset($_SESSION['customer_login']) ? true : false,
                'customer_name' => isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '',
            );

            return $data;
        }

        // Helper method để load view với header data
        protected function viewWithHeader($view, $data = []) {
            // Merge header data với data truyền vào
            $viewData = array_merge($this->headerData, $data);
            $this->load->view($view, $viewData);
        }
    }

?>