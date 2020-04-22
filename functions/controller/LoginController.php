<?php
include '../functions/datalayer/LoginDatabase.php';

class LoginController {
    private $ldb;

    public function __construct() {

        $this->ldb = new LoginDatabase();
    }

    public function createUser($username, $password, $email) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->ldb->createUser($username, $hash, $email);
    }

}