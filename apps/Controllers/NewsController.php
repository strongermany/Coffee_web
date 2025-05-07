<?php
class NewsController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        return $this->homeBlog();
    }
    public function homeBlog()
    {
        $postModel = $this->load->model('PostModel');
        $posts = $postModel->getAllPosts();
        $data = ['posts' => $posts];
        $this->load->view('header');
        $this->load->view('slider');
        $this->load->view('mainNews', $data);
        $this->load->view('footer');
    }

    public function detailPost($id = null){
        $postModel = $this->load->model('PostModel');
        if ($id === null) {
            // Nếu không có id, chuyển về trang chủ hoặc trang blog
            header('Location: ' . Base_URL . 'NewsController/category');
            exit;
        }
        $post = $postModel->postById('tbl_post', 'Id_post = ' . intval($id));
        $data = ['post' => !empty($post) ? $post[0] : null];
        $this->load->view('header');
        $this->load->view('detailNews', $data);
        $this->load->view('footer');
    }
  
}
