<?php
class HomeSliderModel extends BaseModel {
    private $table = 'tbl_slider';

    public function __construct() {
        parent::__construct();
    }

    public function getActiveSliders() {
        $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY id DESC";
        return $this->db->select($sql);
    }
} 