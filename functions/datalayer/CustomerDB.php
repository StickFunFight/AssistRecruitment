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
        $query = sprintf("SELECT * FROM customer WHERE customerStatus = '%s'
                        ORDER BY customerName ASC", $status);
        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            // Get Results from the Database
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            // Create a loop to get all customers from the customer table
            foreach ($result as $customer) {
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
         
    //Function to bind the values required to execute the createCustomer function in the customerAdd class.
    public function createCustomer($customerName, $customerComment, $customerReference) {

        $customerStatus = 'Active';

        //A query is create here and values are being bound to the parameters inside the query.
        $stmt = $this->db->prepare("INSERT INTO customer (customerID, customerName, customerComment, customerReference, customerStatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $customerID);
        $stmt->bindParam(2, $customerName);
        $stmt->bindParam(3, $customerComment);
        $stmt->bindParam(4, $customerReference);
        $stmt->bindParam(5, $customerStatus);

        //The previous query statement will be executed here.
        try {
            return $stmt->execute();
        } catch (PDOException $exception){
            return false;
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

    function deleteCustomer($customerID){
        // Create Query to update Customer Status
        $query = "UPDATE customer SET customerStatus = 'Deleted' WHERE customerID = $customerID";
        $stm = $this->db->prepare($query);
        if($stm->execute()){
            echo 'Het is gelukt';
        }
        // Error Text
        else {
            echo "Er is iets fout gegaan";
        }
    }

    function activateCustomer($customerID){
        // Create Query to update Customer Status
        $query = "UPDATE customer SET customerStatus = 'Active' WHERE customerID = $customerID";
        $stm = $this->db->prepare($query);
        if($stm->execute()){
            echo 'Het is gelukt';
        }
        // Error Text
        else {
            echo "Er is iets fout gegaan";
        }
    }

    // Function to get the details of a customer
    function getCustomerDetails($customerID) {
        // Array aanmaken voor de functies
        $detailsCustomer = array();

        // Query  to get the customer
        $query = "SELECT * FROM customer WHERE customerID = ?";
        $stm = $this->db->prepare($query);
        $stm->bindParam(1, $customerID);
        if($stm->execute()){
            // Resultaten uit de database halen
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            // Loop aanmaken om alle rijen in een array te doen
            foreach($result as $customer){
                // Entiteit aanroepen om de waardes op te halen en in de array te doen
                $entCustomer = new EntCustomer($customer->customerID, $customer->customerName, $customer->customerComment, $customer->customerReference, $customer->customerStatus);
                array_push($detailsCustomer, $entCustomer);
            }
            // De volledige lijst teruggeven
            return $detailsCustomer;    
        }
        // Tekst laten zien voor als er geen functies zijn opgehaald
        else{
            echo "Oof";
        }
    }

    // Function to update the customer
    function updateCustomer($customerID, $customerName, $customerReference, $customerComment, $customerStatus) {
        // Query aanmaken om alle functies uit de database te halen
        $query = sprintf("UPDATE customer SET customerName = '%s', customerReference = '%s', customerComment = '%s', customerStatus = '%s' WHERE customerID = %d", $customerName, $customerReference, $customerComment, $customerStatus, $customerID);
        $stm = $this->db->prepare($query);
        if($stm->execute()){
            // Sending true back for succes message
            return true;
        } else {
            // Sending false back for error message
            return false;
        }
    }

}

?>
