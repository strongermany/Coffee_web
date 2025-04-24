<?php
class index extends BaseController
{
    private $sliderModel;

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = $this->load->model('SliderModel');
    }
    public function index()
    {

        return $this->homePage();
    }
    public function homePage()
    {
        $data['sliders'] = $this->sliderModel->getActiveSliders();
        $this->load->view('header');
        $this->load->view('slider', $data);
        $this->load->view('HomeView');
        $this->load->view('footer');
    }

    public function category(){
        $this->load->view('header');
        $this->load->view('slider');
        $this->load->view('categoryProduct');
        $this->load->view('footer');
    }
    public function notFound()
    {

        $this->load->view('header');
        $this->load->view('404');
        $this->load->view('footer');
    }

    public function detailsProduct(){
        $this->load->view('header');
        $this->load->view('slider');
        $this->load->view('detailsProduct');
        $this->load->view('footer');
    }
}