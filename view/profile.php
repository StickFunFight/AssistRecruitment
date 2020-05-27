<?php
// Inlcude Database class
require '../functions/datalayer/database.class.php';
// Include Controller class
require '../functions/controller/UserController.php';
require '../functions/controller/contactController.php';
// Include Entiteit class
require '../functions/models/entContact.php';

// Creating connections with the classes
$UserCtrl = new UserController();
$ContactCtrl = new ContactController();
$userID = 568;

$detailsUser = $UserCtrl->getProfile($userID);

foreach($detailsUser as $user)

?>

<html>

<head>
    <?php
    //Include Menu
    require('menu.php');
    ?>
    <!-- Linking to own styleheet -->
    <link rel="stylesheet" href="../assests/styling/profile.css">
</head>

<body>
    <div class="page__container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="ce__title" id="pageTitle">Profile<h1>
                </div>
            </div>

            <div class="row">
                <h2 class="ce_title" id="Title">Account details</h2>
            </div>
            <form method="post" class="customer-form">
                <div class="row ce--form-row">
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblUserName">Username:</label>
                        <input class="form-control txt_field" name="txtUserName" type="text" value="<?php echo $user->getContactName(); ?>" readonly> </input>
                    </div>
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblPassword">E-mail:</label>
                        <input class="form-control txt_field" name="txtPassword" type="text" value="<?php echo $user->getContactEmail(); ?>"readonly></input>
                    </div>
                </div>

                <div class="row page__row ce--form-row">
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblUserName">Phonenumber:</label>
                        <input class="form-control txt_field" name="txtUserName" type="text" value="<?php echo $user->getContactPhoneNumber(); ?>"readonly></input>
                    </div>
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblPassword">Status:</label>
                        <input class="form-control txt_field" name="txtPassword" type="text" value="<?php echo $user->getContactStatus(); ?>" readonly></input>
                    </div>
                </div>
            </form>
            <div class="row">
                <h2 class="ce_title" id="Title">Edit password</h2>
            </div>
            <form method="post" class="customer-form">
                <div class="row ce--form-row">
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblUserName">Password:</label>
                        <input class="form-control txt_field" name="txtUserName" type="password"></input>
                    </div>
                </div>

                <div class="row page__row ce--form-row">
                    <div class="col-sm-6">
                        <label class="lbl_textfield" name="lblPassword">New Password:</label>
                        <input class="form-control txt_field" name="txtPassword" type="password"></input>
                    </div>
                </div>
                <div class="row page__row ce--form-row">
                    <div class=col-sm-6>
                        <label class="lbl_textfield" name="lblPassword">Repeat Password:</label>
                        <input class="form-control txt_field" name="txtPassword" type="password"></input>
                    </div>
                </div>
                <div class="btn__row">
                    <div>
                        <button type="button" class="btnSubmit">Submit </button>
                    </div>
                </div>
        </div>
    </div>

    </form>

</html>