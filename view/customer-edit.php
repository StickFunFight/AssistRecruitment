<?php  
    if (isset($_GET['customer'])) {
        require '../functions/datalayer/database.class.php';
        // Adding the customer controller
        require '../functions/controller/CustomerController.php';
        // Adding the scanDB controller
        require '../functions/controller/ScanController.php';
        // Adding the department controller
        require '../functions/controller/DepartmentController.php';
        // Adding the Contact controller
        require '../functions/controller/ContactController.php';


        // Adding the customer modal
        require '../functions/models/entCustomer.php';
        // Adding the scan modal
        require '../functions/models/entScan.php';
        // Adding the department modal
        require '../functions/models/entDepartment.php';
        // Adding the department modal
        require '../functions/models/entContact.php';

    
        // Getting the connection with the customer class
        $CustomerDB = new CustomerController(); 
        // Getting the connection with the scan class
        $ScanDB = new ScanController();
        // Getting the connection with the department class
        $DepartmentDB = new DepartmentController();
        // Getting the connection with the department class
        $ContactDB = new ContactController();

        
        // Getting the customer
        $customerID = $_GET['customer'];

        
        // Updating the customer
        if(isset($_POST['btnUpdate'])){
            // getting the new values
            $custID = $_GET["customer"];
            $custName = $_POST['txtCustomerName'];
            $custRefrence = $_POST['txtcustomerRefrence'];
            $custComment = $_POST['txtCustomerComment'];
            $custStatus = $_POST['cbxStatus'];

            // Storring all variables in the customer object
            //$CustomerModal = new EntCustomer($custID, $custName, $custRefrence, $custComment, $custStatus);

            // echo "ID = " . $custID . "<br>";
            // echo "Name = " . $custName . "<br>";
            // echo "Refrence = " . $custRefrence . "<br>";
            // echo "Comment = " . $custComment . "<br>";
            // echo "Status = " . $custStatus . "<br>";

            $CustomerDB->updateCustomer($custID, $custName, $custRefrence, $custComment, $custStatus);
        }


        // Getting scans by status
        if(isset($_POST['btnChangeStatusScans'])){
            $statusScan = $_POST['cbxStatusScans'];

            $listScans = $ScanDB->getScansCustomer($customerID, $statusScan);
        }else{
            // Status not set
            $statusScan = "Active";
            $listScans = $ScanDB->getScansCustomer($customerID, $statusScan);
        }

        // Getting departments by status
        if(isset($_POST['btnChangeStatusDepartment'])){

            $statusDepartment = $_POST['cbxStatusDepartment'];

            $listDepartments = $DepartmentDB->getDepartmentsCustomer($customerID, $statusDepartment);
        }else{
            // Status not set
            $statusDepartment = "Active";
            $listDepartments = $DepartmentDB->getDepartmentsCustomer($customerID, $statusDepartment);
        }

        // Getting Contacts by status
        if(isset($_POST['btnChangeStatusContacts'])) {
            
            $statusContact = $_POST['cbxStatusContact'];
            
            $listContacts = $ContactDB->getContactsCustomer($customerID, $statusContact);
        } else {
            // Status not set
            $statusContact = "Active";
            $listContacts = $ContactDB->getContactsCustomer($customerID, $statusContact);
        }


        // Getting the customer
        $detailsCustomer = $CustomerDB->getCustomerDetails($customerID);

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
                            <input type="text" name="txtCustomerName" id="customerName" value="<?php echo $customer->getCustomerName() ?>" class="form-control ce--input" required />
                            <span class="ce__feedback" id="feedbackCustomerName"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="customerRefrence" class="ce__label">Refrence</label>
                            <input type="text" name="txtcustomerRefrence" id="customerRefrence" value="<?php echo $customer->getCustomerRefrence(); ?>" class="form-control ce--input" required onchange=""/>
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

                <section class="ce-overview">
                    <h2 class="ce-overview__title">Customer overview</h2>

                    <ul class="nav nav-tabs">
                        <li class="ce-overview__tab" id="scansTab"><a data-toggle="tab" href="#scans" class="ce-overview--link active">Scans</a></li>
                        <li class="ce-overview__tab" id="departmentsTab"><a data-toggle="tab" href="#departments" class="ce-overview--link">Departments</a></li>
                        <li class="ce-overview__tab" id="contactsTab"><a data-toggle="tab" href="#contacts" class="ce-overview--link">Contacts</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="scans" class="tab-pane fade in active show">
                            <div class="tab-content__container">
                                <form method="POST" action="customer-edit?customer=<?php echo $customerID; ?>&tab=scan">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="customer__select">
                                                <select id="customerStatus" name="cbxStatusScans" class="form-control">
                                                    <option selected="selected" value="Active">Active</option>
                                                    <option value="Archived">Archived</option>
                                                    <option value="Deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="submit" class="btn btn-status" name="btnChangeStatusScans" value="Change Status">
                                        </div>
                                    </div>
                                </form>

                                <table class="tab-table table table-hover">
                                    <thead class="tab-table__header">
                                        <tr class="tab-table__row">
                                            <th class="tab-table__head">Name</th>
                                            <th class="tab-table__head">Start date</th>
                                            <th class="tab-table__head">End date</th>
                                            <th class="tab-table__head">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="tab-table__body">
                                        <?php
                                            // Looping through the results
                                            foreach ($listScans as $scan) { 
                                        ?>
                                            <tr class="tab-table__row">
                                                <td class="tab-table__td"><?php echo $scan->getScanName(); ?></td>
                                                <td class="tab-table__td"><?php echo $scan->getScanStartDate(); ?></td>
                                                <td class="tab-table__td"><?php echo $scan->getScanEndDate(); ?></td>
                                                <td class="tab-table__td">
                                                    <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>

                                                    <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="departments" class="tab-pane fade">
                            <div class="tab-content__container">
                                <form method="POST" action="customer-edit?customer=<?php echo $customerID; ?>"> 
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="customer__select">
                                                <select id="customerStatus" name="cbxStatusDepartment" class="form-control">
                                                    <option selected="selected" value="Active">Active</option>
                                                    <option value="Archived">Archived</option>
                                                    <option value="Deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="submit" class="btn btn-status" name="btnChangeStatusDepartment" value="Change Status">
                                        </div>
                                    </div>
                                </form>

                                <table class="tab-table table table-hover">
                                    <thead class="tab-table__header">
                                        <tr class="tab-table__row">
                                            <th class="tab-table__head">Name</th>
                                            <th class="tab-table__head">Comment</th>
                                            <th class="tab-table__head">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="tab-table__body">
                                        <?php
                                            // Looping through the results
                                            foreach ($listDepartments as $department) { 
                                        ?>
                                            <tr class="tab-table__row">
                                                <td class="tab-table__td"><?php echo $department->getDepartmentName(); ?></td>
                                                <td class="tab-table__td"><?php echo $department->getdepartmentComment(); ?></td>
                                                <td class="tab-table__td">
                                                    <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>

                                                    <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="contacts" class="tab-pane fade">
                            <div class="tab-content__container">
                                <form method="POST" action="customer-edit?customer=<?php echo $customerID; ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="customer__select">
                                                <select id="customerStatus" name="cbxStatusContact" class="form-control">
                                                    <option selected="selected" value="Active">Active</option>
                                                    <option value="Archived">Archived</option>
                                                    <option value="Deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="submit" class="btn btn-status" name="btnChangeStatusContacts" value="Change Status">
                                        </div>
                                    </div>
                                </form>

                                <table class="tab-table table table-hover">
                                    <thead class="tab-table__header">
                                        <tr class="tab-table__row">
                                            <th class="tab-table__head">Department</th>
                                            <th class="tab-table__head">Name</th>
                                            <th class="tab-table__head">Phone number</th>
                                            <th class="tab-table__head">Email</th>
                                            <th class="tab-table__head">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="tab-table__body">
                                        <?php
                                            // Looping through the results
                                            foreach ($listContacts as $contact) { 
                                        ?>
                                            <tr class="tab-table__row">
                                                <td class="tab-table__td"><?php echo $contact->getContactDepartmentName(); ?></td>
                                                <td class="tab-table__td"><?php echo $contact->getContactName(); ?></td>
                                                <td class="tab-table__td"><?php echo $contact->getContactPhoneNumber(); ?></td>
                                                <td class="tab-table__td"><?php echo $contact->getContactEmail(); ?></td>
                                                <td class="tab-table__td">
                                                    <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>

                                                    <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
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
                </section>
            </div>
        </div> 
    </body>
</html>
<?php
        // Ending the customer foreach loop
        }
    //If no customer is set
    }
     else header('Location: cust_listed');
?>
