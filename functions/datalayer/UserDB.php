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
                      LEFT JOIN department_contact dc ON dc.contactID = c.contactID
                      LEFT JOIN department dp ON dc.departmentID = dp.departmentID
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
                      ORDER BY dp.departmentName ASC";
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

        // Function to add user
        function addUser($contactName, $userEmail, $userType, $contactPhone, $contactBirthDay, $contactComment, $contactCustomer) {
            // Fake data for now
            $userStatus = "Active";
            $userPassword = password_hash(uniqid(), PASSWORD_DEFAULT);

            $dbDate = date("Y-m-d", strtotime($contactBirthDay));
            echo $dbDate . "<br>";

            $queryInsertUser = "INSERT INTO user(userName, userEmail, userPassword, userRights, userStatus) VALUES(?, ?, ?, ?, ?)";
            $stm = $this->db->prepare($queryInsertUser);
            $stm->bindParam(1, $userEmail);
            $stm->bindParam(2, $userEmail);
            $stm->bindParam(3, $userPassword);
            $stm->bindParam(4, $userType);
            $stm->bindParam(5, $userStatus);
            if ($stm->execute()) {
                // Getting the user to create a contact
                $queryGetUser = "SELECT * FROM user WHERE userEmail = ?";
                $stmt = $this->db->prepare($queryGetUser);
                $stmt->bindParam(1, $userEmail);
                if ($stmt->execute()) {
                    // Getting the results fromm the database
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                    // Looping through the results
                    foreach($result as $user){
                        echo $user->userID;

                        $queryInsertContact = "INSERT INTO contact(contactName, contactPhoneNumber, contactEmail, contactComment, contactStatus, customerID, userID, contactBirth) 
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

                        $statement = $this->db->prepare($queryInsertContact);
                        $statement->bindParam(1, $contactName);
                        $statement->bindParam(2, $contactPhone);
                        $statement->bindParam(3, $userEmail);
                        $statement->bindParam(4, $contactComment);
                        $statement->bindParam(5, $userStatus);
                        $statement->bindParam(6, $contactCustomer);
                        $statement->bindParam(7, $user->userID);
                        $statement->bindParam(8, $dbDate);
                        if ($statement->execute()) {
                            return true;
                        } else {
                            return false;
                        }                 
                    }
                } else {
                    return false;
                }
            } else {
                // Returning false because user isnt created
                return false;
            }
        }

        // Updateing the user
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
            $query = "START TRANSACTION;
                        UPDATE contact SET contactStatus = 'Archived' WHERE userID = ?;
                        UPDATE user SET userStatus = 'Archived' WHERE userID = ?;
                        COMMIT; ";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $userID);
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
            $query = "START TRANSACTION;
                        UPDATE contact SET contactStatus = 'Deleted' WHERE userID = ?;
                        UPDATE user SET userStatus = 'Deleted' WHERE userID = ?;
                        COMMIT; ";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $userID);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }

        Function CreateUserBulk($userEmail, $ScanId){
            $userStatus= 'Active';
            $userRights= 'Employee';
            $selector = bin2hex(random_bytes(12));
            $hashedToken = password_hash($selector, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (userName, userEmail,userPassword,userRights, userStatus ) VALUES (?,?,?,?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userEmail);
            $stm->bindParam(2, $userEmail);
            $stm->bindParam(3, $hashedToken);
            $stm->bindParam(4, $userRights);
            $stm->bindParam(5, $userStatus);
            if ($stm->execute()) {
                $id = $this->db->lastInsertId();
                $this->KoppelUserScan($ScanId, $id);
            }
        }

        Function KoppelUserScan($ScanId, $UserId){
            $query = "INSERT INTO scan_user (scanID, UserID ) VALUES (?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $ScanId);
            $stm->bindParam(2, $UserId);
            if ($stm->execute()) {

            }
        }
    }

