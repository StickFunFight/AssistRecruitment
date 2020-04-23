<?php
    class CustomerMarvin {

        // Creating variables
        //private $customerModal;
        private $database;
        private $db;

        public function __construct(){
            // Importing files
            require("/functions/datalayer/database.class.php");

            // Getting the database connection
            $database = new Database();
            $this->db = $database->getConnection();

            //$customerModal = new CustomerModal();
        }

        // Function to get all diffrent status from the database
        public function getCustomerDetails($customerID){
            // Making an array
            $list;

            // Making a query
            $query = sprintf("SELECT * FROM customer WHERE customerID = " . $customerID);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the result
                $result = $stm->fetch(PDO::FETCH_OBJ);

                // Entiteit aanroepen om de waardes op te halen en in de array te doen
                $customerModal = new CustomerModal("", "", "", "", $status->customerStatus);
                array_push($lijst, $customerModal);
                
                // Returning the customer
                return $list;
            }else {
                echo "RIP";
            }
        }
    }
?>