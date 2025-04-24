<?php
class HomeController extends BaseController {
    private $sliderModel;

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
        $data['sliders'] = $this->sliderModel->getActiveSliders();
        print("1");
        var_dump($data['sliders']);
        $this->load->view('header');
        //$this->load->view('slider', $data);
        $this->load->view('footer');
    }
} 