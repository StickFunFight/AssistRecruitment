<?php
    require_once '../functions/datalayer/DepartmentDB.php';

    Class DepartmentController {
        
        private $departmentDB;   
    
        public function __construct(){
            $this->departmentDB = new DepartmentDB();
        }

        public function createDepartment($departmentName, $departmentComment, $customerID) {
            
            if($this->departmentDB->createDepartment($departmentName, $departmentComment, $customerID)){
                echo "Department succesfully added!";
            } else {
                echo "An error has occured.";
            }
        }

        function getDepartments($statusDepartment){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartments($statusDepartment);

            // Returning the list given from the Database class
            return $listDepartments;
        }

        function getDepartmentsCustomer($customerID, $statusDepartment){
            // Creating a array
            $listDepartments = array();

            $listDepartments = $this->departmentDB->getDepartmentsCustomer($customerID, $statusDepartment);

            // Returning the list given from the Database class
            return $listDepartments;
        }
    }
?>