<?php
    require_once 'database.class.php';

    Class ScanDB
    {

        private $db;

        public function __construct()
        {
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getScans($statusScan)
        {
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
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $scan) {
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName, null, null, null);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;
            } // Showing a error when the query didn't execute
            else {
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all scans of 1 customer
        function getScansCustomer($customerID, $statusScan)
        {
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
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $scan) {
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName, $scan->customerID, null, null);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;
            } // Showing a error when the query didn't execute
            else {
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting all scans of 1 user
        function getScansUser($userID)
        {
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
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $scan) {
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, null, $scan->scanStartDate, $scan->scanEndDate, null, null, null, $scan->userID);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;
            } // Showing a error when the query didn't execute
            else {
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }


        function archiveScan($scanID)
        {
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Archived' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            if (!$stm->execute()) {
                echo "Er is iets fout gegaan";
            }
        }

        function deleteScan($scanID)
        {
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Deleted' WHERE scanID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanID);
            if (!$stm->execute()) {
                echo "Er is iets fout gegaan";
            }
        }

        // Function to get templates
        function getScanQuestionAir()
        {
            $listQuestionAirs = array();

            // Create Query to get questionairs
            $query = "SELECT * FROM questionair";
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $questionair) {
                    // Putting it in the modal
                    $entQuestionair = new EntQuestionair($questionair->questionairID, $questionair->questionairName, $questionair->questionairComment, $questionair->questionairStatus);
                    array_push($listQuestionAirs, $entQuestionair);
                }
                // Returning the full list
                return $listQuestionAirs;
            } // Showing a error when the query didn't execute
            else {
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Getting the id of the autocomplete questionair
        function getQuestionairID($scanQuestionair)
        {
            // Create Query to get questionairs
            $query = "SELECT questionairID FROM questionair WHERE questionairName = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $scanQuestionair);
            function getScan($scanID)
            {
                // Creating a array
                $listScans = array();

                // Making a query to get the scans of the customer out the database
                $query = sprintf("Select * from scan where scanID = $scanID");
                $stm = $this->db->prepare($query);
                if ($stm->execute()) {
                    // Getting the results fromm the database
                    $result = $stm->fetchAll(PDO::FETCH_OBJ);
                    // Looping through the results
                    foreach ($result as $scan) {
                        // Putting it in the modal
                        $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, '', '', '', '');
                        array_push($listScans, $entScan);
                    }
                    // Returning the full list
                    return $listScans;
                } // Showing a error when the query didn't execute
                else {
                    echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
                }
            }

            function EditScan($scanID, $scanName, $scanComment, $scanStatus, $scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate)
            {
                $query = "update scan set scanName = ?, scanComment=?, scanStatus = ? ,scanIntroductionText = ?, scanReminderText =? , scanStartDate = ?, scanEndDate = ? where scanID = ?";
                $stm = $this->db->prepare($query);
                $stm->bindParam(1, $scanName);
                $stm->bindParam(2, $scanComment);
                $stm->bindParam(3, $scanStatus);
                $stm->bindParam(4, $scanIntroductionText);
                $stm->bindParam(5, $scanReminderText);
                $stm->bindParam(6, $scanStartDate);
                $stm->bindParam(7, $scanEndDate);
                $stm->bindParam(8, $scanID);
                if ($stm->execute()) {
                    $newURL = "scan-list.php";
                    echo '<script>location.replace("' . $newURL . '");</script>';
                } // Showing a error when the query didn't execute
                else {
                    echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
                }
            }

            // Function to get scans for a department
            function getScansDepartment($departmentID)
            {
                // Creating a array
                $listScans = array();

                $query = "SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, dp.departmentID, c.customerID, c.customerName
                      FROM scan s
                      INNER JOIN scan_department sd ON s.scanID = sd.scanID
                      INNER JOIN department dp ON sd.departmentID = dp.departmentID 
                      INNER JOIN customer c ON dp.customerID = c.customerID
                      WHERE s.scanStatus = 'Active' AND dp.departmentID = 5
                      AND s.scanStartDate <= '2020-05-18' AND s.scanEndDate >= '2020-05-18'
                      ORDER BY s.scanEndDate ASC";
                $stm = $this->db->prepare($query);
                if ($stm->execute()) {
                    // Getting the results fromm the database
                    $result = $stm->fetchAll(PDO::FETCH_OBJ);
                    // Looping through the results
                    foreach ($result as $scan) {
                        // Putting it in the modal
                        $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName, $scan->customerID, $scan->departmentID, null);
                        array_push($listScans, $entScan);
                    }
                    // Returning the full list
                    return $listScans;
                } // Showing a error when the query didn't execute
                else {
                    echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
                }
            }
        }
    }

