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
        Session::checkSession();
        $table = "tbl_Category";
        $categories = $this->categoryModel->category($table);
        
        $data = [
            'currentPage' => 'category',
            'pageTitle' => 'Category Management',
            'viewFile' => 'cpanel/product/addCategory',
            'load' => $this->load,
            'data' => ['category' => $categories]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function add_product()
    {
        Session::checkSession();
        $table_category = "tbl_category";
        $table_product = "tbl_product";
        
        $categories = $this->categoryModel->category($table_category);
        $products = $this->categoryModel->product($table_product, $table_category);
        
        $data = [
            'currentPage' => 'product',
            'pageTitle' => 'Product Management',
            'viewFile' => 'cpanel/product/addProduct',
            'load' => $this->load,
            'data' => [
                'category' => $categories,
                'product' => $products
            ]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function insert_category()
    {
        Session::checkSession();
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
        Session::checkSession();
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
                $message['msg'] = "Adding product was successful.";
                header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Adding product was unsuccessful.";
                header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Failed to upload image.";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
        }
    }

    public function list_product()
    {
        Session::checkSession();
        $table_product = "tbl_product";
        $table_category = "tbl_category";
        $products = $this->categoryModel->product($table_product, $table_category);
        
        $data = [
            'currentPage' => 'product',
            'pageTitle' => 'Product List',
            'viewFile' => 'cpanel/product/listProduct',
            'load' => $this->load,
            'data' => ['product' => $products]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function list_category()
    {
        Session::checkSession();
        $table = "tbl_Category";
        $categories = $this->categoryModel->category($table);
        
        $data = [
            'currentPage' => 'category',
            'pageTitle' => 'Category List',
            'viewFile' => 'cpanel/product/listCategory',
            'load' => $this->load,
            'data' => ['category' => $categories]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function delete_category($id)
    {
        Session::checkSession();
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

    public function delete_product($id)
    {
        Session::checkSession();
        try {
            $cond = "Id_product = '$id'";
            $table = "tbl_product";
            
            // Lấy thông tin sản phẩm trước khi xóa
            $product = $this->categoryModel->productByID($table, $cond);
            // if (isset($product[0]['Images_product'])) {
            //     echo "Images_product: " . $product[0]['Images_product'];
            // } else {
            //     echo "Không tìm thấy Images_product";
            // }
            // exit();
            if (!$product) {
                throw new Exception("Không tìm thấy sản phẩm");
            }

            // Xử lý xóa file hình ảnh
            if (!empty( $product[0]['Images_product'])) {
               
                
                // Sử dụng đường dẫn tuyệt đối
                $image_path = 'D:\laragon\www\CafeWeb\public\uploads\product\\'.$product[0]['Images_product'];
                // Debug thông tin
              
                // Kiểm tra và xóa file
                if (file_exists($image_path) && is_file($image_path)) {
                    // Thử xóa file
                    
                   
                    if (!unlink($image_path)) {
                        $error = error_get_last();
                        error_log("Failed to delete image file. Error: " . ($error ? $error['message'] : 'Unknown error'));
                        
                        // Thử thay đổi quyền truy cập và xóa lại
                        chmod($image_path, 0777);
                        
                       
                    } else {
                        error_log("Successfully deleted image file");
                    }
                } else {
                    error_log("Image file not found or not accessible: " . $image_path);
                }
            }
            
            // Xóa sản phẩm từ database
            $result = $this->categoryModel->DeleteProduct($table, $cond);

            if ($result == 1) {
                $message['msg'] = "Xóa sản phẩm thành công";
            } else {
                throw new Exception("Không thể xóa sản phẩm từ database");
            }
        } catch (Exception $e) {
            error_log("Delete product error: " . $e->getMessage());
            $message['msg'] = "Lỗi: " . $e->getMessage();
        }
        
        header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
    }

    public function edit_category($id)
    {
        Session::checkSession();
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $table = "tbl_Category";
            $cond = "Id_Cate = " . (int)$id;
            
            $categoryById = $this->categoryModel->cateByID($table, $cond);
            if (!$categoryById) {
                throw new Exception("Category not found.");
            }

            $data = [
                'currentPage' => 'category',
                'pageTitle' => 'Edit Category',
                'viewFile' => 'cpanel/product/editCategory',
                'load' => $this->load,
                'data' => ['categoryById' => $categoryById]
            ];
            
            $this->load->view('cpanel/menu', $data);

        } catch (Exception $e) {
            $message = [
                'type' => 'error',
                'msg' => $e->getMessage()
            ];
            header('Location: ' . Base_URL . "ProductController/add_category?msg=" . urlencode(serialize($message)));
            exit();
        }
    }

    public function edit_product($id)
    {
        Session::checkSession();
        $cond = "Id_product = $id";
        $table_product = "tbl_product";
        $table_category = "tbl_category";

        $productById = $this->categoryModel->productByID($table_product, $cond);
        $categories = $this->categoryModel->category($table_category);
        
        $data = [
            'currentPage' => 'product',
            'pageTitle' => 'Edit Product',
            'viewFile' => 'cpanel/product/editProduct',
            'load' => $this->load,
            'data' => [
                'productById' => $productById,
                'category' => $categories
            ]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function update_category($id)
    {
        Session::checkSession();
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

    public function update_product($id)
    {
        Session::checkSession();
        $cond = "Id_product = $id";
        $table = "tbl_product";
        
        $title = $_POST['title_product'];
        $price = $_POST['price_product'];
        $desc = $_POST['desc_product'];
        $quantity = $_POST['quantity_product'];
        $category = $_POST['category_product'];
        
        $data = [
            'Title_product' => $title,
            'Price_product' => $price,
            'Desc_product' => $desc,
            'Quantity_product' => $quantity,
            'Id_category_product' => $category
        ];
        
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
        
        $result = $this->categoryModel->UpdateProduct($table, $data, $cond);
        if ($result == 1) {
            $message['msg'] = "Updating product was successful.";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Updating product was unsuccessful.";
            header('Location:' . Base_URL . "ProductController/add_product?msg=" . urlencode(serialize($message)));
        }
    }
}
