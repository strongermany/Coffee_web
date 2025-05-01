<?php
class index extends BaseController
{
    private $sliderModel;
    private $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = $this->load->model('SliderModel');
        $this->productModel = $this->load->model('ProductModel');
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
        $this->load->view('slider', $data);
        $this->load->view('HomeView');
        $this->load->view('footer');
    }

    public function menu(){
        $this->headerData = $this->getAllHeader();
        $this->load->view('header', $this->headerData);
        $this->load->view('menu');
        $this->load->view('footer');
    }   

    public function category($category_id = null){
        $this->headerData = $this->getAllHeader();
        $data = array( 'sliders' => $this->sliderModel->getActiveSliders());
        
        if($category_id) {
            $data['products'] = $this->productModel->getProductsByCategory($category_id);
            $data['category_info'] = $this->categoryModel->getCategoryById($category_id);
        } else {
            $data['products'] = $this->productModel->getAllProducts();
        }
        
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
