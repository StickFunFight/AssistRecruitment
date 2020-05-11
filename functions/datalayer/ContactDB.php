<?php
    require_once 'database.class.php';

    Class ContactDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        // Getting all contacts
        function getContacts($status) {
            // Creating a array
            $listContacts = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT u.userID, u.userName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, cust.customerName, dp.departmentName
                            FROM user u
                            INNER JOIN contact c ON c.userID = u.userID
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE c.contactStatus = '%s'
                            ORDER BY u.userName ASC", $status);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $contact){
                    // Putting it in the modal
                    $entContact = new entContact($contact->userID, $contact->userName, $contact->contactPhoneNumber, $contact->userEmail, $contact->contactStatus, $contact->customerName, $contact->departmentName);
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

        // Getting all contact for one customer
        function getContactsCustomer($customerID, $status){
            // Creating a array
            $listContacts = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT u.userID, u.userName, c.contactPhoneNumber, u.userEmail, c.contactStatus, cust.customerName, dp.departmentName
                            FROM user u
                            INNER JOIN contact c ON c.userID = u.userID
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE cust.customerID = %d AND c.contactStatus = '%s'
                            ORDER BY u.userName ASC", $customerID, $status);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $contact){
                    // Putting it in the modal
                    $entContact = new entContact($contact->userID, $contact->userName, $contact->contactPhoneNumber, $contact->userEmail, $contact->contactStatus, $contact->customerName, $contact->departmentName);
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