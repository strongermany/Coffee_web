<?php   
    class HomeModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function category($sales){
            return $this->db->select($sales);
            
        }

        public function cateByID($table,$id){
            $sql="Select distinct * from $table where Id_Cate=:id";
            $statement = $this->db->prepare($sql);
            $data =array(':id' =>$id);
            return $this->db->select($sql,$data);
        }
    }

?>