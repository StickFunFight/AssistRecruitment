<?php
    include '../functions/controller/DepartmentController.php';
    include '../functions/controller/CustomerController.php';
    include '../functions/models/entCustomer.php';
    $ctrlDepartment = new DepartmentController();
    $CustomerCtrl = new CustomerController();

    $customerID;

    // Checking if there is a customer
    // If there is no customer you can select a customer
    if(isset($_GET['customer'])) {
        $customerID = $_GET['customer'];
    } else {
        $customerID = 0;
    }

    require('menu.php');
?>

<!--This is where the HTML code comes in-->
<html>
<link rel="stylesheet" href="../assests/styling/customer-add.css">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <head>
        <title>Department add</title>
    </head>
    <body>
        <div class="page__content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title">Create department</h1>
                    </div>
                </div>

                <!--Creating an HTML form-->
                <form method="POST" class="department-form">
                <input type="hidden" name="txtCustomerID" id="custID" value="<?php echo $customerID; ?>">
                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Department name</label>
                            <input name="departmentName" class="form-control customer-add__input" type="text" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="ce__label">Customer</label>
                            <select name="cbxCustomer" class="form-control" id="customerSelect" onchange="changeSelectCustomer()">
                                <?php 
                                    // Checking for customer. If there is, lock it in that customer
                                    // Creating an variable to fill it later
                                    $listCustomers;

                                    if (!empty($customerID)) {
                                        // Filling the list
                                        $listCustomers =  $CustomerCtrl->getCustomerDetails($customerID); 
                                        //Showing a select where you can't pick a customer
                                        echo "<script> setCustomerSelectDisabeld(); </script>";
                                    }  else {
                                        $listCustomers = $CustomerCtrl->getCustomers('Active');
                                    }
                                    
                                    foreach($listCustomers as $customer){
                                        if($customer->getCustomerID() == $customerID) {
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
                        <div class="col-sm-6">
                            <label class="ce__label">Department comment</label>
                            <textarea name="departmentComment" class="form-control customer-add__input" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <input name="submitCreateDepartment" class="btn btn-add" type="submit" id="createDepartmentButton" value="Add department">
                        </div>
                    </div>

                    <div class="feedback">
                        <?php 
                            if(isset($_POST['submitCreateDepartment'])){
                                $departmentName = $_POST['departmentName'];
                                $departmentComment = $_POST['departmentComment'];
                                $customerID = $_POST['txtCustomerID'];

                                $ctrlDepartment->CreateDepartment($departmentName, $departmentComment, $customerID);
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>