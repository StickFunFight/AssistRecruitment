<?php
require "head.php";
require_once '../functions/controller/LoginController.php';
?>

<head>
    <style><?php include '../assests/styling/loginScreen.css' ?></style>
</head>
<body>
    <div class="container">
        <img class="logo" src="../assests/images/logoFullAssist.png" alt="Assist logo">
    </div>
    <div class="container login-form pb-1">
        <form method="post" class="form-group">
            <input name="password" class="form-control mt-2" type="password" placeholder="Wachtwoord"><br>
            <input name="passwordConfirm" class="form-control mt-n2" type="password" placeholder="Bevestig Wachtwoord"><br>
            <button name="submitLogin" onclick="location.href='http://localhost/AssistRecruitment/view/loginScreen.php'" type="button" class="btn btn-primary mt-2 mb-4 float-left formButton">Terug</button>
            <button name="submitPasswordReset" type="submit" class="btn btn-primary mt-2 mb-4 float-right formButton">Bevestigen</button>
        </form>
    </div>
</body>