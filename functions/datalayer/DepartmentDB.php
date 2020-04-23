<?php
    require_once 'database.class.php';

    Class DepartmentDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getDepartmentsCustomer($customerID, $statusDepartment){
            // Creating a array
            $listDepartments = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID
                            FROM department dp
                            INNER JOIN customer c ON dp.customerID = c.customerID
                            WHERE c.customerID = %d AND dp.departmentStatus = '%s'", $customerID, $statusDepartment);
            $stm = $this->db->prepare($query);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $department){
                    // Putting it in the modal
                    $entDepartment = new entDepartment($department->departmentID, $department->departmentName, $department->departmentComment, $department->departmentStatus, $department->customerID);
                    array_push($listDepartments, $entDepartment);
                }
                // Returning the full list
                return $listDepartments;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
            }
        }
    }
?>