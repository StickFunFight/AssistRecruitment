<?php
include 'head.php';
include '../functions/controller/customerAdd.php';
require('menu.php');
$ca = new customerAdd();

if(isset($_POST['submitCreateCustomer'])){
    $customerName = $_POST['customerName'];
    $customerComment = $_POST['customerComment'];
    $customerReference = $_POST['customerReference'];

    $ca->createCustomer($customerName, $customerComment, $customerReference);
}
?>

<!--This is where the HTML code comes in-->
<html>
<link rel="stylesheet" href="../assests/styling/customer.css">
    <head>
        <meta charset = "utf-8">
        <title>An interesting title</title>
    </head>
    <body>
        <div class="page__content">
            <div class="container customer-form">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page__title">Customer aanmaken</h1>
                    </div>
                </div>
                <!--Creating an HTML form-->
                <form method = "post" class = "customer-form">
                    <label class = "form__label">Customer name:</label>
                    <input name = "customerName" class = "form-control" type = "text" required><br>
                    <label class = "form__label">Customer reference:</label>
                    <input name = "customerReference" class = "form-control" type="text" required><br>
                    <div class = "row page__row">
                        <div class = "col-sm-12">
                            <label class = "form__label">Customer comment:</label>
                            <textarea name = "customerComment" class = "form-control" rows = "5"></textarea>
                        </div>
                    </div>
                    <button name = "submitCreateCustomer" class = "mt-2" type = "submit" id = "createCustomerButton">Send customer form</button>
                </form>
            </div>
        </div>
    </body>
</html>