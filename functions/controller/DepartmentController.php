<?php
    require_once '../functions/datalayer/DepartmentDB.php';

    Class DepartmentController {
        
        private $departmentDB;   
    
        public function __construct(){
            $this->departmentDB = new DepartmentDB();
        }

        function getDepartments($statusDepartment){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartments($statusDepartment);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        function getDepartmentsCustomer($customerID, $departmentStatus){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartmentsCustomer($customerID, $departmentStatus);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        function addContactDepartment($contactID, $departmentID) {

            echo $contactID . " en " .$departmentID;

        }
    }
?>