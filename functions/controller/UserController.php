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
    }
?>
