<?php
    require_once '../functions/datalayer/CustomerDB.php';

    Class CustomerController {
        
        private $customerDB;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $this->customerDB = new CustomerDB();
        }

        function getCustomers($status){
            // Array aanmaken voor de functies
            $listCustomers = $this->customerDB->getCustomers($status);

            // Returning the list given from the Database class
            return $listCustomers;
        }

        function deleteCustomers($customerID){
            $this->customerDB->deleteCustomers($customerID);
        }

        // Function to get the details of a customer
        function getCustomerDetails($customerID) {
            $detailsCustomer = array();

            $detailsCustomer = $this->customerDB->getCustomerDetails($customerID);

            // Returning the list given from the Database class
            return $detailsCustomer;
        }

        // Function to update the customer
        function updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus) {
            $this->customerDB->updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus);
        }
    }
?>