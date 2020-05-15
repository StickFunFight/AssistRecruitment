<?php  
    if (isset($_GET['customer'])) {
        // Adding the customer controller
        require '../functions/controller/CustomerController.php';
        // Adding the scanDB controller
        require '../functions/controller/ScanController.php';
        // Adding the department controller
        require '../functions/controller/DepartmentController.php';
        // Adding the Contact controller
        require '../functions/controller/UserController.php';


        // Adding the customer modal
        require '../functions/models/entCustomer.php';
        // Adding the scan modal
        require '../functions/models/entScan.php';
        // Adding the department modal
        require '../functions/models/entDepartment.php';
        // Adding the department modal
        require '../functions/models/entContact.php';
        // Adding the questionair modal
        require '../functions/models/entQuestionair.php';

    
        // Getting the connection with the customer class
        $customerCtrl = new CustomerController(); 
        // Getting the connection with the scan class
        $scanCtrl = new ScanController();
        // Getting the connection with the department class
        $departmentCtrl = new DepartmentController();
        // Getting the connection with the department class
        $userCtrl = new UserController();

        
        // Getting the customer
        $customerID = $_GET['customer'];

        // Updating the customer
        if (isset($_POST['btnUpdate']) || isset($_POST['btnUpdateAndExit'])){
            // getting the new values
            $custID = $_GET["customer"];
            $custName = $_POST['txtCustomerName'];
            $custRefrence = $_POST['txtcustomerRefrence'];
            $custComment = $_POST['txtCustomerComment'];
            $custStatus = $_POST['cbxStatus'];

            // Storring all variables in the customer object
            //$CustomerModal = new EntCustomer($custID, $custName, $custRefrence, $custComment, $custStatus);

            // Checking if user wants to exit page
            $exitWindow = 0;

            if (isset($_POST['btnUpdateAndExit'])) {
                // User wants to leave
                $exitWindow = 1;
            }

            // echo "ID = " . $custID . "<br>";
            // echo "Name = " . $custName . "<br>";
            // echo "Refrence = " . $custRefrence . "<br>";
            // echo "Comment = " . $custComment . "<br>";
            // echo "Status = " . $custStatus . "<br>";

            $customerCtrl->updateCustomer($custID, $custName, $custRefrence, $custComment, $custStatus, $exitWindow);
        }

        // Adding an user through the modal
        if (isset($_POST['btnAddUser'])) {
            // Getting the values
            $contactName = $_POST['txtAddUserName'];
            $userEmail = $_POST['txtAddUserEmail'];
            $userType = $_POST['txtAddUserType'];
            $contactPhone = $_POST['txtAdPhoneNumber'];
            $contactBirthDay = $_POST['txtAddBirth'];
            $contactComment = $_POST['txtAddUserComment'];
            $contactCustomer = null;

            // Checking for type
            if ($userType == "Employee") {
                $contactCustomer = $customerID;
            }

            // echo "Naam " . $contactName . "<br>";
            // echo "Email " . $userEmail . "<br>";
            // echo "Type " . $userType . "<br>";
            // echo "Phone " . $contactPhone . "<br>";
            // echo "Birthday " . $contactBirth . "<br>";
            // echo "Customer " . $contactCustomer . "<br>";

            $userCtrl->addUser($contactName, $userEmail, $userType, $contactPhone, $contactBirthDay, $contactComment, $contactCustomer);
        }
        
        // Adding a department through the modal
        if (isset($_POST['btnDepartmentAdd'])) {
            // getting the values of the input fields
            $dpName = $_POST["txtAddDepartmentName"];
            $dpComment = $_POST['txtAddDepartmentComment']; 
            
            $departmentCtrl->createDepartment($dpName, $dpComment, $customerID);
        }

        if (isset($_POST['btnAddScan'])) {
            // getting the new values
            $scanName = $_POST['txtAddScanName'];
            $scanComment = $_POST['txtAddScanComment'];
            $scanIntroductionText = $_POST['txtAddScanIntroduction'];
            $scanReminderText = $_POST['txtAddScanReminder'];
            $scanStartDate = $_POST['txtAddStartDate'];
            $scanEndDate = $_POST['txtAddStartEnd'];

            // Checking if question air is empty
            $scanQuestionair;

            if (!empty($_POST['txtQuestionair'])) {
                $scanQuestionair = $_POST['txtQuestionair'];

                // Getting the id
                $scanQuestionairID = $scanCtrl->getQuestionairID($scanQuestionair);
            }

            // Send to add scan
            $scanCtrl->addScan($scanName, $scanComment, $scanIntroductionText, $scanReminderText, $scanStartDate, $scanEndDate, $scanQuestionairID);
        }

        // Archiving the contact
        if (isset($_POST['btnArchiveContact'])) {
            // Getting the department id and sending to the controller
            $userID = $_POST['txtContactID'];

            $userCtrl->archiveUser($userID);
        }

        // Deleting the contact
        if (isset($_POST['btnDeleteContact'])) {
            // Getting the txtContactID id and sending to the controller
            $userID = $_POST['txtContactID'];

            $userCtrl->deleteUser($userID);
        }

        // Archiving the department
        if (isset($_POST['btnArchiveDepartment'])) {
            // Getting the department id and sending to the controller
            $departmentID = $_POST['txtDepartmentID'];

            $departmentCtrl->archiveDepartment($departmentID);
        }

        // Deleting the department
        if (isset($_POST['btnDeleteDepartment'])) {
            // Getting the department id and sending to the controller
            $departmentID = $_POST['txtDepartmentID'];

            $departmentCtrl->deleteDepartment($departmentID);
        }

        // Archiving the scan
        if (isset($_POST['btnArchiveScan'])) {
            // Getting the department id and sending to the controller
            $scanID = $_POST['txtScanID'];

            $scanCtrl->archiveScan($scanID);
        }

        // Deleting the scan
        if (isset($_POST['btnDeleteScan'])) {
            // Getting the department id and sending to the controller
            $scanID = $_POST['txtScanID'];

            $scanCtrl->deleteScan($scanID);
        }

        // Getting the customer
        $detailsCustomer = $customerCtrl->getCustomerDetails($customerID); 

        // Creating an array to check to statusses on the overview
        $overviewStatus[]="Active";
        $overviewStatus[]="Archived";
        $overviewStatus[]="Deleted";

        // Creating a status for contacts to fill it later
        $userStatus;

        // Checking for a status and filling userStatus with that status
        if (isset($_GET['user-status'])) {
            $userStatus = $_GET['user-status'];
        } else {
            $userStatus = "none";
        }

        // Creating a status for department to fill it later
        $departmentStatus;

        // Checking for a status and filling userStatus with that status
        if (isset($_GET['department-status'])) {
            $departmentStatus = $_GET['department-status'];
        } else {
            $departmentStatus = "none";
        }

        // Creating a status for scans to fill it later
        $scanStatus;

        // Checking for a status and filling userStatus with that status
        if (isset($_GET['scan-status'])) {
            $scanStatus = $_GET['scan-status'];
        } else {
            $scanStatus = "none";
        }

        // Loop through result
        foreach($detailsCustomer as $customer){
            // Including the menu and head
            require "menu.php";
?>
<html>
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <link rel="stylesheet" href="../assests/styling/customer.css">

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-sm-12">
                        <h1 class="ce__title">Edit customer<h1>
                    </div>
                </div>

                <form method="POST" action="customer-edit?customer=<?php echo $customerID; ?>">
                    <!-- Customer ID for refrence -->
                    <input type="hidden" name="txtCustomerID" value="<?php echo $customer->getCustomerID(); ?>">

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
                                    foreach($overviewStatus as $value){
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
                            <input type="submit" name="btnUpdateAndExit" class="btn ce__update-button" value="Update customer and exit">
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
                                            <span class="feedback--good">The customer has been updated. </span>
                                        <?php
                                        break;
                                    
                                    default:
                                        ?>
                                            <span class="feedback--bad">The customer could not be updated, try again. </span>
                                        <?php
                                        break;
                                }
                            }
                        ?>
                    </div>
                </form>

                <section class="ce-overview">
                    <div class="ce-overview__table">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="ce-overview__title">Overview Contacts<h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="customer__select">
                                                <select id="userStatus" name="cbxDepartmentStatus" class="form-control" onchange="updateTableStatus('Users', 'userStatus')">
                                                    <?php 
                                                        // Checking if a status has been set
                                                        if ($userStatus != "none") {                                                        
                                                            // Looping through the statusses and checking wich one is equeal
                                                            foreach($overviewStatus as $value){
                                                                if($value == $userStatus) {
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
                                            <input class="form-control input__filter" id="FilterUsers" type="text" placeholder="Search...">
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="add-container">
                                                <a href="#" class="btn add-container__btn" data-toggle="modal" data-target="#addUserModal"><i class='fas add-container--icon'>&#xf055;</i> Add user</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="tab-table table table-hover" id="filterTableUsers">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <!-- Voor de onlcick gebruik maken van int zodat JavaScript de column kan vinden -->
                                    <th class="tab-table__head">Name <div class="table__icon-top" onclick="sortTable('filterTableUsers', 0, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableUsers', 0, 'desc')"></div></th>
                                    <th class="tab-table__head">Phone number <div class="table__icon-top" onclick="sortTable('filterTableUsers', 1, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableUsers', 1, 'desc')"></div></th>
                                    <th class="tab-table__head">Email <div class="table__icon-top" onclick="sortTable('filterTableUsers', 2, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableUsers', 2, 'desc')"></div></th>
                                    <th class="tab-table__head">Department <div class="table__icon-top" onclick="sortTable('filterTableUsers', 3, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableUsers', 3, 'desc')"></div></th>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listUsers;

                                    // Checking for the status
                                    switch ($userStatus) {
                                        case 'Archived':
                                            $listUsers = $userCtrl->getUsersCustomer($customerID, 'Archived');
                                            break;
                                        case 'Deleted':
                                            $listUsers = $userCtrl->getUsersCustomer($customerID, 'Deleted');
                                            break;
                                        default:
                                            $listUsers = $userCtrl->getUsersCustomer($customerID, 'Active');
                                            break;
                                    }

                                    // Looping through the results
                                    foreach ($listUsers as $user) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td" onclick="toDetails('Users', <?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getContactName(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Users', <?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserPhoneNumber(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Users', <?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserEmail(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Users', <?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserDepartmentName(); ?></td>
                                        <?php 
                                            // Checking if there is a customer set
                                            if($customerID == 0) {
                                                ?>
                                                    <td class="tab-table__td" onclick="toDetails(<?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserCustomerName(); ?></td>
                                                <?php
                                            }
                                        ?>
                                        <td class="tab-table__td">
                                            <a class="editKnop" href="user-edit?user=<?php echo $user->getUserID(); ?>"><i class="fas tab-table__icon">&#xf044;</i></a>
                                            <?php
                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($userStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#deleteContact" id='<?php echo $user->getUserID(); ?>' onclick="setContactIDModalCustomerEdit(<?php echo $user->getUserID(); ?>)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                        
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#archiveContact" id='<?php echo $user->getUserID(); ?>' onclick="setContactIDModalCustomerEdit(<?php echo $user->getUserID(); ?>)"><i class="fas tab-table__icon">&#xf187;</i></a>
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

                    <div class="ce-overview__table">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="ce-overview__title">Overview Departments<h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <form method="POST">
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
                                            <input class="form-control input__filter" id="FilterDepartments" type="text" placeholder="Search...">
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="add-container">  
                                                <a href="#" class="btn add-container__btn" data-toggle="modal" data-target="#addDepartmentModal"><i class='fas add-container--icon'>&#xf055;</i> Add department</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="tab-table table table-hover" id="filterTableDepartments">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <th class="tab-table__head">Name <div class="table__icon-top" onclick="sortTable('filterTableDepartments', 0, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableDepartments', 0, 'desc')"></div></th>
                                    <th class="tab-table__head">Comment <div class="table__icon-top" onclick="sortTable('filterTableDepartments', 1, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableDepartments', 1, 'desc')"></div></th>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listDepartments;

                                    // Checking for the status
                                    switch ($departmentStatus) {
                                        case 'Archived':
                                            $listDepartments = $departmentCtrl->getDepartmentsCustomer($customerID, 'Archived');
                                            break;
                                        case 'Deleted':
                                            $listDepartments = $departmentCtrl->getDepartmentsCustomer($customerID, 'Deleted');
                                            break;
                                        default:
                                            $listDepartments = $departmentCtrl->getDepartmentsCustomer($customerID, 'Active');
                                            break;
                                    }

                                    // Looping through the results
                                    foreach ($listDepartments as $department) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td" onclick="toDetails('Departments', <?php echo $customerID; ?>, <?php echo $department->getDepartmentID(); ?>)"><?php echo $department->getDepartmentName(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Departments', <?php echo $customerID; ?>, <?php echo $department->getDepartmentID(); ?>)"><?php echo $department->getDepartmentComment(); ?></td>
                                        <td class="tab-table__td">
                                            <?php
                                                // Checking if there is a customer set
                                                if($customerID == 0) {
                                                    ?>
                                                        <a class="editKnop" href="department-edit?department=<?php echo $department->getDepartmentID(); ?>"><i class="fas tab-table__icon">&#xf044;</i></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                      <a class="editKnop" href="department-edit?department=<?php echo $department->getDepartmentID(); ?>&customer=<?php echo $customerID; ?>"><i class="fas tab-table__icon">&#xf044;</i></a>
                                                    <?php
                                                }

                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($departmentStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#deleteDepartment" id='<?php echo $department->getDepartmentID();?>' onclick="setDepartmentIDModalCustomerEdit(<?php echo $department->getDepartmentID();?>)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                            
                                                        <?php
                                                        break; 
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#archiveDepartment" id='<?php echo $department->getDepartmentID();?>' onclick="setDepartmentIDModalCustomerEdit(<?php echo $department->getDepartmentID();?>)"><i class="fas tab-table__icon">&#xf187;</i></a>
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

                    <div class="ce-overview__table">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="ce-overview__title">Overview Scans<h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="customer__select">
                                                <select id="scanStatus" name="cbxDepartmentStatus" class="form-control" onchange="updateTableStatus('Scans', 'scanStatus')">
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
                                            <input class="form-control input__filter" id="FilterScans" type="text" placeholder="Search...">
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="add-container">  
                                            <a href="#" class="btn add-container__btn" data-toggle="modal" data-target="#addScanModal"><i class='fas add-container--icon'>&#xf055;</i> Add scan</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="tab-table table table-hover" id="filterTableScans">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <th class="tab-table__head">Name <div class="table__icon-top" onclick="sortTable('filterTableScans', 0, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableScans', 0, 'desc')"></div></th>
                                    <th class="tab-table__head">Start date <div class="table__icon-top" onclick="sortTable('filterTableScans', 1, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableScans', 1, 'desc')"></div></th>
                                    <th class="tab-table__head">End date <div class="table__icon-top" onclick="sortTable('filterTableScans', 2, 'asc')"></div> <div class="table__icon-bottom" onclick="sortTable('filterTableScans', 2, 'desc')"></div></th>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listScans;

                                    // Checking for the status
                                    switch ($scanStatus) {
                                        case 'Archived':
                                            $listScans = $scanCtrl->getScansCustomer($customerID, 'Archived');
                                            break;
                                        case 'Deleted':
                                            $listScans = $scanCtrl->getScansCustomer($customerID, 'Deleted');
                                            break;
                                        default:
                                            $listScans = $scanCtrl->getScansCustomer($customerID, 'Active');
                                            break;
                                    }

                                    // Looping through the results
                                    foreach ($listScans as $scan) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td" onclick="toDetails('Departments', <?php echo $customerID; ?>, <?php echo $scan->getScanID(); ?>)"><?php echo $scan->getScanName(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Departments', <?php echo $customerID; ?>, <?php echo $scan->getScanID(); ?> )"><?php echo $scan->getScanStartDate(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails('Departments', <?php echo $customerID; ?>, <?php echo $scan->getScanID(); ?> )"><?php echo $scan->getScanEndDate(); ?></td>
                                        <td class="tab-table__td">
                                            <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>
                                            <?php
                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($scanStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#deleteScan" id='<?php echo $scan->getScanID();?>' onclick="setScanIDModalCustomerEdit(<?php echo $scan->getScanID();?>)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                       
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#archiveScan" id='<?php echo $scan->getScanID();?>' onclick="setScanIDModalCustomerEdit(<?php echo $scan->getScanID();?>)"><i class="fas tab-table__icon">&#xf187;</i></a>
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
                </section>              
            </div>
        </div> 

        <!--User add modal --->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="add-user" aria-labelledby="add-user" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Add user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST">
                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Name</label>
                                    <input type="text" name="txtAddUserName" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Email</label>
                                    <input type="email" name="txtAddUserEmail" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Type</label>
                                    <select name="txtAddUserType" class="form-control ce--input" required>
                                        <option value="Employee" selected="selected">Employee</option>
                                        <option value="Candidate">Candidate</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Phonenumber</label>
                                    <input type="phone" name="txtAdPhoneNumber" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Date of birth</label>
                                    <input type="date" name="txtAddBirth" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Comment</label>
                                    <textarea name="txtAddUserComment" class="form-control ce--input" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="btnAddScan" class="btn btn-primary">Save user</button>          
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Department add modal --->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="add-department" aria-labelledby="add-department" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Add department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST">
                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Name</label>
                                    <input type="text" name="txtAddDepartmentName" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Comment</label>
                                    <textarea name="txtAddDepartmentComment" class="form-control ce--input" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="btnDepartmentAdd" class="btn btn-primary">Save department</button>          
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scan add modal --->
        <div class="modal fade" id="addScanModal" tabindex="-1" role="add-scan" aria-labelledby="add-scan" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Add Scan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="POST">
                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Name</label>
                                    <input type="text" name="txtAddScanName" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Introduction text</label>
                                    <textarea name="txtAddScanIntroduction" class="form-control ce--input" rows="5" required></textarea>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Reminder text</label>
                                    <textarea name="txtAddScanReminder" class="form-control ce--input" rows="5" required></textarea>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Start date</label>
                                    <input type="date" name="txtAddStartDate" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">End date</label>
                                    <input type="date" name="txtAddStartEnd" class="form-control ce--input" required/>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Comment</label>
                                    <textarea name="txtAddScanComment" class="form-control ce--input" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <label class="">Template name *</label>
                                    <input type="text" class="form-control ce--input" name="txtQuestionair" id="searchTemplate" placeholder="type a template name">
                                </div>
                            </div>

                            <div class="row ce--form-row">
                                <div class="col-sm-12">
                                    <span class="ce--feedback">* = Not necessary</span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="btnAddScan" class="btn btn-primary">Save Scan</button>          
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Archive Modal -->
        <div class="modal fade" id="archiveContact" tabindex="-1" role="dialog" aria-labelledby="archiveContact" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Archive contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to archive this contact?
                    </div>

                    <form method="post">
                        <div class="modal-footer">
                            <input type="hidden" name="txtContactID" id="ContactIDArchive">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnArchiveContact" class="btn btn-primary" id="btnArchive">Archive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        <!-- Contact Delete Modal -->
        <div class="modal fade" id="deleteContact" tabindex="-1" role="dialog" aria-labelledby="deleteContact" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Delete contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this contact?
                    </div>
                    
                    <form method="POST">
                        <div class="modal-footer">
                            <input type="hidden" name="txtContactID" id="ContactIDDelete">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnDeleteContact" class="btn btn-primary modal--button" id="btnDelete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Department Archive Modal -->
        <div class="modal fade" id="archiveDepartment" tabindex="-1" role="dialog" aria-labelledby="archiveDepartment" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Archive department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to archive this department?
                    </div>

                    <form method="post">
                        <div class="modal-footer">
                            <input type="hidden" name="txtDepartmentID" id="departmentIDArchive">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnArchiveDepartment" class="btn btn-primary" id="btnArchive">Archive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        <!-- Department Delete Modal -->
        <div class="modal fade" id="deleteDepartment" tabindex="-1" role="dialog" aria-labelledby="deleteDepartment" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Delete department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this department?
                    </div>
                    
                    <form method="POST">
                        <div class="modal-footer">
                            <input type="hidden" name="txtDepartmentID" id="departmentIDDelete">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnDeleteDepartment" class="btn btn-primary modal--button" id="btnDelete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scan Archive Modal -->
        <div class="modal fade" id="archiveScan" tabindex="-1" role="dialog" aria-labelledby="archiveScan" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Archive scan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to archive this scan?
                    </div>

                    <form method="post">
                        <div class="modal-footer">
                            <input type="hidden" name="txtScanID" id="ScanIDArchive">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnArchiveScan" class="btn btn-primary" id="btnArchive">Archive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        <!-- Scan Delete Modal -->
        <div class="modal fade" id="deleteScan" tabindex="-1" role="dialog" aria-labelledby="deleteScan" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Delete scan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this scan?
                    </div>
                    
                    <form method="POST">
                        <div class="modal-footer">
                            <input type="hidden" name="txtScanID" id="ScanIDDelete">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="submit" name="btnDeleteScan" class="btn btn-primary modal--button" id="btnDelete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <?php
        // Getting all question air templates to use for the autofill array in de script tag
        $listQuestionair = $scanCtrl->getScanQuestionAir();

        // Creating the array
        $questionairNameArray;

        foreach ($listQuestionair as $questionair) {
            $questionairNameArray[] = $questionair->getQuestionairName();
        }
    ?>

    <script>
        // Filter on the user table
        $(document).ready(function() {
            $("#FilterUsers").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTableUsers .filter__row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        // Filter on the user table
        $(document).ready(function() {
            $("#FilterDepartments").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTableDepartments .filter__row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        // Filter on the user table
        $(document).ready(function() {
            $("#FilterScans").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTableScans .filter__row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        /* An array containing all template names: */
        var templateNames = <?php echo json_encode($questionairNameArray); ?>;

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("searchTemplate"), templateNames);
    </script>
</html>
<?php
        // Ending the customer foreach loop
        }
    //If no customer is set
    } else {
        header('Location: customer_list');
    }
?>
