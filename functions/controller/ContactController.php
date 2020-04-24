<?php
    require_once '../functions/datalayer/ContactDB.php';

    Class ContactController {
        
        private $ContactDB;   
    
        public function __construct(){
            $this->ContactDB = new ContactDB();
        }

        function getContactsCustomer($customerID, $status){
            // Creating a array
            $listContacts = array();

            $listContacts = $this->ContactDB->getContactsCustomer($customerID, $status);

            // Returning the list given from the Database class
            return $listContacts;
        }
    }
?>