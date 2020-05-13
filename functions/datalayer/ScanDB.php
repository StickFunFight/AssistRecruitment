<?php
    require_once 'database.class.php';

    Class ScanDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getScans($statusScan){
            // Creating a array
            $listScans = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, c.customerName 
                      FROM scan s
                      INNER JOIN scan_user su ON s.scanID = su.scanID
                      INNER JOIN user u ON su.userID = u.userID
                      INNER JOIN customer c ON u.customerID = c.customerID
                      WHERE s.scanStatus = ?
                      ORDER BY s.scanName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $statusScan);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $scan){
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName, null, null, null);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all scans of 1 customer
        function getScansCustomer($customerID, $statusScan){
            // Creating a array
            $listScans = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, c.customerName, c.customerID  
                      FROM scan s
                      INNER JOIN scan_user su ON s.scanID = su.scanID
                      INNER JOIN user u ON su.userID = u.userID
                      INNER JOIN customer c ON u.customerID = c.customerID
                      WHERE c.customerID = ? AND s.scanStatus = ?
                      ORDER BY s.scanName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $customerID);
            $stm->bindParam(2, $statusScan);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $scan){
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName, $scan->customerID, null, null);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all scans of 1 user
        function getScansUser($userID){
            // Creating a array
            $listScans = array();

            // Getting the date
            $date = date("Y-m-d");

            // Making a query to get the scans of the customer out the database
            $query = "SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, u.userID
                      FROM scan s
                      INNER JOIN scan_user sc ON sc.scanID = s.scanID
                      INNER JOIN user u ON sc.userID = u.userID
                      WHERE s.scanStatus = 'Active' AND u.userID = ? AND s.scanEndDate >= ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $date);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $scan){
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, null, $scan->scanStartDate, $scan->scanEndDate, null, null, null, $scan->userID);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }


        // Getting all scans of 1 user
        function getScansUser($userID, $statusScan){
            // Creating a array
            $listScans = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, c.customerName  
                            FROM scan s
                            INNER JOIN scan_user su ON s.scanID = su.scanID
                            INNER JOIN user u ON su.userID = u.userID
                            INNER JOIN customer c ON u.customerID = c.customerID
                            WHERE u.userID = %d AND s.scanStatus = '%s'
                            ORDER BY s.scanName ASC", $userID, $statusScan);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $scan){
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }


        function archiveScan($scanID){
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Archived' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }
    
        function deleteScan($scanID){
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Deleted' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
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
