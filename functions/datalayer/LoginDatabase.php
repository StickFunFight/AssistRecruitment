<?php
require_once 'database.class.php';

class LoginDatabase {
    private $db;

    public function createUser(User $user) {
         $connection = new Database();
         $db = $connection->getConnection();
         $stmt = $db->prepare("INSERT INTO user (userNaam, userEmail, userPassword, userPasswordSalt, userRights) VALUES (?, ?, ?, ?, ?)");
         $stmt->bind_param("ssssi", $user->getUsername(), $user->getUserEmail(), $user->getUserPassword(), $user->getUserPasswordSalt(), $user->getIsAdmin());

         $stmt->execute();
         $stmt->close();
         $db->close();
    }

}