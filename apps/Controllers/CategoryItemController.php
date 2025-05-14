<?php
class CategoryItemController extends BaseController
{
    private $categoryItemModel;
    public function __construct()
    {
        parent::__construct();
        $this->categoryItemModel = $this->load->model('CategoryItemModel');

    }

    public function index()
    {
        $this->add_category();
    }

    public function add_category()
    {
        Session::checkSession();
        $table = "tbl_category_items";
        $categories = $this->categoryItemModel->getAllCategories();
        
        $data = [
            'currentPage' => 'category_item',
            'pageTitle' => 'Category Item Management',
            'viewFile' => 'cpanel/item/addCategory',
            'load' => $this->load,
            'data' => ['category' => $categories]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function insert_category()
    {
        Session::checkSession();
        try {
            $category = filter_input(INPUT_POST, 'name_cate_item', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'desc_cate_item', FILTER_SANITIZE_STRING);
            
            if (empty($category) || empty($description)) {
                throw new Exception("Category name and description are required.");
            }

            $table = "tbl_category_items";
            $data = array(
                'name_cate_item' => $category,
                'desc_cate_item' => $description
            );
            
            $result = $this->categoryItemModel->insertCategory($table, $data);
            
            if ($result == 1) {
                $message['msg'] = "Category added successfully!";
            } else {
                throw new Exception("Failed to add category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "CategoryItemController/add_category?msg=" . urlencode(serialize($message)));
        exit();
    }

    public function list_categories()
    {
        Session::checkSession();
        $table = "tbl_category_items";
        $categories = $this->categoryItemModel->getAllCategories();
        
        $data = [
            'currentPage' => 'category_item',
            'pageTitle' => 'Category Item List',
            'viewFile' => 'cpanel/category_item/listCategory',
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

            $table = "tbl_category_items";
            $cond = "id_cate_item = " . (int)$id;
            
            // Check if category exists
            $category = $this->categoryItemModel->getCategoryById($id);
            if (!$category) {
                throw new Exception("Category not found.");
            }

            $result = $this->categoryItemModel->deleteCategory($table, $cond);

            if ($result == 1) {
                $message['msg'] = "Category deleted successfully!";
            } else {
                throw new Exception("Failed to delete category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "CategoryItemController/add_category?msg=" . urlencode(serialize($message)));
        exit();
    }

    public function edit_category($id)
    {
        Session::checkSession();
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $table = "tbl_category_items";
            $cond = "id_cate_item = " . (int)$id;
            
            $categoryById = $this->categoryItemModel->getCategoryById($id);
            if (!$categoryById) {
                throw new Exception("Category not found.");
            }

            $data = [
                'currentPage' => 'category_item',
                'pageTitle' => 'Edit Category Item',
                'viewFile' => 'cpanel/item/editCategory',
                'load' => $this->load,
                'data' => ['categoryById' => $categoryById]
            ];
            
            $this->load->view('cpanel/menu', $data);

        } catch (Exception $e) {
            $message = [
                'type' => 'error',
                'msg' => $e->getMessage()
            ];
            header('Location: ' . Base_URL . "CategoryItemController/add_category?msg=" . urlencode(serialize($message)));
            exit();
        }
    }

    public function update_category($id)
    {
        Session::checkSession();
        try {
            if (!is_numeric($id)) {
                throw new Exception("Invalid category ID.");
            }

            $category = filter_input(INPUT_POST, 'name_cate_item', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'desc_cate_item', FILTER_SANITIZE_STRING);
            
            if (empty($category) || empty($description)) {
                throw new Exception("Category name and description are required.");
            }

            $table = "tbl_category_items";
            $cond = "id_cate_item = " . (int)$id;
            
            $data = array(
                'name_cate_item' => $category,
                'desc_cate_item' => $description
            );
            
            $result = $this->categoryItemModel->updateCategory($table, $data, $cond);
            
            if ($result == 1) {
                $message['msg'] = "Category updated successfully!";
            } else {
                throw new Exception("Failed to update category.");
            }
        } catch (Exception $e) {
            $message['msg'] = $e->getMessage();
        }

        header('Location: ' . Base_URL . "CategoryItemController/add_category?msg=" . urlencode(serialize($message)));
        exit();
    }
} 