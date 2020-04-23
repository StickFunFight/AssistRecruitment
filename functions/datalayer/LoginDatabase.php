<?php
include 'database.class.php';
include '../functions/models/User.php';

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

         try {
            return $stmt->execute();
         } catch (PDOException $exception){
            return false;
         }
    }

    public function getUser($username){
        $connection = new Database();
        $getUser = null;
        $db = $connection->getConnection();

        $stmt = $db->prepare("SELECT * FROM user WHERE userName = ?");
        $stmt->bindParam(1, $username);

        try {
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultSet as $user) {
                $userSet = new User($user->userID, $user->userName, $user->userEmail, $user->userPassword, $user->userRights, $user->userStatus);
                $getUser = $userSet;
            }

            return $getUser;
        } catch(PDOException $exception){
            return null;
        }
    }

}