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
        public function getStatus(){
            // Making an array
            $lijst;

            // Making a query
            $query = sprintf("SELECT customerStatus FROM customer  GROUP BY customerStatus");
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the result
                $result = $stm->fetchAll(PDO::FETCH_OBJ);

                // Loopen through the result
                foreach($result as $status){
                    // Entiteit aanroepen om de waardes op te halen en in de array te doen
                    $customerModal = new CustomerModal("", "", "", "", $status->customerStatus);
                    array_push($lijst, $customerModal);
                }

                // De volledige lijst teruggeven
                return $lijst;
            }else {
                echo "RIP";
            }
        }
    }
?>