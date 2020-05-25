<?php
    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Include Controller class
    require '../functions/controller/UserController.php';
    require '../functions/controller/contactController.php';
    // Include Entiteit class
    require '../functions/models/entUser.php';
    require '../functions/models/entContact.php';

    // Creating connections with the classes
    $UserCtrl = new UserController();
    $ContactCtrl = new ContactController();

?>

<html>
    <head>
        <?php
            //Include Menu
            require('menu.php');
        ?>
        <!-- Linking to own styleheet -->
        <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    </head>

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Profile<h1>
                    </div>
                </div>

                <div class = "row">
                     

                </div>