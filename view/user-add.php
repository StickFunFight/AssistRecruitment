<?php 
    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Including controller
    require '../functions/controller/CustomerController.php';
    require '../functions/controller/UserController.php';
    // Including entity classes
    require '../functions/models/entContact.php';
    require '../functions/models/entCustomer.php';

    // Including the head and menu
    require 'menu.php';

    // Creating connections with the classes
    $UserCtrl = new UserController();
    $CustomerCtrl = new CustomerController();

    // Creating a customer id to fil it later
    $customerID = 0;

    // If there is a customer id, it will be of the customer, else it will be 0
    // This is to later check wich functions shouldn't be activeted
    if(isset($_POST['submitCreateUser'])){
        $UserName = $_POST['userName'];
        $UserEmail = $_POST['userEmail'];
        $UserType = $_POST['userType'];
        $userPhone = $_POST['userPhonenumber'];
        $userComment = $_POST['userComment'];
        $userCustomer = $_POST['cbxCustomer'];

        $UserCtrl->createUser($UserName, $UserEmail, $UserType, $userPhone, $userComment, $userCustomer);
    }

    if (isset($_GET['customer'])) {
        $customerID = $_GET['customer'];
    }

    // Creating the list for the customer details
    $customerDetails;

    // getting the customer details
    // Looping through the results at the end of the file
    if ($customerID != 0) {
        // Filling the list
        $customerDetails = $CustomerCtrl->getCustomerDetails($customerID); 
    }  
?>
<html>
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
<link rel="stylesheet" href="../assests/styling/customer.css">

<body>
<div class="page__container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="ce__title" id="pageTitle">Overview Users<h1>
            </div>
        </div>

        <!-- <form method="POST" autocomplete="off" action="?customer=<?php echo $customerID; ?>"> -->
        <!-- Customer ID for refrence -->
        <!-- <input type="hidden" name="txtCustomerID" value="">

        <div class="row ce--form-row">
            <div class="col-sm-12">
                <label for="existingUsers" class="au__label">Choose an existing user</label>
                <input type="text" class="form-control au--input" name="txtSearchUser" id="searchUser" placeholder="type a name">
            </div>
        </div>
    </from> -->
        <form method="post" class="user-form">
            <div class="row ce--form-row">
                <div class="col-sm-6">
                    <label class="ce__label">E-mail</label>
                    <input name="userEmail" class="form-control user-add__input" type="text">
                </div>

                <form method="post" class="user-form">
                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">E-mail</label>
                            <input name="userEmail" class="form-control ce--input" type="text">
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Username</label>
                            <input name="userName" class="form-control ce--input" type="text">
                        </div>
                    </div>
                
                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Type</label>
                            <select name="userType" class="form-control ce--input">
                                <option value="Employee">Employee</option>
                                <option value="Candidate">Candidate</option>
                            </select>
                        </div>
                    </div>

                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Phone number</label>
                            <input name="userPhonenumber" class="form-control ce--input" type="text" required>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Date of birth</label>
                            <input name="userBirthdate" class="form-control ce--input" type="date" required>
                        </div>
                    </div>

                    <div class="row page__row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Comment</label>
                            <textarea name="userComment" class="form-control ce--input" rows="5"></textarea>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="ce__label">Customer</label>
                            <select class="form-control" name="cbxCustomer" id="customerSelect" onchange="changeSelectCustomer()">
                                <?php 
                                    // Checking for customer. If there is, lock it in that customer
                                    // Creating an variable to fill it later
                                    $listCustomers;

                                    if ($customerID != 0) {
                                        // Filling the list
                                        $listCustomers =  $CustomerCtrl->getCustomerDetails($customerID); 
                                        //Showing a select where you can't pick a customer
                                        echo "<script> setCustomerSelectDisabeld(); </script>";
                                    }  else {
                                        $listCustomers = $CustomerCtrl->getCustomers('Active');
                                    }
                                    
                                    foreach($listCustomers as $customer) {
                                        if ($customer->getCustomerID() == $customerID) {
                                            ?>
                                                <option selected="selected" value="<?php echo $customer->getCustomerID(); ?>"><?php echo $customer->getCustomerName(); ?></option>
                                            <?php
                                        } else {
                                            ?>
                                                <option value="<?php echo $customer->getCustomerID(); ?>"><?php echo $customer->getCustomerName(); ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <input name="submitCreateUser" class="btn btn-status" type="submit" id="createUserButton" value="Add user">
                        </div>
                    </div>
            </div>
        </div> 
    </body>

    <?php
        // Creating the list for the excisting user
        $listExcistingUsers;

        // getting the excisting user minus the one already connected to the user
        if ($customerID != 0) {
            // Filling the list
            $listExcistingUsers = $CustomerCtrl->getCustomerDetails($customerID); 
        } else {
            // Filling the list with user linked to a customer
        }
    ?>
</html>
