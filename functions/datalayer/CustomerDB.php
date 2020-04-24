<?php

require_once '../functions/datalayer/database.class.php';

Class CustomerDB {
         private $db;
        
    public function __construct(){
        //Create a connection with the Database 
        $database = new Database();
        $this->db = $database->getConnection();

    }

function getCustomers($status){
   // Create an Array for the function
      $listCustomers = array();

      // Query to select data from customer table
        $query = "SELECT * FROM customer WHERE customerStatus = '$status'";
        $stm = $this->db->prepare($query);
        if($stm->execute()){
            // Get Results from the Database
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            // Create a loop to get all customers from the customer table
            foreach($result as $customer){
                // Call Entity Class to get values for each customer
                $entCustomer = new entCustomer($customer->customerID, $customer->customerName, $customer->customerComment, $customer->customerReference, $customer->customerStatus);
                array_push($listCustomers, $entCustomer);
                    }       
                // Return full list
                return $listCustomers;       
                }
                // Error Text
                else {
                    echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
                }
                }

function archiveCustomer($customerID){
// Create Query to update Customer Status
$query = "UPDATE customer SET customerStatus = 'Archived' WHERE customerID = $customerID";
$stm = $this->db->prepare($query);
if($stm->execute()){
    echo 'Het is gelukt';
}
// Error Text
else {
    echo "Er is iets fout gegaan";
}
}

}
