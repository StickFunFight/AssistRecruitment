<?php 
    if (isset($_GET['user'])) {
        $userID = $_GET['user'];

        // Inlcude Database class
        require '../functions/datalayer/database.class.php';
        // Including controller
        require '../functions/controller/CustomerController.php';
        require '../functions/controller/UserController.php';
        require '../functions/controller/DepartmentController.php';
        // Including entity classes
        require '../functions/models/entCustomer.php';
        require '../functions/models/entUser.php';
        require '../functions/models/entDepartment.php';

        // Including the head and menu
        require 'menu.php';

        // Creating connections with the classes
        $CustomerCtrl = new CustomerController();
        $UserCtrl = new UserController();
        $DepartmentCtrl =new DepartmentController();

        // Updateting the user
        if (isset($_POST['btnUpdate'])) {

            // getting the new values
            $contactID = $_POST["txtContactID"];
            $userName = $_POST["txtName"];
            $contactPhone = $_POST['txtPhoneNumber'];
            $userEmail = $_POST['txtEmail'];
            $userStatus = $_POST['cbxStatus'];
            $contactCustomer = $_POST['txtCustomerID'];
            $contactComment = $_POST['txtUserComment'];
 
            echo "User ID = " . $userID . "<br>";
            echo "Contact ID = " . $contactID . "<br>";
            echo "Name = " . $userName . "<br>";
            echo "Phone = " . $contactPhone . "<br>";
            echo "Email = " . $userEmail . "<br>";
            echo "Status = " . $userStatus . "<br>";
            echo "Customer = " . $contactCustomer . "<br>";
            echo "Comment = " . $contactComment . "<br>";
 
            $UserCtrl->updateUser($userID, $contactID, $userName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment);
        }

        // Getting the details of the user
        $detailsUser = $UserCtrl->getDetailsUser($userID);

        // Looping through the results
        foreach ($detailsUser as $user) {
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Edit User</h1>
                    </div>
                </div>

                <form method="POST" autocomplete="off" action="?user=<?php echo $user->getUserID(); ?>">
                    <!-- Customer ID for refrence -->
                    <input type="hidden" name="txtUserID" value="<?php echo $user->getUserID(); ?>">
                    <input type="hidden" name="txtContactID" value="<?php echo $user->getContactID(); ?>">
                    <input type="hidden" name="txtCustomerID" id="custID" value="<?php echo $user->getUserCustomerID(); ?>">

                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label for="name" class="ce__label">Name</label>
                            <input type="text" name="txtName" id="name" value="<?php echo $user->getContactName(); ?>" class="form-control ce--input" required />
                        </div>

                        <div class="col-sm-6">
                            <label for="phoneNumber" class="ce__label">Phone number</label>
                            <input type="tel" name="txtPhoneNumber" id="phoneNumber" value="<?php echo $user->getUserPhoneNumber(); ?>" class="form-control ce--input" required />
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label for="email" class="ce__label">Email</label>
                            <input type="email" name="txtEmail" id="email" value="<?php echo $user->getUserEmail(); ?>" class="form-control ce--input" required />
                        </div>

                        <div class="col-sm-6">
                            <label for="customer" class="ce__label">Status</label>
                            <select class="form-control" name="cbxStatus" id="status">
                               <?php 
                                    $userStatus[]="Active";
                                    $userStatus[]="Archived";
                                    $userStatus[]="Deleted";
                                
                                    foreach($userStatus as $value){
                                        if($value == $user->getUserStatus()) {
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
                        </div>
                    </div>

                    <div class="row ce--form-row">
                        <div class="col-sm-6">
                            <label for="customerSelect" class="ce__label">Customer</label>
                            <select class="form-control" name="cbxCustomer" id="customerSelect" onchange="changeSelectCustomer()">
                                <?php 
                                    // Checking for customer. If there is, lock it in that customer
                                    // Creating an variable to fill it later
                                    $listCustomers;

                                    if (!empty($user->getUserCustomerID())) {
                                        // Filling the list
                                        $listCustomers =  $CustomerCtrl->getCustomerDetails($user->getUserCustomerID()); 
                                        //Showing a select where you can't pick a customer
                                        echo "<script> setCustomerSelectDisabeld(); </script>";
                                    }  else {
                                        $listCustomers = $CustomerCtrl->getCustomers('Active');
                                    }
                                    
                                    foreach($listCustomers as $customer){
                                        if($customer->getCustomerID() == $user->getUserCustomerID()) {
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

                        <div class="col-sm-6">
                            <label for="userComment" class="ce__label">Comment</label>
                            <textarea name="txtUserComment" id="userComment" class="form-control ce--input" rows="5"><?php echo $user->getUserComment(); ?>
                            </textarea>
                        </div>
                    </div>

                    <section class="ue-department">
                        <div class="row ce--form-row">
                            <div class="col-sm-12">
                                <h4 class="ce-overview__title">Departments</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="ce__label"><strong>Active</strong></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php  
                                        // Getting all active departments
                                        $listDepartmentsActive = $DepartmentCtrl->getDepartmentsCustomer($user->getUserCustomerID(), 'Active');

                                        foreach ($listDepartmentsActive as $dpActive) {
                                            ?>
                                                <div class="col-sm-3">
                                                    <?php
                                                        if ($dpActive->getDepartmentID() == $user->getUserDepartmentID()){
                                                            ?>
                                                                <input type="checkbox" id="<?php echo $dpActive->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpActive->getDepartmentID(); ?>" checked>
                                                                <label class="ce__label" for="<?php echo $dpActive->getDepartmentID(); ?>"><?php echo $dpActive->getDepartmentName(); ?></label>
                                                            <?php
                                                        } else{
                                                    ?>
                                                            <input type="checkbox" id="<?php echo $dpActive->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpActive->getDepartmentID(); ?>">
                                                            <label class="ce__label" for="<?php echo $dpActive->getDepartmentID(); ?>"><?php echo $dpActive->getDepartmentName(); ?></label>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="ce__label"><strong>Archived</strong></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php  
                                        // Getting all archived departments
                                        $listDepartmentsArchived = $DepartmentCtrl->getDepartmentsCustomer($user->getUserCustomerID(), 'Archived');

                                        foreach ($listDepartmentsArchived as $dpArchived) {
                                            ?>
                                                <div class="col-sm-3">
                                                    <?php
                                                        if ($dpArchived->getDepartmentID() == $user->getUserDepartmentID()){
                                                            ?>
                                                                <input type="checkbox" id="<?php echo $dpArchived->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpArchived->getDepartmentID(); ?>" checked>
                                                                <label class="ce__label" for="<?php echo $dpArchived->getDepartmentID(); ?>"><?php echo $dpArchived->getDepartmentName(); ?></label>
                                                            <?php
                                                        } else{
                                                    ?>
                                                            <input type="checkbox" id="<?php echo $dpArchived->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpArchived->getDepartmentID(); ?>">
                                                            <label class="ce__label" for="<?php echo $dpArchived->getDepartmentID(); ?>"><?php echo $dpArchived->getDepartmentName(); ?></label>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="ce__label"><strong>Deleted</strong></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php  
                                        // Getting all deleted departments
                                        $listDepartmentsADeleted = $DepartmentCtrl->getDepartmentsCustomer($user->getUserCustomerID(), 'Deleted');

                                        foreach ($listDepartmentsADeleted as $dpADeleted) {
                                            ?>
                                                <div class="col-sm-3">
                                                    <?php
                                                        if ($dpADeleted->getDepartmentID() == $user->getUserDepartmentID()){
                                                            ?>
                                                                <input type="checkbox" id="<?php echo $dpADeleted->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpADeleted->getDepartmentID(); ?>" onchange="toggleContactDepartment(1,1)" checked>
                                                                <label class="ce__label" for="<?php echo $dpADeleted->getDepartmentID(); ?>"><?php echo $dpADeleted->getDepartmentName(); ?></label>
                                                            <?php
                                                        } else{
                                                    ?>
                                                            <input type="checkbox" id="<?php echo $dpADeleted->getDepartmentID(); ?>" name="departmentsActive[]" value="<?php echo $dpADeleted->getDepartmentID(); ?>" onchange="toggleContactDepartment(2,2)">
                                                            <label class="ce__label" for="<?php echo $dpADeleted->getDepartmentID(); ?>"><?php echo $dpADeleted->getDepartmentName(); ?></label>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row ce--margin ce--form-row">
                            <div class="col-sm-12">
                                <input type="submit" name="btnUpdate" class="btn ce__update-button" value="Update user">
                                <div class="feedback">
                                    <?php
                                        // Checking for error message 
                                        if (isset($_GET['error'])) {
                                            $error = $_GET['error'];

                                            // Showing the error
                                            switch ($error) {
                                                case 'none':
                                                    ?>
                                                        <span class="feedback--good">The user has been updated. </span>
                                                    <?php
                                                    break;
                                                
                                                default:
                                                    ?>
                                                        <span class="feedback--bad">The user could not be updated, try again. </span>
                                                    <?php
                                                    break;
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <section class="ce-overview">
                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <h2 class="ce-overview__title">User overview</h2>
                        </div>
                    </div>
                    <div class="row ce--form-row">
                        <div class="col-sm-12">
                            <div class="btn-group" role="group" aria-label="Customer overview links">
                                <a href="user-list?user=<?php echo $userID; ?>" class="ce-overview--link btn">Users</a>
                                <a href="department-list?user=<?php echo $userID; ?>" class="ce-overview--link btn">Departments</a>
                                <a href="scan-list?user=<?php echo $userID; ?>" class="ce-overview--link btn">Scans</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div> 

        <script>
            // Function to add a contact to department
            // function toggleContactDepartment(contactID, departmentID) {
            //     <?php
            //         // $contactID = '<script>contactID</script>';
            //         // $departmentID = '<script>departmentID</script>';

            //         // echo "ContactID = " . $contactID;
            //         // echo "DepartmentID = " . $departmentID;

            //         //$DepartmentCtrl->addContactDepartment($contactID, $departmentID);
            //     ?>
            // }
        </script>
    </body>
</html>

<?php
        // Ending the for loop
        }
    // No user setted
    } else {
        header('Location: user-list-test');
    }
?>
