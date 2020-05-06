<?php
    require_once 'database.class.php';

    Class UserDB {
        
        private $db;   
    
        public function __construct(){
            // Creating a new connection
            $database = new Database();
            $this->db = $database->getConnection();
        }

        // Getting all details of a user
        function getDetailsUser($userID){
            // Creating a array
            $detailsUser = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT c.contactID, c.contactName, c.contactPhoneNumber, c.contactEmail, c.contactStatus, cust.customerName, dp.departmentName 
                            FROM contact c
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE c.contactID = %d", $userID);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entContact = new entContact($user->contactID, $user->contactName, $user->contactPhoneNumber, $user->contactEmail, $user->contactStatus, $user->customerName, $user->departmentName);
                    array_push($detailsUser, $entContact);
                }
                // Returning the full list
                return $detailsUser;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }
    }
?>