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
            $query = sprintf("SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, c.customerName 
                            FROM scan s
                            INNER JOIN scan_user su ON s.scanID = su.scanID
                            INNER JOIN user u ON su.userID = u.userID
                            INNER JOIN customer c ON u.customerID = c.customerID
                            WHERE s.scanStatus = '%s'
                            ORDER BY s.scanName ASC", $statusScan);
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $scan) {
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName);
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
            $query = sprintf("SELECT s.scanID, s.scanName, s.scanComment, s.scanStatus, s.scanIntroductionText, s.scanReminderText, s.scanStartDate, s.scanEndDate, c.customerName  
                            FROM scan s
                            INNER JOIN scan_user su ON s.scanID = su.scanID
                            INNER JOIN user u ON su.userID = u.userID
                            INNER JOIN customer c ON u.customerID = c.customerID
                            WHERE c.customerID = %d AND s.scanStatus = '%s'
                            ORDER BY s.scanName ASC", $customerID, $statusScan);
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach ($result as $scan) {
                    // Putting it in the modal
                    $entScan = new entScan($scan->scanID, $scan->scanName, $scan->scanComment, $scan->scanStatus, $scan->scanIntroductionText, $scan->scanReminderText, $scan->scanStartDate, $scan->scanEndDate, $scan->customerName);
                    array_push($listScans, $entScan);
                }
                // Returning the full list
                return $listScans;
            } // Showing a error when the query didn't execute
            else {
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }

        function duplicateScan($scanID){
            // Create Query to duplicate scan data
            $query = "INSERT INTO scan SELECT 0, scan.* WHERE scanID = $scanID";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }

        function archiveScan($scanID){
            // Create Query to update Customer Status
            $query = "UPDATE scan SET scanStatus = 'Archived' WHERE scanID = $scanID";
            $stm = $this->db->prepare($query);
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
            $query = "UPDATE scan SET scanStatus = 'Deleted' WHERE scanID = $scanID";
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }

        // function deleteCustomers($customerID){
        //     // Query aanmaken om customerStatus te veranderen naar Deleted
        //     $query = "UPDATE customer SET customerStatus = 'Deleted' WHERE customerID = $customerID";
        //     $stm = $this->db->prepare($query);
        //     if($stm->execute()){

        //     echo 'Het is gelukt';

        //     }
        //     // Tekst laten zien voor als er geen functies zijn opgehaald
        //     else{
        //         echo "Er is iets fout gegaan";
        //     }
        // }

        // // Function to get the details of a customer
        // function getCustomerDetails($customerID) {
        //     // Array aanmaken voor de functies
        //     $detailsCustomer = array();

        //     // Query  to get the customer
        //     $query = "SELECT * FROM customer WHERE customerID = ?";
        //     $stm = $this->db->prepare($query);
        //     $stm->bindParam(1, $customerID);
        //     if($stm->execute()){
        //         // Resultaten uit de database halen
        //         $result = $stm->fetchAll(PDO::FETCH_OBJ);
        //         // Loop aanmaken om alle rijen in een array te doen
        //         foreach($result as $customer){
        //             // Entiteit aanroepen om de waardes op te halen en in de array te doen
        //             $entCustomer = new EntCustomer($customer->customerID, $customer->customerName, $customer->customerComment, $customer->customerReference, $customer->customerStatus);
        //             array_push($detailsCustomer, $entCustomer);
        //         }
        //         // De volledige lijst teruggeven
        //         return $detailsCustomer;    
        //     }
        //     // Tekst laten zien voor als er geen functies zijn opgehaald
        //     else{
        //         echo "Oof";
        //     }
        // }

        // // Function to update the customer
        // function updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus) {
        //     // Query aanmaken om alle functies uit de database te halen
        //     $query = sprintf("UPDATE customer SET customerName = '%s', customerReference = '%s', customerComment = '%s', customerStatus = '%s' WHERE customerID = %d", $customerName, $customerReference, $customerComment, $customerStatus, $customerID);
        //     $stm = $this->db->prepare($query);
        //     if(!$stm->execute()){
        //         // Tekst laten zien voor als er geen functies zijn opgehaald
        //         echo "Oof";
        //     }
        // }
    }
?>