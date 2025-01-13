<?php
    class dbconnect {
        private $dbhost = 'localhost';
        private $username = 'user';
        private $password = 'psw';
        private $dbname = 'db_name';
        private $conn;

        public function __construct(){
            $this->conn = new mysqli($this->dbhost, $this->username, $this->password, $this->dbname);
            if($conn->connect_error){
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function close(){
            $this->conn->close();
        }

        public function query($sql){
            $result=$this->conn->query($sql);
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return null;
            }
        }
    }
?>