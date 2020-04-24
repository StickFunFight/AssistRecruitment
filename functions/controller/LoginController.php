<?php
include '../functions/datalayer/LoginDatabase.php';

class LoginController {
    private $ldb;

    public function __construct() {
        $this->ldb = new LoginDatabase();
    }

    public function createUser($username, $password, $email) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if($this->ldb->createUser($username, $hash, $email)){
            echo "afgeklapt";
        } else {
            echo "Het lijkt er op dat dit account al bestaat";
        }
    }

    public function logIn($username, $password){
        $user = $this->ldb->getUser($username);

        if(!is_null($user) && $user->getUserPassword() != null){
            if($username == $user->getUsername() && password_verify($password, $user->getUserPassword())){
                header("Location: menu.php");
            } else {
                echo "Credentials zijn onjuist";
            }
        } else {
            echo "Er ging iets mis";
        }
    }

    public function forgotPassword($email){

    }

}