<?php
include 'head.php';
include '../functions/controller/customerAdd.php';
$ca = new customerAdd();

if(isset($_POST['submitCreateCustomer'])){
    $customerName = $_POST['customerName'];
    $customerComment = $_POST['customerComment'];
    $customerReference = $_POST['customerReference'];

    $ca->createCustomer($customerName, $customerComment, $customerReference);
}

?>
    <head>
        <meta charset="utf-8">
        <title>An interesting title</title>
    </head>
    <body>
    <div class="container customer-form">
        <form method="post" class="customer-form">
            <input name="customerName" type="text" placeholder="Customer name"><br>
            <input name="customerComment" type="text" placeholder="Customer comment"><br>
            <input name="customerReference" type="text" placeholder="Customer reference"><br>
            <button name="submitCreateCustomer" type="submit" id="createCustomerButton">Send customer form</button>
        </form>
    </div>


        <!-- <main>
            <p>SEND CUSTOMER FORM</p>
            <form class="customer-form" action="customerForm.php" method="post">
                <input type="text" name="customerName" placeholder="Full name">
                <input type="text" name="customerComment" placeholder="Comment">
                <button type="submit" name="submit">SEND CUSTOMER FORM</button>
            </form>
        </main> -->


    </body>
