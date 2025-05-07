<?php
class SliderController extends BaseController {
    private $sliderModel;

    public function __construct() {
        parent::__construct();
        $this->sliderModel = $this->load->model('SliderModel');
    }

    public function index() {
        Session::checkSession();
        $sliders = $this->sliderModel->getAllSliders();
        $data = [
            'sliders' => $sliders,
            'currentPage' => 'slider',
            'pageTitle' => 'Slider Management',
            'viewFile' => 'cpanel/slider/add',
            'load' => $this->load,
            'data' => ['sliders' => $sliders]
        ];
        $this->load->view('cpanel/menu', $data);
    }

    public function add() {
        Session::checkSession();
        $sliders = $this->sliderModel->getAllSliders();
        $data = [
            'sliders' => $sliders,
            'currentPage' => 'slider',
            'pageTitle' => 'Add New Slider',
            'viewFile' => 'cpanel/slider/add',
            'load' => $this->load,
            'data' => ['sliders' => $sliders]
        ];
        $this->load->view('cpanel/menu', $data);
    }
    public function insert() {
        Session::checkSession();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = $_FILES['image'];
            
            // Kiểm tra thư mục upload
            $upload_dir = "public/uploads/slider/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Xử lý upload file
            $file_name = $image['name'];
            $file_tmp = $image['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = uniqid() . '_' . time() . '.' . $file_ext;
            $upload_path = $upload_dir . $unique_name;

            if (empty($file_name)) {
                $message['msg'] = "Please select an image";
                header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                exit;
            }

            // Kiểm tra định dạng file
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($file_ext, $allowed_extensions)) {
                $message['msg'] = "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF";
                header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                exit;
            }

            // Upload file
            if (move_uploaded_file($file_tmp, $upload_path)) {
                $data = array(
                    'image' => $unique_name,
                    'status' => 1
                );

                try {
                    $result = $this->sliderModel->insertSlider($data);
                    
                    if ($result) {
                        $message['msg'] = "Added slider successfully";
                        header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
                        exit;
                    } else {
                        // Nếu thêm vào database thất bại, xóa file đã upload
                        if (file_exists($upload_path)) {
                            unlink($upload_path);
                        }
                        error_log("Failed to insert slider data: " . print_r($data, true));
                        $message['msg'] = "Failed to add slider to database";
                        header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                        exit;
                    }
                } catch (Exception $e) {
                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    error_log("Exception when inserting slider: " . $e->getMessage());
                    $message['msg'] = "Error occurred while adding slider";
                    header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                    exit;
                }
            } else {
                $message['msg'] = "Failed to upload image";
                header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                exit;
            }
        }
    }

    public function edit($id) {
        Session::checkSession();
        $sliderbyid = $this->sliderModel->getSliderById($id);
        $data = [
            'currentPage' => 'slider',
            'pageTitle' => 'Edit Slider',
            'viewFile' => 'cpanel/slider/edit',
            'load' => $this->load,
            'data' => ['sliderbyid' => $sliderbyid]
        ];
        $this->load->view('cpanel/menu', $data);
    }

    public function update($id) {
        Session::checkSession();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $image = $_FILES['image'];
            
            if (empty($title)) {
                $message['msg'] = "Title cannot be empty";
                header("Location:".Base_URL."SliderController/edit/$id?msg=".urlencode(serialize($message)));
                exit;
            }

            $data = array('title' => $title);

            // Nếu có upload file mới
            if (!empty($image['name'])) {
                $upload_dir = "public/uploads/slider/";
                $file_name = $image['name'];
                $file_tmp = $image['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $unique_name = uniqid() . '_' . time() . '.' . $file_ext;
                $upload_path = $upload_dir . $unique_name;

                // Kiểm tra định dạng file
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                if (!in_array($file_ext, $allowed_extensions)) {
                    $message['msg'] = "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF";
                    header("Location:".Base_URL."SliderController/edit/$id?msg=".urlencode(serialize($message)));
                    exit;
                }

                // Xóa file cũ
                $old_slider = $this->sliderModel->getSliderById($id);
                if (!empty($old_slider[0]['image'])) {
                    $old_file = $upload_dir . $old_slider[0]['image'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }

                // Upload file mới
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $data['image'] = $unique_name;
                } else {
                    $message['msg'] = "Failed to upload new image";
                    header("Location:".Base_URL."SliderController/edit/$id?msg=".urlencode(serialize($message)));
                    exit;
                }
            }

            $result = $this->sliderModel->updateSlider($data, $id);
            if ($result) {
                $message['msg'] = "Updated slider successfully";
                header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
            } else {
                $message['msg'] = "Failed to update slider";
                header("Location:".Base_URL."SliderController/edit/$id?msg=".urlencode(serialize($message)));
            }
        }
    }

    public function delete($id) {
        Session::checkSession();
        
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        $response = array('success' => false, 'message' => '');
        
        try {
            if (empty($id)) {
                throw new Exception("Invalid slider ID");
            }

            $slider = $this->sliderModel->getSliderById($id);
            if (empty($slider)) {
                throw new Exception("Slider not found");
            }

            // Xóa file ảnh nếu tồn tại
            if (!empty($slider[0]['image'])) {
                $file_path = "public/uploads/slider/" . $slider[0]['image'];
                if (file_exists($file_path)) {
                    if (!unlink($file_path)) {
                        error_log("Failed to delete file: " . $file_path);
                        throw new Exception("Failed to delete slider image");
                    }
                }
            }

            $result = $this->sliderModel->deleteSlider($id);
            if (!$result) {
                throw new Exception("Failed to delete slider from database");
            }

            $response['success'] = true;
            $response['message'] = "Deleted slider successfully";

        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
            error_log("Slider deletion error: " . $e->getMessage());
        }

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            $message['msg'] = $response['message'];
            header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
            exit;
        }
    }

    public function status($id) {
        Session::init();
        Session::checkSession();
        
        if (empty($id)) {
            $message['msg'] = "Invalid slider ID";
            header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
            exit;
        }

        $slider = $this->sliderModel->getSliderById($id);
        if (empty($slider)) {
            $message['msg'] = "Slider not found";
            header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
            exit;
        }

        $status = ($slider[0]['status'] == 1) ? 0 : 1;
        $result = $this->sliderModel->updateStatus($id, $status);
        
        if ($result) {
            $message['msg'] = "Updated status successfully";
        } else {
            $message['msg'] = "Failed to update status";
        }
        
        header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
        exit;
    }
} 