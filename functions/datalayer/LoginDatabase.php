<?php
require_once 'database.class.php';

class LoginDatabase {

    public function createUser($username, $passwordHash, $email) {
         $connection = new Database();
         $db = $connection->getConnection();
         $userRight = 0;

         $stmt = $db->prepare("INSERT INTO user (userName, userEmail, userPassword, userRights) VALUES (?, ?, ?, ?)");
         $stmt->bindParam(1, $username);
         $stmt->bindParam(2, $email);
         $stmt->bindParam(3, $passwordHash);
         $stmt->bindParam(4, $userRight);
         $stmt->execute();
    }

}