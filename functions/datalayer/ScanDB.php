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

        function archiveScan($scanID){
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Archived' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            if(!$stm->execute()){
                echo "Er is iets fout gegaan";
            }
        }
    
        function deleteScan($scanID){
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Deleted' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            if(!$stm->execute()){
                echo "Er is iets fout gegaan";
            }
        }

        // Function to get templates
        function getScanQuestionAir() {
            $listQuestionAirs = array();

            // Create Query to get questionairs
            $query = "SELECT * FROM questionair";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $questionair){
                    // Putting it in the modal
                    $entQuestionair = new EntQuestionair($questionair->questionairID, $questionair->questionairName, $questionair->questionairComment, $questionair->questionairStatus);
                    array_push($listQuestionAirs, $entQuestionair);
                }
                // Returning the full list
                return $listQuestionAirs;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting the id of the autocomplete questionair
        function getQuestionairID($scanQuestionair) {
            // Create Query to get questionairs
            $query = "SELECT questionairID FROM questionair WHERE questionairName = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanQuestionair);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $questionair){
                    return $questionair->questionairID;
                }
            }
        }

        // Function to add scan
        function addScan($scanName, $scanComment, $scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate, $scanQuestionair, $customerID) { 
            $scanStatus = 'Active';

            // Changing date for the database
            $dbStartDate = date("Y-m-d", strtotime($scanStartDate));
            $dbEndDate = date("Y-m-d", strtotime($scanEndDate));

            // Create Query to insert scan
            $query = "INSERT INTO scan(scanName, scanComment, scanStatus, scanIntroductionText, scanReminderText, scanStartDate, scanEndDate, questionairID) 
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanName);
            $stm->bindParam(2, $scanComment);
            $stm->bindParam(3, $scanStatus);
            $stm->bindParam(4, $scanIntroductionText);
            $stm->bindParam(5, $scanReminderText);
            $stm->bindParam(6, $dbStartDate);
            $stm->bindParam(7, $dbEndDate);
            $stm->bindParam(8, $scanQuestionair);
            if(!$stm->execute()){
                echo "Er is iets fout gegaan";
            } 
            // else {
            //     // Adding scan to user
            //     $getAddedScan = "SELECT scanID WHERE scanName = ?";
            //     $stmt = $this->db->prepare($getAddedScan);
            //     $stmt->bindParam(1, $scanName);
            //     if($stmt->execute()){
            //         // Getting the results fromm the database
            //         $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            //         // Looping through the results
            //         foreach($result as $scan){
            //             // Adding scan to customer
            //             $addScanCustomer = "INSERT INTO scan_user VALUES(?, ?)";
            //             $stmt = $this->db->prepare($getAddedScan);
            //             $stmt->bindParam(1, $scan->scanID);
            //             $stmt->bindParam(2, $customerID);
            //             if($stmt->execute()){
            //         }
            //     }
            // }
        }

        function GetAnswerScore()
        {
            $lijst = array();
            $query = "SELECT q.questionID , q.questionName, AVG(a.answerScore) AS answerScore
            FROM scan_answer sa
            INNER JOIN question q ON q.questionID = sa.questionID
            INNER JOIN answer a ON a.answerID = sa.answerID
            GROUP BY q.questionID
            ORDER BY q.questionName ASC";

            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $item) {
                    $entAnswerScore = new entAnswerScore(null, $item->answerScore, $item->questionID, $item->questionName);
                    array_push($lijst, $entAnswerScore);
                }
                return $lijst;
    
            } else {
                echo "oef foutje";
            }
        }
    }
?>
