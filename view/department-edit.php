<?php  
    if (isset($_GET['department'])) {
        require '../functions/datalayer/database.class.php';
        // Adding the department controller
        require '../functions/controller/DepartmentController.php';

        // Adding the department modal
        require '../functions/models/entDepartment.php';

        // Getting the connection with the department class
        $DepartmentCtrl = new DepartmentController();

        // Getting the department
        $departmentID = $_GET['department'];

        // Creating a customer id to fil it later
        $customerID;

        // If there is a customer id, it will be of the customer, else it will be 0
        // This is to later check wich functions shouldn't be activeted
        if(isset($_GET['customer'])) {
            $customerID = $_GET['customer'];
        }else {
            $customerID = 0;
        }

        // Updating the customer
        if(isset($_POST['btnUpdate'])){
            // getting the new values
            // $custID = $_GET["customer"];
            // $custName = $_POST['txtCustomerName'];
            // $custRefrence = $_POST['txtcustomerRefrence'];
            // $custComment = $_POST['txtCustomerComment'];
            // $custStatus = $_POST['cbxStatus'];

            // Storring all variables in the customer object
            //$CustomerModal = new EntCustomer($custID, $custName, $custRefrence, $custComment, $custStatus);

            // echo "ID = " . $custID . "<br>";
            // echo "Name = " . $custName . "<br>";
            // echo "Refrence = " . $custRefrence . "<br>";
            // echo "Comment = " . $custComment . "<br>";
            // echo "Status = " . $custStatus . "<br>";

            //$CustomerDB->updateCustomer($custID, $custName, $custRefrence, $custComment, $custStatus);
        }

        // Getting the department details 
        $detailsDepartment = $DepartmentCtrl->getDetailsDepartment($departmentID); 

        // Loop through result
        foreach($detailsCustomer as $department){
            // Including the menu and head
            require "menu.php";
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <h1 class="ce__title">Edit Department<h1>
                    </div>
                </div>

                <form method="POST" action="department-edit?department=<?php echo $departmentID; ?>">
                    <!-- Customer ID for refrence -->
                    <input type="hidden" name="txtCustomerID" value="<?php echo $department->getCustomerID(); ?>">

                    <div class="row justify-content-md-center ce--form-row">
                        <div class="col-sm-6">
                            <label for="customerName" class="ce__label">Name</label>
                            <input type="text" name="txtCustomerName" id="customerName" value="<?php echo $customer->getCustomerName(); ?>" class="form-control ce--input" required />
                            <span class="ce__feedback" id="feedbackCustomerName"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="customerRefrence" class="ce__label">Refrence</label>
                            <input type="text" name="txtcustomerRefrence" id="customerRefrence" value="<?php echo $customer->getCustomerReference(); ?>" class="form-control ce--input" required onchange=""/>
                            <span class="ce__feedback" id="feedbackCustomerRefrence"></span>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-sm-6">
                            <label for="customerComment" class="ce__label">Comment</label>
                            <textarea name="txtCustomerComment" id="customerComment" class="form-control ce--input" rows="5" onchange=""><?php echo $customer->getCustomerComment(); ?></textarea>
                            <span class="ce__feedback" id="feedbackCustomerComment"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="status" class="ce__label">Status</label>
                            <select class="form-control" name="cbxStatus" id="status">
                               <?php 
                                    $customerStatus[]="Active";
                                    $customerStatus[]="Archived";
                                    $customerStatus[]="Deleted";
                                
                                    foreach($customerStatus as $value){
                                        if($value == $customer->getCustomerStatus()) {
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
                    </div>

                    <div class="row ce--margin">
                        <div class="col-sm-12">
                            <input type="submit" name="btnUpdate" class="btn ce__update-button" value="Update customer">
                        </div>
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
    } else {
        header('Location: department-list');
    }
?>
