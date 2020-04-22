<?php
include 'head.php';
include '../functions/controller/LoginController.php';
$lc = new LoginController();

if(isset($_POST['submitCreateAccount'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $lc->createUser($username, $password, $email);
}
?>

<head>
    <style><?php include '../assests/styling/loginScreen.css' ?></style>
    <title>Assist login</title>
</head>
<body>
    <div class="container">
        <img class="logo" src="../assests/images/logoFullAssist.png" alt="Assist logo">
    </div>
    <div class="container login-form pb-1">
        <form method="POST" class="form-group">
            <input class="form-control mt-2" type="text" placeholder="Gebruikersnaam"><br>
            <input class="form-control mt-n2" type="password" placeholder="Wachtwoord"><br>
            <button type="submit" class="btn btn-block btn-primary mt-2 mb-4">Inloggen</button>
        </form>
        <p class="mb-1"><u><a data-toggle="modal" href="#createAccount" class="font-weight-bold">Maak een account aan +</a></u>
        </p>
        <p><u><a href="#blank" class="font-weight-bold">Wachtwoord vergeten?</a></u></p>
    </div>

<!-- Modal -->
    <div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Aanmaken</h5>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group form-row mb-4">
                            <label class="col col-form-label">Gebruikersnaam</label>
                            <div class="col-7">
                                <input name="username" class="form-control" type="text" placeholder="Gebruikersnaam"">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col col-form-label">Wachtwoord</label>
                            <div class="col-7">
                                <input name="password" class="form-control" type="password" placeholder="Wachtwoord">
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
                                <input name="email" class="form-control" type="text" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Sluiten</button>
                        <button name="submitCreateAccount" type="submit" class="btn btn-success">Bevestigen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
