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

        $table = "tbl_Category";
        $data['category'] = $this->categoryModel->category($table);

        $this->load->view('cpanel/product/addCategory', $data);
        $this->load->view('cpanel/footer');
    }

    public function add_product()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table_category = "tbl_category";
        $table_product = "tbl_product";
        
        $data['category'] = $this->categoryModel->category($table_category);
        $data['product'] = $this->categoryModel->product($table_product, $table_category);

        $this->load->view('cpanel/product/addProduct', $data);
        $this->load->view('cpanel/footer');
    }

    public function insert_category()
    {
        try {
            $category = filter_input(INPUT_POST, 'Category', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
            
            if (empty($category) || empty($description)) {
                throw new Exception("Category name and description are required.");
            }

            $table = "tbl_Category";
            $data = array(
                'Category' => $category,
                'Descript_Cate' => $description
            );
            
            $result = $this->categoryModel->InsertCategory($table, $data);
            
            if ($result == 1) {
                $message['msg'] = "Category added successfully!";
            } else {
                throw new Exception("Failed to add category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "ProductController/add_category?msg=" . urlencode(serialize($message)));
        exit();
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

    public function delete_category($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $table = "tbl_Category";
            $cond = "Id_Cate = " . (int)$id;
            
            // Check if category exists
            $category = $this->categoryModel->cateByID($table, $cond);
            if (!$category) {
                throw new Exception("Category not found.");
            }

            $result = $this->categoryModel->DeleteCategory($table, $cond);

            if ($result == 1) {
                $message['msg'] = "Category deleted successfully!";
            } else {
                throw new Exception("Failed to delete category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "ProductController/add_category?msg=" . urlencode(serialize($message)));
        exit();
    }

    public function delete_product($id){
        $cond = "Id_product = '$id'";
        $table = "tbl_product";
        $result = $this->categoryModel->DeleteProduct($table,$cond);

        if ($result == 1) {
            $message['msg'] = "Deleting product was successful. ";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting product was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urldecode(serialize($message)));
        }
    }

    public function edit_category($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $table = "tbl_Category";
            $cond = "Id_Cate = " . (int)$id;
            
            $data['categoryById'] = $this->categoryModel->cateByID($table, $cond);
            if (!$data['categoryById']) {
                throw new Exception("Category not found.");
            }

            $data['category'] = $this->categoryModel->category($table);

            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/product/editCategory', $data);
            $this->load->view('cpanel/footer');

        } catch (Exception $e) {
            $message = [
                'type' => 'error',
                'msg' => $e->getMessage()
            ];
            header('Location: ' . Base_URL . "ProductController/add_category?msg=" . urlencode(serialize($message)));
            exit();
        }
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

    public function update_category($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $category = filter_input(INPUT_POST, 'Category', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING);
            
            if (empty($category) || empty($description)) {
                throw new Exception("Category name and description are required.");
            }

            $table = "tbl_Category";
            $cond = "Id_Cate = " . (int)$id;
            
            $data = array(
                'Category' => $category,
                'Descript_Cate' => $description
            );
            
            $result = $this->categoryModel->UpdateCategory($table, $data, $cond);
            
            if ($result == 1) {
                $message['msg'] = "Category updated successfully!";
            } else {
                throw new Exception("Failed to update category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "ProductController/add_category?msg=" . urlencode(serialize($message)));
        exit();
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
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Updating product was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urldecode(serialize($message)));
        }
    }
}
