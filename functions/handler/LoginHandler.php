<?php
require_once '../functions/LoginController.php';

//TODO: Fix this broken functionality
if(isset($_POST['passwordReset'])) {
    $loginController = new LoginController();
    $result = $loginController->createUser();
    echo $result;
}