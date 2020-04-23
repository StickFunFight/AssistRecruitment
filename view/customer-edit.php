<?php  
    if (isset($_GET['customer'])) {
    
        $customerID = $_GET['customer'];

        require '../functions/datalayer/database.class.php';
        // Adding the customer controller
        require '../functions/controller/getCustList.php';
        // Adding the customer modal
        require '../functions/models/entCustomer.php';

        //Connectie maken met class CustomerDB
        $CustomerDB = new CustomerDB(); 

        // Including the menu and head
        require "menu.php";

        // Getting the customer
        $detailsCustomer = $CustomerDB->getCustomerDetails($customerID);

        // Loop through result
        foreach($detailsCustomer as $customer){
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <h1 class="ce__title">Edit customer<h1>
                    </div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row justify-content-md-center ce--form-row">
                        <div class="col-sm-6">
                            <label for="customerName" class="ce__label">Name</label>
                            <input type="text" name="txtCustomerName" id="customerName" value="<?php ?>" class="form-control ce--input" required />
                            <span class="ce__feedback" id="feedbackCustomerName"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="customerRefrence" class="ce__label">Refrence</label>
                            <input type="text" name="txtcustomerRefrence" id="customerRefrence" value="<?php ?>" class="form-control ce--input" required onchange=""/>
                            <span class="ce__feedback" id="feedbackCustomerRefrence"></span>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-sm-6">
                            <label for="customerComment" class="ce__label">Comment</label>
                            <textarea name="txtCustomerComment" id="customerComment" class="form-control ce--input" rows="5" onchange=""></textarea>
                            <span class="ce__feedback" id="feedbackCustomerComment"></span>
                        </div>

                        <?php echo getCustomerStatus(); ?>

                        <div class="col-sm-6">
                            <label for="status" class="ce__label">Status</label>
                            <select class="form-control" name="cbxStatus" id="status" onchange="">
                               <?php 
                                        $customerStatus[]="Active";
                                        $customerStatus[]="Archived";
                                        $customerStatus[]="Deleted";
                                    
                                        foreach($customerStatus as $value){
                                            if($value == $detailsCustomer->getCustomerStatus()) {
                                                ?>
                                                    <option selected="selected" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                <?php
                                            }
                                        }
                               ?>
                            </select>
                            <span class="ce__feedback" id="feedbackCustomerStatus"></span>
                    </div>
                </form>
            </div>
        </div> 
    </body>
</html>
<?php
        // Ending the customer foreach loop
        }
    //If no customer is set
    }
    //else header('Location: cust_listed');
?>