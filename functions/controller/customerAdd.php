<?php
include '../functions/datalayer/customerDatabase.php';

class customerAdd {
    private $custAdd;

    public function __construct() {
        $this->custAdd = new customerDatabase();
    }

    public function createCustomer($customerName, $customerComment, $customerReference) {
        if($this->custAdd->createCustomer($customerName, $customerComment, $customerReference)){
            echo "Customer toegevoegd!";
        } else {
            echo "Er heeft zich een fout plaats gevonden in de customerAdd klasse! (regel 11)";
        }
    }


}
    // $conn = new mysqli('assist.tk', 'assist_remote', 'KPg$R%Tsd@Y%', 'assist');
    // if ($conn->connect_error){
    //     die('Connection Failed  :  '.$conn->connect_error);
    // }else{

        
        // $connection = new Database();
        // $db = $connection->getConnection();

        // private $customerID;

        // $customerName = $_POST['customerName'];
        // $customerComment = $_POST['customerComment'];

        // $customerReference = "TestQR";
        // $customerStatus = "Active";

        // $stmt = $conn->prepare("INSERT INTO customer (customerID, customerNaam, customerComment, customerReference, customerStatus) VALUES (?, ?, ?, ?, ?)");
        // $stmt->bindParam(1, $customerID);
        // $stmt->bindParam(2, $customerName);
        // $stmt->bindParam(3, $customerComment);
        // $stmt->bindParam(4, $customerReference);
        // $stmt->bindParam(5, $customerStatus);
        // $stmt->execute();

        // $stm = $conn->prepare("INSERT INTO customer(customerID, customerNaam, customerComment, customerReference, customerStatus) VALUES (?, ?, ?, ?, ?)");
        // $stm->bind_param("issss", 'iets', $customerName, $customerComment, 'iets', 'iets');
        // $stm->execute();

        // $stm->close();
        // $conn->close();
?>