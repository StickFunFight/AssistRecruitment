<?php
    require_once '../functions/datalayer/DepartmentDB.php';

    Class DepartmentController {
        
        private $departmentDB;   
    
        public function __construct(){
            $this->departmentDB = new DepartmentDB();
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