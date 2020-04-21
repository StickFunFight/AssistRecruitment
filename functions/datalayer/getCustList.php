<?php

require_once 'database.class.php';



Class CustomerDB {
    
    
    private $db;
    
    public function __construct(){

        //maakt een nieuwe connectie 

    }

function getCustomers(){

    $database = new Database();
    $db = $database->getConnection();

    // Array aanmaken voor de functies
    $listCustomers = array();

// Query aanmaken om alle functies uit de database te halen
$query = "SELECT * FROM customer WHERE customerStatus = 'Active'";
$stm = $db->prepare($query);
if($stm->execute()){
    // Resultaten uit de database halen
    $result = $stm->fetchAll(PDO::FETCH_OBJ);
    // Loop aanmaken om alle rijen in een array te doen
    foreach($result as $customer){
        // Entiteit aanroepen om de waardes op te halen en in de array te doen
        $entCustomer = new entCustomer($customer->customerID, $customer->customerNaam, $customer->customerComment, $customer->customerRefrence, $customer->customerStatus);
        array_push($listCustomers, $entCustomer);
    }

    // De volledige lijst teruggeven
    return $listCustomers;
    
    
}
// Tekst laten zien voor als er geen functies zijn opgehaald
else{
    echo "Er is iets fout gegaan wardoor er geen functies opgehaald konden worden";
}
}

}
?>