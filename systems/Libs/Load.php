<?php
    class Load{
        public function __construct(){

        }

        public function view($fileName,$data = false){
            if($data == true){
                extract($data);
            }
            include 'apps/Views/'.$fileName.'.php';
        }
        public function model($fileName){
            include_once 'apps/Models/'.$fileName.'.php';
            return new $fileName();
        }
    }

?>