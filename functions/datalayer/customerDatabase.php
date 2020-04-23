<?php
include 'database.class.php';
include '../functions/models/User.php';

class customerDatabase {

    public function createCustomer($customerName, $customerComment, $customerReference) {
        $connection = new Database();
        $db = $connection->getConnection();

        $customerStatus = 'Active';

        $stmt = $db->prepare("INSERT INTO customer (customerID, customerName, customerComment, customerReference, customerStatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $customerID);
        $stmt->bindParam(2, $customerName);
        $stmt->bindParam(3, $customerComment);
        $stmt->bindParam(4, $customerReference);
        $stmt->bindParam(5, $customerStatus);

        try {
           return $stmt->execute();
        } catch (PDOException $exception){
           return false;
        }
   }

}

?>