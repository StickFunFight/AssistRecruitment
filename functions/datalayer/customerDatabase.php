<?php
include 'database.class.php';
include '../functions/models/User.php';

class customerDatabase {

   //Function to bind the values required to execute the createCustomer function in the customerAdd class.
   public function createCustomer($customerName, $customerComment, $customerReference) {
      $connection = new Database();
      $db = $connection->getConnection();

      $customerStatus = 'Active';

      //A query is create here and values are being bound to the parameters inside the query.
      $stmt = $db->prepare("INSERT INTO customer (customerID, customerName, customerComment, customerReference, customerStatus) VALUES (?, ?, ?, ?, ?)");
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
}

?>