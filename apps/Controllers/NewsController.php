<?php
class NewsController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->headerData = $this->getAllHeader();
    }
    public function index()
    {

        return $this->homeBlog();
    }
    public function homeBlog()
    {
        $postModel = $this->load->model('PostModel');
        $categoryModel = $this->load->model('CategoryModel');
        
        $posts = $postModel->getAllPosts();
        $categories = $categoryModel->postCategory('tbl_category_post');
        
        $data = [
            'posts' => $posts,
            'categories' => $categories
        ];
        
        $this->load->view('subheader', $this->headerData);
        //$this->load->view('slider');
        $this->load->view('mainNews', $data);
        $this->load->view('footer');
    }

    public function detailPost($id = null){
        $postModel = $this->load->model('PostModel');
        $categoryModel = $this->load->model('CategoryModel');
        if ($id === null) {
            // Nếu không có id, chuyển về trang chủ hoặc trang blog
            header('Location: ' . Base_URL . 'NewsController/category');
            exit;
        }
        $post = $postModel->postById('tbl_post', 'Id_post = ' . intval($id));
        $categories = $categoryModel->postCategory('tbl_category_post');
        $recentPosts = $postModel->getRecentPostsExcludeId('tbl_post', intval($id), 3);
        $data = [
            'post' => !empty($post) ? $post[0] : null,
            'categories' => $categories,
            'recentPosts' => $recentPosts
        ];
       
        $this->load->view('subheader',$this->headerData);
        //$this->load->view('slider');
        $this->load->view('detailNews', $data);
        $this->load->view('footer');
    }
  
}
