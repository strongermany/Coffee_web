<?php
class ProductController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->add_category();
    }

    public function add_category()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/addCategory');
        $this->load->view('cpanel/footer');
    }

    public function add_product()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_category";
        $data['category'] = $this->categoryModel->category($table);

        $this->load->view('cpanel/product/addProduct',$data);
        $this->load->view('cpanel/footer');
    }

    public function insert_category()
    {
        $category = $_POST['Category'];
        $description = $_POST['Description'];
     
        $table = "tbl_Category";
        $data = array(
            'Category' => $category,
            'Descript_Cate' => $description
        );
        
        $result = $this->categoryModel->InsertCategory($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }

    public function insert_product()
    {
        $title = $_POST['title_product'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['desc_product'];
        $image = $_FILES['image']['name'];
        $tmp_img = $_FILES['image']['tmp_name'];

        $div = explode('.',$image);
        $file_ext=strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads= "public/uploads/product/".$unique_image;
        if (move_uploaded_file($tmp_img, $path_uploads)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
        }

        $product_category = $_POST['product_category'];
        $table = "tbl_product";
        $data = array(
            'Title_product' => $title,
            'Price_product' => $price,
            'Desc_product' => $description,
            'Quantity_product' => $quantity,
            'Images_product' => $unique_image,
            'Id_category_product' => $product_category
        );
        
        $result = $this->categoryModel->InsertProduct($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding product was successful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding product was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        }
    }

    public function list_product()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table_product = "tbl_product";
        $table_category = "tbl_category";

        $data['product'] = $this->categoryModel->product($table_product,$table_category);

        $this->load->view('cpanel/product/listProduct', $data);
        $this->load->view('cpanel/footer');
    }

    public function list_category()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_Category";
        $data['category'] = $this->categoryModel->category($table);

        $this->load->view('cpanel/product/listCategory', $data);
        $this->load->view('cpanel/footer');
    }

    public function delete_category($id){
        $cond = "Id_Cate = '$id'";
        $table = "tbl_Category";
        $result = $this->categoryModel->DeleteCategory($table,$cond);

        if ($result == 1) {
            $message['msg'] = "Deleting category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }

    public function delete_product($id){
        $cond = "Id_product = '$id'";
        $table = "tbl_product";
        $result = $this->categoryModel->DeleteProduct($table,$cond);

        if ($result == 1) {
            $message['msg'] = "Deleting product was successful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting product was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        }
    }

    public function edit_category($id){
        $cond = "Id_Cate = $id";
        $table = "tbl_Category";
        
        $data['categoryById'] = $this->categoryModel->cateByID($table,$cond);
        $data['category'] = $this->categoryModel->category($table);

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/editCategory',$data);
        $this->load->view('cpanel/footer');
    }

    public function edit_product($id){
        $cond = "Id_product = $id";
        $table_product = "tbl_product";
        $table_category = "tbl_category";

        $data['productById'] = $this->categoryModel->productByID($table_product,$cond);
        $data['category'] = $this->categoryModel->category($table_category);

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/editProduct',$data);
        $this->load->view('cpanel/footer');
    }

    public function update_category($id){
        $cond = "Id_Cate = $id";
        $table = "tbl_Category";
        
        $category = $_POST['Category'];
        $description = $_POST['Description'];
        
        $data = array(
            'Category' => $category,
            'Descript_Cate' => $description
        );
        
        $result = $this->categoryModel->UpdateCategory($table, $data, $cond);
        if ($result == 1) {
            $message['msg'] = "Updating category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Updating category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        }
    }

    public function update_product($id){
        $cond = "Id_product = $id";
        $table = "tbl_product";
        
        $title = $_POST['title_product'];
        $price = $_POST['price_product'];
        $desc = $_POST['desc_product'];
        $quantity = $_POST['quantity_product'];
        $category = $_POST['category_product'];
        
        if($_FILES['image']['name']){
            $image = $_FILES['image']['name'];
            $tmp_image = $_FILES['image']['tmp_name'];
            
            $div = explode('.', $image);
            $file_ext = strtolower(end($div));
            $unique_image = $div[0].time().'.'.$file_ext;
            $path_uploads = "public/uploads/product/".$unique_image;
            
            if(move_uploaded_file($tmp_image, $path_uploads)){
                $data['Images_product'] = $unique_image;
            }
        }
        
        $data = array_merge($data ?? [], [
            'Title_product' => $title,
            'Price_product' => $price,
            'Desc_product' => $desc,
            'Quantity_product' => $quantity,
            'Id_category_product' => $category
        ]);
        
        $result = $this->categoryModel->UpdateProduct($table, $data, $cond);
        if ($result == 1) {
            $message['msg'] = "Updating product was successful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Updating product was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/list_product?msg=" . urldecode(serialize($message)));
        }
    }
}
