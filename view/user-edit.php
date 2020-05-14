<?php 
    if (isset($_GET['user'])) {
        $userID = $_GET['user'];

        // Inlcude Database class
        require '../functions/datalayer/database.class.php';
        require '../functions/datalayer/ScanDB.php';
        require '../functions/datalayer/UserDB.php';
        // Including controller
        require '../functions/controller/CustomerController.php';
        require '../functions/controller/UserController.php';
        require '../functions/controller/DepartmentController.php';
        require '../functions/controller/ScanController.php';
        // Including entity classes
        require '../functions/models/entCustomer.php';
        require '../functions/models/entContact.php';
        require '../functions/models/entDepartment.php'; 
        require '../functions/models/entScan.php'; 


        // Including the head and menu
        require 'menu.php';

        // Creating connections with the classes
        $CustomerCtrl = new CustomerController();
        $UserCtrl = new UserController();
        $DepartmentCtrl =new DepartmentController();
        $scanCtrl = new ScanController();

        // Connect DB to a variable
        $UserDB = new UserDB();

        // Creating a customer id to fil it later
        $customerID;

        // If there is a customer id, it will be of the customer, else it will be 0
        // This is to later check wich functions shouldn't be activeted
        if(isset($_GET['customer'])) {
            $customerID = $_GET['customer'];
        }else {
            $customerID = 0;
        }

        // Creating a status variable to fill it later
        $scanStatus;
        $departmentStatus;

        // Checking for a status and filling scanStatus with that status
        if (isset($_GET['scan-status'])) {
            $scanStatus = $_GET['scan-status'];
        } else {
            $scanStatus = "none";
        }

        // Checking for a status and filling departmentStatus with that status

        if (isset($_GET['department-status'])) {
            $departmentStatus = $_GET['department-status'];
        } else {
            $departmentStatus = "none";
        }

        // Creating an array to check to statusses on the overview
        $overviewStatus[]="Active";
        $overviewStatus[]="Archived";
        $overviewStatus[]="Deleted";

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
 
            // echo "User ID = " . $userID . "<br>";
            // echo "Contact ID = " . $contactID . "<br>";
            // echo "Name = " . $userName . "<br>";
            // echo "Phone = " . $contactPhone . "<br>";
            // echo "Email = " . $userEmail . "<br>";
            // echo "Status = " . $userStatus . "<br>";
            // echo "Customer = " . $contactCustomer . "<br>";
            // echo "Comment = " . $contactComment . "<br>";
 
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
                            <select class="form-control" name="cbxCustomer" id="customerSelect" onchange="updateScanStatus()">
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

                    <!-- <section class="ue-department">
                        <div class="row ce--form-row">
                            <div class="col-sm-12">
                                <h4 class="ce-overview__title">Departments</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="ce__label"><strong>Active</strong></label>
                                    </div>
                                </div> -->

                                <!-- <div class="row">
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
                        </div> -->

    <section class="ce-overview">
        <div class="ce-overview__table">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="ce-overview__title">Overview Scans<h2>
                </div>
            </div>

                <div class="row">
                    <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="customer__select">
                                    <select id="scanStatus" name="cbxScanStatus" class="form-control" onchange="updateTableStatus('Scans', 'scanStatus')">
                                                    <?php 
                                                        // Checking if a status has been set
                                                        if ($scanStatus != "none") {                                                        
                                                            // Looping through the statusses and checking wich one is equeal
                                                            foreach($overviewStatus as $value){
                                                                if($value == $scanStatus) {
                                                                    ?>
                                                                        <option selected="selected" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        } else {
                                                            // No status set
                                                            ?>
                                                                <option selected="selected" value="Active">Active</option>
                                                                <option value="Archived">Archived</option>
                                                                <option value="Deleted">Deleted</option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="search__icon"><i class='fas search--icon'>&#xf002;</i></div>
                                    <input class="form-control input__filter" id="Filter" type="text" placeholder="Search...">
                                </div>

                                <div class="col-sm-2">
                                    <div class="add-container">
                                        <?php
                                            // Checking for customer id to know where to add the new user to
                                            if ($customerID != 0) {
                                                ?>
                                                    <a href="user-add?customer=<?php echo $customerID; ?>" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add scan</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="user-add" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add scan</a>
                                                <?php
                                            }       
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <table class="tab-table table table-hover" id="filterTable">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <th class="tab-table__head" onclick="sortTable(0)">Name</th>
                                    <th class="tab-table__head" onclick="sortTable(1)">Start date</th>
                                    <th class="tab-table__head" onclick="sortTable(2)">End date</th>
                                    <?php 
                                        // Checking if there is a customer set
                                        if($customerID == 0) {
                                            ?>
                                                <th class="tab-table__head" onclick="sortTable(3)">Customer</td>
                                            <?php
                                        }
                                    ?>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listScans;
                                    
                                    switch ($scanStatus) {
                                        case 'Archived':
                                            $listScans = $scanCtrl->getScansUser($userID, 'Archived');
                                            break;
                                        case 'Deleted':
                                            $listScans = $scanCtrl->getScansUser($userID, 'Deleted');
                                            break;
                                        default:
                                            $listScans = $scanCtrl->getScansUser($userID, 'Active');
                                            break;
                                    }


                                    // Looping through the results
                                    foreach ($listScans as $scan) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td"><?php echo $scan->getScanName(); ?></td>
                                        <td class="tab-table__td"><?php echo $scan->getScanStartDate(); ?></td>
                                        <td class="tab-table__td"><?php echo $scan->getScanEndDate(); ?></td>
                                        <?php 
                                            // Checking if there is a customer set
                                            if($customerID == 0) {
                                                ?>
                                                    <td class="tab-table__td"><?php echo $scan->getScanCustomerName(); ?></td>
                                                <?php
                                            }
                                        ?>
                                        <td class="tab-table__td">
                                            <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>
                                            <?php
                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($scanStatus) {
                                                    case 'Archived':
                                                        ?>
                                                        <a class="deleteKnop" href="#" data-toggle="modal" data-target="#disconnectScanModal" id='<?php echo $scan->getScanID();?>' onClick="reply_click(this.id)"><i class="fas fa-minus-circle"></i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                        <a class="deleteKnop" href="#" data-toggle="modal" data-target="#disconnectScanModal" id='<?php echo $scan->getScanID();?>' onClick="reply_click(this.id)"><i class="fas fa-minus-circle"></i></a>
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#disconnectScanModal" id='<?php echo $scan->getScanID();?>' onClick="reply_click(this.id)"><i class="fas fa-minus-circle"></i></a>
                                                        <?php
                                                        break;
                                                }
                                                ?>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>     
                    </div>
                </div>
                



<div class="ce-overview__table">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="ce-overview__title">Overview Departments<h2>
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="customer__select">
                                    <select id="departmentStatus" name="cbxDepartmentStatus" class="form-control" onchange="updateTableStatus('Departments', 'departmentStatus')">
                                                    <?php 
                                                        // Checking if a status has been set
                                                        if ($departmentStatus != "none") {                                                        
                                                            // Looping through the statusses and checking wich one is equeal
                                                            foreach($overviewStatus as $value){
                                                                if($value == $departmentStatus) {
                                                                    ?>
                                                                        <option selected="selected" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        } else {
                                                            // No status set
                                                            ?>
                                                                <option selected="selected" value="Active">Active</option>
                                                                <option value="Archived">Archived</option>
                                                                <option value="Deleted">Deleted</option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="search__icon"><i class='fas search--icon'>&#xf002;</i></div>
                                    <input class="form-control input__filter" id="Filter" type="text" placeholder="Search...">
                                </div>

                                <div class="col-sm-2">
                                    <div class="add-container">
                                        <?php
                                            // Checking for customer id to know where to add the new user to
                                            if ($customerID != 0) {
                                                ?>
                                                    <a href="user-add?customer=<?php echo $customerID; ?>" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add scan</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="user-add" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add scan</a>
                                                <?php
                                            }       
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!----- Table Departments User ------>

                            <table class="tab-table table table-hover" id="filterTable">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <th class="tab-table__head" onclick="sortTable(0)">Name</th>
                                    <th class="tab-table__head" onclick="sortTable(1)">Comment</th>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listDepartments;
                                    
                                    switch ($departmentStatus) {
                                        case 'Archived':
                                            $listDepartments = $UserCtrl->getDepartmentsUser($userID, 'Archived');
                                            break;
                                        case 'Deleted':
                                            $listDepartments = $UserCtrl->getDepartmentsUser($userID, 'Deleted');
                                            break;
                                        default:
                                            $listDepartments = $UserCtrl->getDepartmentsUser($userID, 'Active');
                                            break;
                                    }


                                    // Looping through the results
                                    foreach ($listDepartments as $department) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td"><?php echo $department->getUserDepartmentName(); ?></td>
                                        <td class="tab-table__td"><?php echo $department->getuserDepartmentComment(); ?></td>

                                        <td class="tab-table__td">
                                            <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>
                                            <?php
                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($departmentStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#deleteModal" id='<?php echo $scan->getScanID();?>' onClick="reply_click(this.id)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                            
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#archiveModal" id='<?php echo $scan->getScanID();?>' onClick="reply_click(this.id)"><i class="fas fa-minus-circle"></i></a>
                                                        <?php
                                                        break;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>

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

    <!--DisconnectScan Modal--->
    <div class="modal fade" id="disconnectScanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disconnectScanModal">Disconnect Scan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to disconnect this scan?
            </div>

            <form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                <button type="submit" name="btnDisconnectModal" class="btn btn-primary" id="btnDisconnectModal">Disconnect   </button>          

                <script type="text/javascript">
                function reply_click(clicked_id)
                {
                    window.yourGlobalVariable = clicked_id;
                }

                var userID = <? echo $userID; ?>;
                console.log(userID);
                console.log(yourGlobalVariable);


                $('#btnDisconnectModal').click(function () {


                // $.ajax({
                //     url: 'scan_disconnect_handler',
                //     type: 'post',
                //     data: { "scanID": yourGlobalVariable, "userID": userID},
                //     success: ""
                // });

                });

                </script>
               
            </div>
            </form>

            </div>
        </div>
        </div>

    <script>
        // Filteren op de table
        $(document).ready(function() {
            $("#Filter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTable .filter__row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>

</html>

<?php
        // Ending the for loop
        }
    // No user setted
    } else {
        header('Location: user-list-test');
    }


    // Looping through the results
    if (!empty($customerDetails)) {
        foreach ($customerDetails as $customer) {
            echo "<script> 
                document.getElementById('pageTitle').innerHTML = 'Overview scans of ". $customer->getCustomerName() ."'; 
            </script>";
        }
    }
?>



