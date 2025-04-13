<?php

    class cartController extends BaseController{
        protected $data = array();
        public function __construct(){
            parent::__construct();
            
        }
        
        public function index(){
            $this->bag();
        }
        
        public function bag(){
            $this->load->view('header');
            $this->load->view('cart');
            $this->load->view('footer');
            
        }
        
        
    }

?>