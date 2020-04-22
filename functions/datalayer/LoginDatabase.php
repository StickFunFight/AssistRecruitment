<?php
require_once 'database.class.php';

class LoginDatabase {
    private $db;

    public function createUser($username, $passwordHash, $email) {
         $connection = new Database();
         $db = $connection->getConnection();
         $userRight = "test";
         $userID = 501;

         $stmt = $db->prepare("INSERT INTO user (userID, userNaam, userEmail, userPassword, userRights) VALUES (?, ?, ?, ?, ?)");
         $stmt->bindParam(1, $userID);
         $stmt->bindParam(2, $username);
         $stmt->bindParam(3, $email);
         $stmt->bindParam(4, $passwordHash);
         $stmt->bindParam(5, $userRight);
         $stmt->execute();
    }

}