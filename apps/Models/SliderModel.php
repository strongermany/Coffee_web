<?php
class SliderModel extends BaseModel {
    private $table = 'tbl_slider';

    public function __construct() {
        parent::__construct();
    }

    public function getAllSliders() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->db->select($sql);
    }

    public function getActiveSliders() {
        $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY id DESC";
        return $this->db->select($sql);
    }

    public function getSliderById($id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        return $this->db->select($sql, array(':id' => $id));
    }

    public function insertSlider($data) {
        try {
            return $this->db->insert($this->table, $data);
        } catch (Exception $e) {
            error_log("Error inserting slider: " . $e->getMessage());
            return false;
        }
    }

    public function updateSlider($data, $id) {
        try {
            $cond = "id = :id";
            $data[':id'] = $id;
            return $this->db->update($this->table, $data, $cond);
        } catch (Exception $e) {
            error_log("Error updating slider: " . $e->getMessage());
            return false;
        }
    }

    public function deleteSlider($id) {
        try {
            $cond = "id = :id";
            $data = array(':id' => $id);
            return $this->db->delete($this->table, $cond, $data);
        } catch (Exception $e) {
            error_log("Error deleting slider: " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $data = array('status' => $status);
            $cond = "id = :id";
            $data[':id'] = $id;
            return $this->db->update($this->table, $data, $cond);
        } catch (Exception $e) {
            error_log("Error updating slider status: " . $e->getMessage());
            return false;
        }
    }
} 