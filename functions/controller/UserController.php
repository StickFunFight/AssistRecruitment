<?php
    require_once '../functions/datalayer/UserDB.php';

    Class UserController {
        
        private $UserDB;   
    
        public function __construct(){
            $this->UserDB = new UserDB();
        }

        // Getting al the contact
        function getDetailsUser($userID){
            // Creating a array
            $detailsUser = array();

            $detailsUser = $this->UserDB->getDetailsUser($userID);

            // Returning the list given from the Database class
            return $detailsUser;
        }

        function updateUser($userID, $contactID, $userName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment) {
            // Sending the data to the database class
            $this->UserDB->updateUser($userID, $contactID, $userName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment);

            // Checking the result

        }
    }
?>
