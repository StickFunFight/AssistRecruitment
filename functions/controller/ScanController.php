<?php
    require_once '../functions/datalayer/ScanDB.php';

    Class ScanController {
        
        private $scanDB;   
    
        public function __construct(){
            $this->ScanDB = new ScanDB();
        }

        // Getting all scans
        function getScans($statusScan){
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScans($statusScan);

            // Returning the list given from the Database class
            return $listScans;
        }  

        // Getting all scan from 1 customer
        function getScansCustomer($customerID, $statusScan){
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansCustomer($customerID, $statusScan);

            // Returning the list given from the Database class
            return $listScans;
        }
        Function GetScan($scanID){
            $listScans = array();

            $listScans = $this->ScanDB->getScan($scanID);

            return $listScans;
        }

        function UpdateScan($scanID, $scanName,$scanComment, $scanStatus,$scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate){
         $this->ScanDB->EditScan($scanID, $scanName,$scanComment, $scanStatus,$scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate);
        }

        // Getting all scans from 1 user
        function getScansUser($userID) {
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansUser($userID);

            // Returning the list given from the Database class
            return $listScans;
        }
    }
?>