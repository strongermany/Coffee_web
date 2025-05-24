<?php
class index extends BaseController
{
    private $sliderModel;
    private $productModel;
    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = $this->load->model('SliderModel');
        $this->productModel = $this->load->model('ProductModel');
        $this->categoryModel = $this->load->model('CategoryModel');
    }
    public function index()
    {
        return $this->homePage();
    }
    public function homePage()
    {
        $this->headerData = $this->getAllHeader();
        $postModel = $this->load->model('PostModel');
        $latestNews = $postModel->getLatestPosts(3);
        $products = $this->productModel->getAllProducts();

        $data = array(
            'sliders' => $this->sliderModel->getActiveSliders(),
            'latestNews' => $latestNews,
            'products' => $products
        );
        $this->load->view('header', $this->headerData);
        
        $this->load->view('HomeView', $data);
        $this->load->view('slider', $data);
        $this->load->view('footer');
    }

    public function menu(){
        $this->headerData = $this->getAllHeader();
        $categories = $this->categoryModel->getAllCategories();
        $category_id = isset($_GET['category']) ? $_GET['category'] : null;
        if ($category_id) {
            $products = $this->productModel->getProductsByCategory($category_id);
        } else {
            $products = $this->productModel->getAllProducts();
        }
        $data = [
            'products' => $products,
            'categories' => $categories 
        ];
        $this->load->view('subheader', $this->headerData);
        $this->load->view('menu', $data);
        $this->load->view('footer');
    }   

    public function category($category_id = null){
        $this->headerData = $this->getAllHeader();
        $itemModel = $this->load->model('ItemModel');
        $categoryItemModel = $this->load->model('CategoryItemModel');
        $data = array('sliders' => $this->sliderModel->getActiveSliders());
        if ($category_id) {
            $data['items'] = $itemModel->getItemsByCategory($category_id);
            
            $data['category_info'] = $categoryItemModel->getCategoryById($category_id);
        } else {
            $data['items'] = $itemModel->getAllItems();
            $data['category_info'] = null;
        }
       
        $this->load->view('subheader', $this->headerData);
        $this->load->view('categoryProduct', $data);
        $this->load->view('footer');
    }
    public function notFound()

    {
        $this->headerData = $this->getAllHeader();
        $this->load->view('header', $this->headerData);
        $this->load->view('404');
        $this->load->view('footer');
    }

    public function detailsProduct($id = null){
        $this->headerData = $this->getAllHeader();
        if($id) {
            $data['product'] = $this->productModel->getProductById($id);
            $data['related_products'] = $this->productModel->getRelatedProducts($id);
        }
        
        $this->load->view('subheader', $this->headerData);
        $this->load->view('detailsProduct', $data);
        $this->load->view('footer');
    }

    public function detailsItem($id = null){
        $this->headerData = $this->getAllHeader();
        if($id) {
            $itemModel = $this->load->model('ItemModel');
            $data['item'] = $itemModel->getItemById($id);
            $data['related_items'] = $itemModel->getRelatedItems($id);
            // Nếu muốn có sản phẩm liên quan, có thể thêm:
            // $data['related_items'] = $itemModel->getRelatedItems($id);
        }
        $this->load->view('subheader', $this->headerData);
        $this->load->view('detailsItem', $data);
        $this->load->view('footer');
    }
    public function franchises()

    {
        $this->headerData = $this->getAllHeader();
        $this->load->view('subheader', $this->headerData);
        $this->load->view('franchises');
        $this->load->view('footer');
    }
}
