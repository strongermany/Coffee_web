<?php
class ItemController extends BaseController
{
    private $itemModel;
    private $categoryItemModel;
    public function __construct()
    {
        parent::__construct();
        $this->itemModel = $this->load->model('ItemModel');
        $this->categoryItemModel = $this->load->model('CategoryItemModel');
    }

    public function index()
    {
        $this->add_item();
    }

    public function add_item()
    {
        Session::checkSession();
        $table_category = "tbl_category_items";
        $table_item = "tbl_items";
        
        $categories = $this->categoryItemModel->getAllCategories();
        $items = $this->itemModel->getAllItems();
        
        $data = [
            'currentPage' => 'item',
            'pageTitle' => 'Item Management',
            'viewFile' => 'cpanel/item/addItem',
            'load' => $this->load,
            'data' => [
                'category' => $categories,
                'item' => $items
            ]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function insert_item()
    {
        Session::checkSession();
        $title = $_POST['title_item'];
        $price = $_POST['price_item'];
        $quantity = $_POST['quantity_item'];
        $description = $_POST['desc_item'];
        $image = $_FILES['images_item']['name'];
        $tmp_img = $_FILES['images_item']['tmp_name'];

        $div = explode('.',$image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads = "public/uploads/items/".$unique_image;
        if (move_uploaded_file($tmp_img, $path_uploads)) {
            $item_category = $_POST['id_category_item'];
            $table = "tbl_items";
            $data = array(
                'title_item' => $title,
                'price_item' => $price,
                'desc_item' => $description,
                'quantity_item' => $quantity,
                'images_item' => $unique_image,
                'id_category_item' => $item_category
            );
            
            $result = $this->itemModel->insertItem($table, $data);
            if ($result == 1) {
                $message['msg'] = "Adding item was successful.";
                header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
            } else {
                $message['msg'] = "Adding item was unsuccessful.";
                header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
            }
        } else {
            $message['msg'] = "Failed to upload image.";
            header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
        }
    }

    public function list_items()
    {
        Session::checkSession();
        $table_item = "tbl_items";
        $table_category = "tbl_category_items";
        $items = $this->itemModel->getAllItems();
        
        $data = [
            'currentPage' => 'item',
            'pageTitle' => 'Item List',
            'viewFile' => 'cpanel/item/listItem',
            'load' => $this->load,
            'data' => ['item' => $items]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function delete_item($id)
    {
        Session::checkSession();
        try {
            $cond = "id_item = '$id'";
            $table = "tbl_items";
            
            $item = $this->itemModel->getItemById($id);
            if (!$item) {
                throw new Exception("Item not found");
            }

            if (!empty($item['images_item'])) {
                $image_path = 'D:\laragon\www\CafeWeb\public\uploads\items\\'.$item['images_item'];
                if (file_exists($image_path) && is_file($image_path)) {
                    if (!unlink($image_path)) {
                        chmod($image_path, 0777);
                    }
                }
            }
            
            $result = $this->itemModel->deleteItem($table, $cond);

            if ($result == 1) {
                $message['msg'] = "Item deleted successfully";
            } else {
                throw new Exception("Could not delete item from database");
            }
        } catch (Exception $e) {
            $message['msg'] = "Error: " . $e->getMessage();
        }
        
        header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
    }

    public function edit_item($id)
    {
        Session::checkSession();
        $cond = "id_item = $id";
        $table_item = "tbl_items";
        $table_category = "tbl_category_items";

        $itemById = $this->itemModel->getItemById($id);
        $categories = $this->categoryItemModel->getAllCategories();
        
        $data = [
            'currentPage' => 'item',
            'pageTitle' => 'Edit Item',
            'viewFile' => 'cpanel/item/editItem',
            'load' => $this->load,
            'data' => [
                'itemById' => $itemById,
                'category' => $categories
            ]
        ];
        
        $this->load->view('cpanel/menu', $data);
    }

    public function update_item($id)
    {
        Session::checkSession();
        $cond = "id_item = $id";
        $table = "tbl_items";
        
        $title = $_POST['title_item'];
        $price = $_POST['price_item'];
        $desc = $_POST['desc_item'];
        $quantity = $_POST['quantity_item'];
        $category = $_POST['id_category_item'];
        
        $data = [
            'title_item' => $title,
            'price_item' => $price,
            'desc_item' => $desc,
            'quantity_item' => $quantity,
            'id_category_item' => $category
        ];
        
        if($_FILES['images_item']['name']){
            $image = $_FILES['images_item']['name'];
            $tmp_image = $_FILES['images_item']['tmp_name'];
            
            $div = explode('.', $image);
            $file_ext = strtolower(end($div));
            $unique_image = $div[0].time().'.'.$file_ext;
            $path_uploads = "public/uploads/items/".$unique_image;
            
            if(move_uploaded_file($tmp_image, $path_uploads)){
                $data['images_item'] = $unique_image;
            }
        }
        
        $result = $this->itemModel->updateItem($table, $data, $cond);
        if ($result == 1) {
            $message['msg'] = "Updating item was successful.";
            header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
        } else {
            $message['msg'] = "Updating item was unsuccessful.";
            header('Location:' . Base_URL . "ItemController/add_item?msg=" . urlencode(serialize($message)));
        }
    }
} 