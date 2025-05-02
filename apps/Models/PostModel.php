<?php   
    class PostModel extends BaseModel{
        public function __construct(){
               parent::__construct();
        }

        public function getAllPosts(){
            $sql = "SELECT * FROM tbl_post ORDER BY Id_post DESC";
            return $this->db->select($sql);
        }

        public function InsertPost($table, $data){
            return $this->db->insert($table, $data);
        }

        public function DeletePost($table_post, $cond){
            return $this->db->delete($table_post, $cond);
        }

        public function post($table_post){
            $sql = "SELECT * FROM $table_post ORDER BY Id_post DESC";
            return $this->db->select($sql);
        }

        public function postById($table_post, $cond){
            $sql = "SELECT * FROM $table_post WHERE $cond";
            return $this->db->select($sql);
        }

        public function UpdatePost($table_post, $data, $cond){
            return $this->db->update($table_post, $data, $cond);
        }
    }
?>