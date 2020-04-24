<?php
    require_once '../functions/datalayer/ContactDB.php';

    Class ContactController {
        
        private $ContactDB;   
    
        public function __construct(){
            $this->ContactDB = new ContactDB();
        }

        // Getting al the contact
        function getContacts($status){
            // Creating a array
            $listContacts = array();

            $listContacts = $this->ContactDB->getContacts($status);

            // Returning the list given from the Database class
            return $listContacts;
        }

        // Getting the contacts by customer
        function getContactsCustomer($customerID, $status){
            // Creating a array
            $listContacts = array();

            $listContacts = $this->ContactDB->getContactsCustomer($customerID, $status);

            // Returning the list given from the Database class
            return $listContacts;
        }
    }
?>
