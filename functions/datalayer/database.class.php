<?php
    class Database {

        // Variable for the connection
        public $conn;

        // Database login information
        private $host = 'assist.tk';
        private $db_name = 'assist';
        private $username = 'assist_remote';
        private $password = 'KPg$R%Tsd@Y%';

        // Connectie maken
        public function getConnection() {
            $this->conn = null;

            // Checking if connection can be made, else show error
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';port=3306', $this->username, $this->password);
            } catch (\PDOException $exception) {
                echo 'Connection error: ' . $exception->getMessage();
            }
            // Connectie teruggeven
            return $this->conn;
        }
    }
?>
