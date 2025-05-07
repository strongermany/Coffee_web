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
        $data = array(
            'sliders' => $this->sliderModel->getActiveSliders()
        );
        $this->load->view('header', $this->headerData);
        //$this->load->view('slider', $data);
        $this->load->view('HomeView');
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
        $this->load->view('header', $this->headerData);
        $this->load->view('menu', $data);
        $this->load->view('footer');
    }   

    public function category($category_id = null){
        $this->headerData = $this->getAllHeader();
        $data = array( 'sliders' => $this->sliderModel->getActiveSliders());
        $data['products'] = $this->productModel->getProductsByCategory(16);
        $data['category_info'] = $this->categoryModel->getCategoryById(16);
        $this->load->view('header', $this->headerData);
        $this->load->view('slider', $data);
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
        
        $this->load->view('header', $this->headerData);
        $this->load->view('detailsProduct', $data);
        $this->load->view('footer');
    }
}
