<?php
class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function index()
    {
        $this->add_category_post();
    }

    public function add_category_post()
    {
        Session::checkSession();
        $data = [
            'currentPage' => 'blogs',
            'pageTitle' => 'Add Category Post',
            'viewFile' => 'cpanel/post/addCategoryPost',
            'load' => $this->load
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function insert_category_post()
    {
        Session::checkSession();
        $title = isset($_POST['Title']) ? trim($_POST['Title']) : '';
        
        $table = "tbl_category_post";
        $data = array(
            'Title_category_post' => $title
        );
        
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->InsertCategoryPost($table, $data);
        
        if ($result == 1) {
            $message['msg'] = "Adding category post was successful.";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Adding category post was unsuccessful.";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urlencode(serialize($message)));
        }
    }

    public function list_category_post()
    {   
        Session::checkSession();
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $categories = $categoryModel->postCategory($table);
        
        $data = [
            'currentPage' => 'blogs',
            'pageTitle' => 'Category Post List',
            'viewFile' => 'cpanel/post/listCategoryPost',
            'load' => $this->load,
            'data' => ['category' => $categories]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function delete_category_post($id)
    {
        Session::checkSession();
        $cond = "Id_category_post = '$id'";
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->DeleteCategoryPost($table, $cond);

        if ($result == 1) {
            $message['msg'] = "Deleting category post was successful.";
            header('Location:' . Base_URL . "PostController/list_category_post?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Deleting post category was unsuccessful.";
            header('Location:' . Base_URL . "PostController?msg=" . urlencode(serialize($message)));
        }
    }

    public function edit_category_post($id)
    {
        Session::checkSession();
        $cond = "Id_category_post = $id";
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $categoryById = $categoryModel->cateByIdPost($table, $cond);
        
        $data = [
            'currentPage' => 'blogs',
            'pageTitle' => 'Edit Category Post',
            'viewFile' => 'cpanel/post/editCategoryPost',
            'load' => $this->load,
            'data' => ['categoryById' => $categoryById]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function update_category_post($id)
    {
        Session::checkSession();
        $cond = "Id_category_post = $id";
        $table = "tbl_category_post";

        $title = $_POST['Title'];
        $content = $_POST['Content'];
        $data = array(
            'Title_category_post' => $title,
            'Content_category_post' => $content
        );
        
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->UpdateCategoryPost($table, $data, $cond);
        
        if ($result == 1) {
            $message['msg'] = "Update category post was successful.";
            header('Location:' . Base_URL . "PostController/list_category_post?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Update category post was unsuccessful.";
            header('Location:' . Base_URL . "PostController?msg=" . urlencode(serialize($message)));
        }
    }

    public function add_post()
    {
        Session::checkSession();
        $postModel = $this->load->model('PostModel');
        $posts = $postModel->getAllPosts();
        $categoryModel = $this->load->model('CategoryModel');
        $categories = $categoryModel->postCategory('tbl_category_post');
        $data = [
            'currentPage' => 'blogs',
            'pageTitle' => 'Add Post',
            'viewFile' => 'cpanel/post/addPost',
            'load' => $this->load,
            'data' => [
                'post' => $posts,
                'categories' => $categories
            ]
        ];
        $this->load->view('cpanel/menu', $data);
    }

    public function insert_post()
    {
        Session::checkSession();
        $title = $_POST['title_post'];
        $content = $_POST['content_post'];
        $image = $_FILES['image_post']['name'];
        $tmp_img = $_FILES['image_post']['tmp_name'];
        $id_category_post = isset($_POST['Id_category_post']) ? intval($_POST['Id_category_post']) : null;

        $div = explode('.',$image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads = "public/uploads/post/".$unique_image;
        
        if (move_uploaded_file($tmp_img, $path_uploads)) {
            $postModel = $this->load->model('PostModel');
            $data = array(
                'Title_post' => $title,
                'Content_post' => $content,
                'Image_post' => $unique_image,
                'Id_category_post' => $id_category_post
            );
            
            $result = $postModel->InsertPost('tbl_post', $data);
            if ($result == 1) {
                $message['msg'] = "Adding post was successful.";
                header('Location:' . Base_URL . "PostController/add_post?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Adding post was unsuccessful.";
                header('Location:' . Base_URL . "PostController/add_post?msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Failed to upload image.";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urlencode(serialize($message)));
        }
    }

    public function list_post()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table_post = "tbl_post";
        $postModel = $this->load->model('PostModel');
        $data['post'] = $postModel->post($table_post);

        $this->load->view('cpanel/post/listPost', $data);
        $this->load->view('cpanel/footer');
    }

    public function delete_post($id){
        
        $table_post = "tbl_post";
        $cond="Id_post = '$id'";
        $postModel = $this->load->model('PostModel');
        $result = $postModel->DeletePost($table_post,$cond);

        if ($result == 1) {
            $message['msg'] = "Deleting blog was successful. ";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting blog was unsuccessful. ";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urldecode(serialize($message)));
        }

    }

    public function edit_post($id){
        Session::checkSession();
        $cond = "Id_post = '$id'";
        $table_post = "tbl_post";
        $postModel = $this->load->model('PostModel');
        $postById = $postModel->postById($table_post,$cond);
        
        $data = [
            'currentPage' => 'blogs',
            'pageTitle' => 'Edit Blog',
            'viewFile' => 'cpanel/post/editPost',
            'load' => $this->load,
            'data' => ['postById' => $postById]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function update_post($id){
        $table_post = "tbl_post";
        $postModel = $this->load->model('PostModel');
        $cond = "Id_post = $id";

        $title = $_POST['title_post'];
        $content = $_POST['content_post'];
        $image = $_FILES['image_post']['name'];
        $tmp_img = $_FILES['image_post']['tmp_name'];

        $div = explode('.',$image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads = "public/uploads/post/".$unique_image;

        if($image){
            $data['postById'] = $postModel->postById($table_post,$cond);
            foreach($data['postById'] as $key => $value){
                $path_unlink = "public/uploads/post/";
                unlink($path_unlink.$value['Image_post']);
            }
            $data = array(
                'Title_post' => $title,
                'Content_post' => $content,
                'Image_post' => $unique_image
            );
            move_uploaded_file($tmp_img, $path_uploads);
        } else {
            $data = array(
                'Title_post' => $title,
                'Content_post' => $content
            );
        }
        
        $result = $postModel->UpdatePost($table_post,$data,$cond);
        if ($result == 1) {
            $message['msg'] = "Update Blog was successful. ";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Update Blog was unsuccessful. ";
            header('Location:' . Base_URL . "PostController/list_post?msg=" . urldecode(serialize($message)));
        }
    }

}
