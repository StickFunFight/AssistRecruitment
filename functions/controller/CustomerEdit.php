<?php
    class CustomerEdit {

        // Creating variables
        private $customerModal;
        private $database;
        private $db;

        public function __construct(){
            // Importing files
            require("/functions/modals/CustomerModalMarvin.php");
            require("/functions/datalayer/database.class.php");

            $database = new Database();
            $this->db = $database->getConnection();
        }

        // Function to get all diffrent status from the database
        public function getStatus(){

        }
    }
?>