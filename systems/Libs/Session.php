<?php
    class Session{
        public static function init(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
        public static function set($key,$value){
            $_SESSION[$key]= $value;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
            return false;
        }
        public static function checkSession(){
            self::init();
            if(self::get('login') == false){
                self::destroy();
                header("Location:".Base_URL."LoginController");
            }
        }

        public static function destroy(){
           // Xóa tất cả session
            session_destroy();
        }

        public static function unset($key){
            // Xóa một session key cụ thể
            if(isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    }
?>