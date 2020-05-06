<?php
    require_once 'database.class.php';

    Class DepartmentDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        function getDepartments($statusDepartment){
            // Creating a array
            $listDepartments = array();

            // Making a query to get the scans of the customer out the database
            $query = sprintf("SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID
                            FROM department dp
                            INNER JOIN customer c ON dp.customerID = c.customerID
                            WHERE dp.departmentStatus = '%s'", $statusDepartment);
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

        public function createDepartment($departmentName, $departmentComment, $customerID) {

            $departmentStatus = 'Active';
    
            //A query is create here and values are being bound to the parameters inside the query.
            $stmt = $this->db->prepare("INSERT INTO department (departmentID, departmentName, departmentComment, departmentStatus, customerID) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $departmentID);
            $stmt->bindParam(2, $departmentName);
            $stmt->bindParam(3, $departmentComment);
            $stmt->bindParam(4, $departmentStatus);
            $stmt->bindParam(5, $customerID);
    
            //The previous query statement will be executed here.
            try {
                return $stmt->execute();
            } catch (PDOException $exception){
                return false;
            }
        }
    }
?>