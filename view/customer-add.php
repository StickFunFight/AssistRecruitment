<?php
    include '../functions/controller/CustomerController.php';
    require('menu.php');
    $ctrlCustomer = new CustomerController();

    if(isset($_POST['submitCreateCustomer'])){
        $customerName = $_POST['customerName'];
        $customerComment = $_POST['customerComment'];
        $customerReference = $_POST['customerReference'];

        $ctrlCustomer->createCustomer($customerName, $customerComment, $customerReference);
    }
?>

<!--This is where the HTML code comes in-->
<html>
<link rel="stylesheet" href="../assests/styling/customer-add.css">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <head>
        <meta charset = "utf-8">
        <title>Add customer</title>
    </head>
    <body>
        <div class="page__content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page__title">Create custmoer</h1>
                    </div>
                </div>

                <!--Creating an HTML form-->
                <form method="post" class="customer-form">
                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Customer name:</label>
                            <input name="customerName" class="form-control customer-add__input" type="text" required>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Customer reference:</label>
                            <input name="customerReference" class="form-control customer-add__input" type="text" required>
                        </div>
                    </div>

                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Customer comment:</label>
                            <textarea name="customerComment" class="form-control customer-add__input" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <input name="submitCreateCustomer" class="btn btn-add" type="submit" id="createCustomerButton" value="Add customer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>