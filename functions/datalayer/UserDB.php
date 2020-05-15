<?php
    require_once 'database.class.php';

    Class UserDB {
        
        private $db;   
    
        public function __construct(){
            // Creating a new connection
            $database = new Database();
            $this->db = $database->getConnection();
        }

        // Getting all contacts
        function getUsers($status) {
            // Creating a array
            $listUsers = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT u.userID, c.contactID, c.contactName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, c.contactBirth, cust.customerName,  cust.customerID
                      FROM user u
                      INNER JOIN contact c ON c.userID = u.userID
                      INNER JOIN customer cust ON c.customerID = cust.customerID
                      WHERE c.contactStatus = ?
                      ORDER BY c.contactName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $status);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entUser = new EntContact($user->userID, $user->contactID, $user->contactName, $user->contactPhoneNumber, $user->userEmail, $user->contactComment, $user->contactStatus, $user->contactBirth, $user->customerName, null, $user->customerID, null, null);
                    array_push($listUsers, $entUser);
                }
                // Returning the full list
                return $listUsers;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all contact for one customer
        function getUsersCustomer($customerID, $status){
            // Creating a array
            $listUsers = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT u.userID, c.contactID, c.contactName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, c.contactBirth, cust.customerName, dp.departmentName, cust.customerID, dp.departmentID
                      FROM user u 
                      INNER JOIN contact c ON c.userID = u.userID
                      INNER JOIN customer cust ON c.customerID = cust.customerID
                      INNER JOIN department_contact dc ON dc.contactID = c.contactID
                      INNER JOIN department dp ON dc.departmentID = dp.departmentID
                      WHERE cust.customerID = ? AND c.contactStatus = ?
                      ORDER BY c.contactName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $customerID);
            $stm->bindParam(2, $status);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entUser = new EntContact($user->userID, $user->contactID, $user->contactName, $user->contactPhoneNumber, $user->userEmail, $user->contactComment, $user->contactStatus, $user->contactBirth, $user->customerName, $user->departmentName, $user->customerID, $user->departmentID, null);
                    array_push($listUsers, $entUser);
                }
                // Returning the full list
                return $listUsers;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all contact for one customer
        function getDepartmentsUser($userID, $status){
            // Creating a array
            $listUsers = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT u.userID, c.contactID, c.contactName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, c.contactBirth, cust.customerName, dp.departmentName, cust.customerID, dp.departmentID, dp.departmentComment
                      FROM user u 
                      INNER JOIN contact c ON c.userID = u.userID
                      INNER JOIN customer cust ON c.customerID = cust.customerID
                      INNER JOIN department_contact dc ON dc.contactID = c.contactID
                      INNER JOIN department dp ON dc.departmentID = dp.departmentID
                      WHERE u.userID = ? AND c.contactStatus = ?
                      ORDER BY c.contactName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $status);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entUser = new EntContact($user->userID, $user->contactID, $user->contactName, $user->contactPhoneNumber, $user->userEmail, $user->contactComment, $user->contactStatus, $user->contactBirth, $user->customerName, $user->departmentName, $user->customerID, $user->departmentID,$user->departmentComment);
                    array_push($listUsers, $entUser);
                }
                // Returning the full list
                return $listUsers;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all details of a user
        function getDetailsUser($userID){
            // Creating a array
            $detailsUser = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT u.userID, c.contactID, c.contactName, c.contactPhoneNumber, u.userEmail, c.contactComment, c.contactStatus, c.contactBirth, cust.customerName, dp.departmentName, cust.customerID, dp.departmentID
                      FROM user u
                      INNER JOIN contact c ON c.userID = u.userID
                      INNER JOIN customer cust ON c.customerID = cust.customerID
                      INNER JOIN department_contact dc ON dc.contactID = c.contactID
                      INNER JOIN department dp ON dc.departmentID = dp.departmentID
                      WHERE u.userID = ?
                      LIMIT 1";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $user){
                    // Putting it in the modal
                    $entUser = new EntContact($user->userID, $user->contactID, $user->contactName, $user->contactPhoneNumber, $user->userEmail, $user->contactComment, $user->contactStatus, $user->contactBirth, $user->customerName, $user->departmentName, $user->customerID, $user->departmentID, null);
                    array_push($detailsUser, $entUser);
                }
                // Returning the full list
                return $detailsUser;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        function updateUser($userID, $contactID, $contactName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment) {
            $query = "START TRANSACTION;
                      UPDATE user SET userEmail = ? AND userStatus = ? WHERE userID = ?;
                      UPDATE contact SET contactName = ? AND contactPhone = ? AND contactEmail = ? AND contactStatus = ?
                      AND contactComment = ? AND CustomerID = ? WHERE contactID = ?;
                      COMMIT;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userEmail);
            $stm->bindParam(2, $userStatus);
            $stm->bindParam(3, $userID);
            $stm->bindParam(4, $contactName);
            $stm->bindParam(5, $contactPhone);
            $stm->bindParam(6, $userEmail);
            $stm->bindParam(7, $userStatus);
            $stm->bindParam(8, $contactComment);
            $stm->bindParam(9, $contactCustomer);
            $stm->bindParam(10, $contactID);
            if($stm->execute()){
                return true;
            }
            // Showing a error when the query didn't execute
            else{
                return false;
            }
        }

        function archiveUser($userID){
            // Create Query to update Customer Status
            $query = "UPDATE user SET userStatus = 'Archived' WHERE userID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
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
            $query = "UPDATE user SET userStatus = 'Deleted' WHERE userID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }

        function deleteUserScan($userID, $scanID){
            // Create Query to update Customer Status
            $query = "DELETE FROM scan_user WHERE scanID = ? AND userID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            $stm->bindParam(2, $userID);
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
