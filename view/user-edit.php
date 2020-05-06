<?php 
    if (isset($_GET['user'])) {
        $userID = $_GET['user'];

        // Inlcude Database class
        require '../functions/datalayer/database.class.php';
        // Including controller
        require '../functions/controller/contactController.php';
        require '../functions/controller/CustomerController.php';
        //require '../functions/controller/userController.php';
        // Including entity classes
        require '../functions/models/entCustomer.php';

        // Including the head and menu
        require 'menu.php';

        // Creating connections with the classes
        $CustomerCtrl = new CustomerController();
        $ContactCtrl = new ContactController();

        // Creating a customer id to fil it later
        $customerID;

        // If there is a customer id, it will be of the customer, else it will be 0
        // This is to later check wich functions shouldn't be activeted
        if(isset($_GET['customer']) && $_GET['customer'] != 0) {
            $customerID = $_GET['customer'];
        }else {
            $customerID = 0;
        }

        // Creating the list for the customer details
        $customerDetails;

        // getting the customer details
        // Looping through the results at the end of the file
        if ($customerID != 0) {
            // Filling the list
            $customerDetails = $CustomerCtrl->getCustomerDetails($customerID); 
        }  

        // Getting the details of the user
        $detailsUser

?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Edit User<h1>
                    </div>
                </div>

                <form method="POST" autocomplete="off" action="?customer=<?php echo $customerID; ?>">
                    <!-- Customer ID for refrence -->
                    <input type="hidden" name="txtCustomerID" value="">

                    <div class="row ce--form-row">
                        <!-- <div class="col-sm-12">
                            <label for="existingUsers" class="au__label">Choose an existing user</label>
                            <input type="text" class="form-control au--input" name="txtSearchUser" id="searchUser" placeholder="type a name">
                        </div> -->
                    </div>
                </from>
            </div>
        </div> 
    </body>

    <?php
        // // Creating the list for the excisting user
        // $listExcistingUsers;

        // // getting the excisting user minus the one already connected to the user
        // if ($customerID != 0) {
        //     // Filling the list
        //     $listExcistingUsers = $CustomerCtrl->getCustomerDetails($customerID); 
        // } else {
        //     // Filling the list with user linked to a customer
        // }

    } else {
        header('Location: cust_listed');
    }
    ?>
</html>
