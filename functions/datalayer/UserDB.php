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
            $query = sprintf("SELECT u.userID, c.contactID, c.contactName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, cust.customerName, dp.departmentName, cust.customerID, dp.departmentID
                            FROM user u
                            INNER JOIN contact c ON c.userID = u.userID
                            INNER JOIN customer cust ON c.customerID = cust.customerID
                            INNER JOIN department_contact dc ON dc.contactID = c.contactID
                            INNER JOIN department dp ON dc.departmentID = dp.departmentID
                            WHERE u.userID = %d
                            LIMIT 1", $userID);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entUser = new entUser($user->userID, $user->contactID, $user->contactName, $user->contactPhoneNumber, $user->userEmail, $user->contactComment, $user->contactStatus, $user->customerName, $user->departmentName, $user->customerID, $user->departmentID);
                    array_push($detailsUser, $entUser);
                }
                // Returning the full list
                return $detailsUser;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }

        function updateUser($userID, $contactID, $contactName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment) {
            $query = sprintf("START TRANSACTION;
                            UPDATE user SET userEmail = '%s' AND userStatus = '%s' WHERE userID = %d;
                            UPDATE contact SET contactName = '%s' AND contactPhone = '%s' AND contactEmail = '%s' AND contactStatus = '%s'
                            AND contactComment = '%s' AND CustomerID = %d WHERE contactID = %d;
                            COMMIT;", $userEmail, $userStatus, $userID, $contactName, $contactPhone, $userEmail, $userStatus, $contactComment, $contactCustomer, $contactID);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Showing succes message when the query is executes
                echo '<script>location.replace("?user=" + '. $userID .' + "&error=none");</script>';
            }
            // Showing a error when the query didn't execute
            else{
                echo '<script>location.replace("?user=" + '. $userID .' + "&error=1");</script>';
            }
        }

        function archiveUser($userID){
            // Create Query to update Customer Status
            $query = "UPDATE user SET userStatus = 'Archived' WHERE userID = $userID";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }
    
        function deleteUser($userID){
            // Create Query to update Customer Status
            $query = "UPDATE user SET userStatus = 'Deleted' WHERE userID = $userID";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }
    }
?>