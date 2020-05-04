<?php
    require_once 'database.class.php';

    Class ContactDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getContacts($status) {
            // Creating a array
            $listContacts = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT c.contactID, c.contactName, c.contactPhoneNumber, c.contactEmail, c.contactStatus, cust.customerName, dp.departmentName 
                            FROM contact c
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE c.contactStatus = '%s'", $status);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $contact){
                    // Putting it in the modal
                    $entContact = new entContact($contact->contactID, $contact->contactName, $contact->contactPhoneNumber, $contact->contactEmail, $contact->contactStatus, $contact->customerName, $contact->departmentName);
                    array_push($listContacts, $entContact);
                }
                // Returning the full list
                return $listContacts;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }

        function getContactsCustomer($customerID, $status){
            // Creating a array
            $listContacts = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT c.contactID, c.contactName, c.contactPhoneNumber, c.contactEmail, c.contactStatus, cust.customerName, dp.departmentName 
                            FROM contact c
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE cust.customerID = %d AND c.contactStatus = '%s'", $customerID, $status);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $contact){
                    // Putting it in the modal
                    $entContact = new entContact($contact->contactID, $contact->contactName, $contact->contactPhoneNumber, $contact->contactEmail, $contact->contactStatus, $contact->customerName, $contact->departmentName);
                    array_push($listContacts, $entContact);
                }
                // Returning the full list
                return $listContacts;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }
    }
?>