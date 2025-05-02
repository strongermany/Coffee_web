<?php
    class Database extends PDO {
        public function __construct($connect,$user,$pass){
               parent::__construct($connect,$user,$pass);
        }
    
        public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC){
            $statement = $this->prepare($sql);
            
            // Convert SQL to use named parameters
            $i = 1;
            $newSql = $sql;
            $newData = array();
            foreach($data as $value) {
                $paramName = ":param" . $i;
                $newSql = preg_replace('/\?/', $paramName, $newSql, 1);
                $newData[$paramName] = $value;
                $i++;
            }
            
            $statement = $this->prepare($newSql);
            foreach($newData as $param => $value){
                $statement->bindValue($param, $value);
            }
            
            $statement->execute();
            return $statement->fetchAll($fetchStyle); 
        }

        public function selectOne($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC){
            $statement = $this->prepare($sql);
            
            // Convert SQL to use named parameters
            $i = 1;
            $newSql = $sql;
            $newData = array();
            foreach($data as $value) {
                $paramName = ":param" . $i;
                $newSql = preg_replace('/\?/', $paramName, $newSql, 1);
                $newData[$paramName] = $value;
                $i++;
            }
            
            $statement = $this->prepare($newSql);
            foreach($newData as $param => $value){
                $statement->bindValue($param, $value);
            }
            
            $statement->execute();
            $result = $statement->fetch($fetchStyle);
            return $result ? $result : null;
        }
        
        public function insert($table, $data) {
            try {
                $keys = implode(",", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));
                $sql = "INSERT INTO $table($keys) VALUES($values)";
                
                $statement = $this->prepare($sql);
                
                foreach($data as $key => $value) {
                    $statement->bindValue(":$key", $value);
                }
                
                if (!$statement->execute()) {
                    $error = $statement->errorInfo();
                    error_log("Database insert error: " . print_r($error, true));
                    return false;
                }
                
                return true;
            } catch (PDOException $e) {
                error_log("PDO insert error: " . $e->getMessage());
                return false;
            }
        }

        public function update($table, $data, $cond, $condData = array()) {
            $updateKeys = NULL;
            foreach($data as $key => $value){
                $updateKeys .="$key=:$key,";
            }
            $updateKeys = rtrim($updateKeys,",");

            $sql="Update $table set $updateKeys Where $cond";
            $statement = $this->prepare($sql);
            foreach($data as $key => $value){
                $statement->bindValue(":$key",$value);
            }
            // Bind điều kiện WHERE nếu có
            foreach($condData as $key => $value){
                $statement->bindValue($key, $value);
            }
            return $statement->execute();
        }

        public function delete($table, $cond, $data = array(), $limit = 1) {
            try {
                $sql = "DELETE FROM $table WHERE $cond LIMIT $limit";
                $statement = $this->prepare($sql);
                
                if (!empty($data)) {
                    foreach($data as $key => $value) {
                        $statement->bindValue($key + 1, $value);
                    }
                }
                
                return $statement->execute();
            } catch (PDOException $e) {
                error_log("Database delete error: " . $e->getMessage());
                return false;
            }
        }

        public function affectedRows($sql,$username,$password){
            $statement = $this->prepare($sql);
            $statement->execute(array($username,$password));
            return $statement->rowCount(); 
        }

        public function selectUser($sql,$username,$password){
            $statement = $this->prepare($sql);
            $statement->execute(array($username,$password));
            return $statement->fetchAll(PDO::FETCH_ASSOC); 
        }   
    }
?>