<?php  
    if (isset($_GET['department'])) {
        require '../functions/datalayer/database.class.php';
        // Adding the department controller
        require '../functions/controller/DepartmentController.php';
        require '../functions/controller/CustomerController.php';

        // Adding the department modal
        require '../functions/models/entDepartment.php';
        require '../functions/models/entCustomer.php';

        // Getting the connection with the department class
        $DepartmentCtrl = new DepartmentController();
        $CustomerCtrl = new CustomerController();

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

        // Updating the department
        if(isset($_POST['btnUpdate'])) {

            // getting the new values
            $departmentName = $_POST["txtDepartmentName"];
            $departmentStatus = $_POST['cbxStatus'];
            $departmentCustomer = $_POST['txtCustomerID'];
            $departmentComment = $_POST['txtDepartmentComment'];
 
            // echo "Department ID = " . $departmentID . "<br>";
            // echo "Name = " . $departmentName . "<br>";
            // echo "Status = " . $departmentStatus . "<br>";
            // echo "Customer = " . $departmentCustomer . "<br>";
            // echo "Comment = " . $departmentComment . "<br>";
 
            $DepartmentCtrl->updateDepartment($departmentID, $departmentName, $departmentStatus, $departmentComment, $departmentCustomer);
        }

        // Getting the department details 
        $detailsDepartment = $DepartmentCtrl->getDetailsDepartment($departmentID); 

        // Loop through result
        foreach($detailsDepartment as $department){
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
                    <input type="hidden" name="txtCustomerID" value="<?php echo $department->getDepartmentID(); ?>">

                    <div class="row ce--from-row">
                        <div class="col-sm-6">
                            <label class="ce__label">Department name</label>
                            <input type="text" name="txtDepartmentName" class="form-control ce--input" value="<?php echo $department->getDepartmentName(); ?>" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="ce__label">Customer</label>
                            <select name="cbxCustomer" class="form-control" id="customerSelect" onchange="changeSelectCustomer()">
                                <?php 
                                    // Checking for customer. If there is, lock it in that customer
                                    // Creating an variable to fill it later
                                    $listCustomers;

                                    if (!empty($department->getCustomerID())) {
                                        // Filling the list
                                        $listCustomers =  $CustomerCtrl->getCustomerDetails($department->getCustomerID()); 
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
                            <textarea name="txtDepartmentComment" class="form-control ce--input" rows="5"><?php echo $department->getDepartmentComment(); ?></textarea>
                        </div>

                        <div class="col-sm-6">
                            <label for="status" class="ce__label">Status</label>
                            <select class="form-control" name="cbxStatus" id="status">
                               <?php 
                                    $departmentStatus[]="Active";
                                    $departmentStatus[]="Archived";
                                    $departmentStatus[]="Deleted";
                                
                                    foreach($departmentStatus as $value){
                                        if($value == $department->getDepartmentStatus()) {
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
                            <input type="submit" name="btnUpdate" class="btn ce__update-button" value="Update department">
                        </div>
                    </div>

                    <div class="feedback">
                        <?php
                            // Checking for error message 
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];

                                // Showing the error
                                switch ($error) {
                                    case 'none':
                                        ?>
                                            <span class="feedback--good">The department has been updated. </span>
                                        <?php
                                        break;
                                    
                                    default:
                                        ?>
                                            <span class="feedback--bad">The department could not be updated, try again. </span>
                                        <?php
                                        break;
                                }
                            }
                        ?>
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
