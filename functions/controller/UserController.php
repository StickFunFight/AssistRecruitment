<?php
    require_once '../functions/datalayer/UserDB.php';

    Class UserController {
        
        private $UserDB;   
    
        public function __construct(){
            $this->UserDB = new UserDB();
        }

        // Getting all the contact
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
        
        function getProfile($UserID){
            //creating an array
            $profile = array();

            $profile = $this->UserDB->getProfile($UserID);
            //returning the list 

            return $profile;
        
        }

        function updatePassword($userID, $userPassword){
            if ($this->UserDB->updatePassword($userID, $userPassword)) {
                                // Reloading page with succes message
                echo '<script>location.replace("?error=none");</script>';
            } else {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "?error=1";
                // Reloading page with succes message
                echo '<script>location.replace("error=1");</script>';
            }
        }
    }
?>
