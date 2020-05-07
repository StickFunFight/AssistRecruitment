<?php
    require_once '../functions/datalayer/DepartmentDB.php';

    Class DepartmentController {
        
        private $departmentDB;   
    
        public function __construct(){
            $this->departmentDB = new DepartmentDB();
        }

        // Funciton to get all departments
        function getDepartments($statusDepartment){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartments($statusDepartment);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        // Function to get all departments for 1 customer
        function getDepartmentsCustomer($customerID, $departmentStatus){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartmentsCustomer($customerID, $departmentStatus);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        // Funciton to get details of 1 department
        function getDetailsDepartment($departmentID) {
            // Creating a array
            $detailsDepartment = array();

            $detailsDepartment = $this->departmentDB->getDetailsDepartment($departmentID);

            // Returning the list given from the Database class
            return $detailsDepartment;
        }

        // Function to update the department
        function updateDepartment() {

        }

        // Function to add contact to department
        function addContactDepartment($contactID, $departmentID) {

            echo $contactID . " en " .$departmentID;

        }
    }
?>