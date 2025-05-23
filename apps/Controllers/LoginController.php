<?php
    class LoginController extends BaseController{
        

        public function __construct(){
            $message = array();
            parent:: __construct();
            
        }
        public function index(){
            Session::init();
            if(Session::get('login') == true) {
                header("Location:".Base_URL."LoginController/Dashboard");
            }
            $this->load->view('cpanel/login');
        }
        public function login() {
                   
           
            session::init();
            if(Session::get('login')== true){
                header("Location:".Base_URL."LoginController/Dashboard");
            }
            $this->load->view('cpanel/login'); 
            
         }


        public function Dashboard(){
            Session::checkSession();
            $this->load->view('cpanel/menu');
        }
        public function authentication_login(){
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $table_admin = 'tbl_admin';
            $loginmodel = $this->load->model('LoginModel');
            
            $count = $loginmodel->login($table_admin, $username, $password);
            if($count == 0) {
                $message['msg'] = 'Username or password is incorrect';
                header("Location:".Base_URL."LoginController");
            } else {
                $result = $loginmodel->getLogin($table_admin, $username, $password);
                Session::init();
                Session::set('login', true);
                Session::set('admin_name', $result[0]['admin_name']);
                Session::set('admin_id', $result[0]['admin_id']);
                header("Location:".Base_URL."SliderController/add");
            }
        }
        public function logout(){
            Session::init();
            Session::destroy();
            header("Location:".Base_URL."index");
           
        }

        public function choice() {
            $this->load->view('login_choice');
        }

        public function customer() {
            $this->load->view('login', ['type' => 'customer']);
        }

        public function admin() {
            $this->load->view('login', ['type' => 'admin']);
        }

    }

?>