<?php
    require_once '../functions/datalayer/ScanDB.php';

    Class ScanController {
        
        private $scanDB;   
    
        public function __construct(){
            $this->ScanDB = new ScanDB();
        }

        function getScansCustomer($customerID, $statusScan){
            // Creating a array
            $listScans = array();

            $listScans = $this->ScanDB->getScansCustomer($customerID, $statusScan);

            // Returning the list given from the Database class
            return $listScans;
        }  
    }
?>