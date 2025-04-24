<?php
class SliderController extends BaseController {
    private $sliderModel;

    public function __construct() {
        parent::__construct();
        $this->sliderModel = $this->load->model('SliderModel');
    }

    public function index() {
        Session::checkSession();
        $data['sliders'] = $this->sliderModel->getAllSliders();
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/slider/list', $data);
        $this->load->view('cpanel/footer');
    }

    public function add() {
        Session::checkSession();
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/slider/add');
        $this->load->view('cpanel/footer');
    }

    public function insert() {
        Session::checkSession();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
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

            if (empty($title) || empty($file_name)) {
                $message['msg'] = "Fields cannot be empty";
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
                    'title' => $title,
                    'image' => $unique_name,
                    'status' => 1
                );

                $result = $this->sliderModel->insertSlider($data);
                
                if ($result) {
                    $message['msg'] = "Added slider successfully";
                    header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
                } else {
                    // Nếu thêm vào database thất bại, xóa file đã upload
                    unlink($upload_path);
                    $message['msg'] = "Failed to add slider to database";
                    header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
                }
            } else {
                $message['msg'] = "Failed to upload image";
                header("Location:".Base_URL."SliderController/add?msg=".urlencode(serialize($message)));
            }
        }
    }

    public function edit($id) {
        Session::checkSession();
        $data['sliderbyid'] = $this->sliderModel->getSliderById($id);
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/slider/edit', $data);
        $this->load->view('cpanel/footer');
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
        $slider = $this->sliderModel->getSliderById($id);
        if (!empty($slider[0]['image'])) {
            $file_path = "public/uploads/slider/" . $slider[0]['image'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $result = $this->sliderModel->deleteSlider($id);
        if ($result) {
            $message['msg'] = "Deleted slider successfully";
        } else {
            $message['msg'] = "Failed to delete slider";
        }
        header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
    }

    public function status($id) {
        Session::checkSession();
        $slider = $this->sliderModel->getSliderById($id);
        $status = ($slider[0]['status'] == 1) ? 0 : 1;
        $result = $this->sliderModel->updateStatus($id, $status);
        if ($result) {
            $message['msg'] = "Updated status successfully";
        } else {
            $message['msg'] = "Failed to update status";
        }
        header("Location:".Base_URL."SliderController?msg=".urlencode(serialize($message)));
    }
} 