<?php
require_once 'head.php';
require_once '../functions/controller/LoginController.php';
$lc = new LoginController();

if (isset($_POST['submitCreateAccount'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $lc->createUser($username, $password, $email);
}

if (isset($_POST['submitLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $lc->logIn($username, $password);
}

if (isset($_POST['resetPassword'])) {
    $email = $_POST['email'];

    $lc->forgotPassword($email);
}
?>

<head>
    <script><?php include '../assests/script/toast.js'; ?></script>
    <style><?php include '../assests/styling/loginScreen.css' ?></style>
    <style><?php include '../assests/styling/toast.css' ?></style>
    <title>Assist login</title>
</head>
<body>
<div class="container">
    <img class="logo" src="../assests/images/logoFullAssist.png" alt="Assist logo">
</div>
<div class="container login-form pb-1">
    <form method="post" class="form-group">
        <input name="username" class="form-control mt-2" type="text" placeholder="Gebruikersnaam"><br>
        <input name="password" class="form-control mt-n2" type="password" placeholder="Wachtwoord"><br>
        <button name="submitLogin" type="submit" class="btn btn-block btn-primary mt-2 mb-4 float-right formButton">
            Inloggen
        </button>
    </form>
    <p class="mb-1"><u><a data-toggle="modal" href="#createAccount" class="font-weight-bold">Maak een account aan +</a></u>
    </p>
    <p><u><a data-toggle="modal" href="#forgotPassword" class="font-weight-bold">Wachtwoord vergeten?</a></u></p>
</div>

<div id="snackbar">Jij hebt grote fout gemaakt !!!</div>

<!-- Modal -->
<!-- Create Account Modal -->
<div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Aanmaken</h5>
            </div>
            <form method="post" class="form-group">
                <div class="modal-body">
                    <div class="form-group form-row mb-4">
                        <label class="col col-form-label">Gebruikersnaam</label>
                        <div class="col-7">
                            <input name="username" id="username" class="form-control" type="text"
                                   placeholder="Gebruikersnaam"">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label class="col col-form-label">Wachtwoord</label>
                        <div class="col-7">
                            <input name="password" id="password" class="form-control" type="password"
                                   placeholder="Wachtwoord">
                        </div>
                    </div>
                    <div class="form-group form-row mb-4">
                        <label class="col col-form-label">Bevestig wachtwoord</label>
                        <div class="col-7">
                            <input class="form-control" type="password" placeholder="Bevestig Wachtwoord">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label class="col col-form-label">Email</label>
                        <div class="col-7">
                            <input name="email" id="email" class="form-control" type="email" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Sluiten</button>
                    <button name="submitCreateAccount" id="submitCreateAccount" type="submit" class="btn btn-success">
                        Bevestigen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Password Reset Modal -->
<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset wachtwoord</h5>
            </div>
            <form method="post" class="form-group">
                <div class="modal-body">
                    <div class="form-group form-row mb-4">
                        <label class="col col-form-label">Email</label>
                        <div class="col-7">
                            <input name="email" id="email" class="form-control" type="email" placeholder="Email"">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Sluiten</button>
                    <button name="resetPassword" type="submit" class="btn btn-success">Bevestigen</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
