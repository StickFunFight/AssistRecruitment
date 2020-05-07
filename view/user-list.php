<?php
    // Inlcude Database class
    require '../functions/datalayer/database.class.php';
    // Including controller
    require '../functions/controller/contactController.php';
    require '../functions/controller/CustomerController.php';
    // Including entity classes
    require '../functions/models/entContact.php';
    require '../functions/models/entCustomer.php';

    // Creating connections with the classes
    $CustomerCtrl = new CustomerController();
    $ContactCtrl = new ContactController();

    // Creating a customer id to fil it later
    $customerID;

    // If there is a customer id, it will be of the customer, else it will be 0
    // This is to later check wich functions shouldn't be activeted
    if(isset($_GET['customer'])) {
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

    // Creating a status variable to fill it later
    $userStatus;

    // Checking for a status and filling userStatus with that status
    if (isset($_GET['status'])) {
        $userStatus = $_GET['status'];
    } else {
        $userStatus = "none";
    }
?>

<html>
    <head>
        <?php
            //Include Menu
            require('menu.php');
        ?>
        <!-- Linking to own styleheet -->
        <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    </head>

    <body>
        <div class="page__container"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="ce__title" id="pageTitle">Overview Users<h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="customer__select">
                                        <select id="userStatus" name="cbxUserStatus" class="form-control" onchange="updateTableStatus(<?php echo  $customerID; ?>)">
                                            <?php 
                                                // Checking if a status has been set
                                                if ($userStatus != "none") {
                                                    $customerStatus[]="Active";
                                                    $customerStatus[]="Archived";
                                                    $customerStatus[]="Deleted";
                                                
                                                    // Looping through the statusses and checking wich one is equeal
                                                    foreach($customerStatus as $value){
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
                                    <input class="form-control input__filter" id="Filter" type="text" placeholder="Search...">
                                </div>

                                <div class="col-sm-2">
                                    <div class="add-container">
                                        <?php
                                            // Checking for customer id to know where to add the new user to
                                            if ($customerID != 0) {
                                                ?>
                                                    <a href="user-add?customer=<?php echo $customerID; ?>" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add user</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="user-add" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add user</a>
                                                <?php
                                            }       
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="tab-table table table-hover" id="filterTable">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <!-- Voor de onlcick gebruik maken van int zodat JavaScript de column kan vinden -->
                                    <th class="tab-table__head" onclick="sortTable(0)">Name</th>
                                    <th class="tab-table__head" onclick="sortTable(1)">Phone number</th>
                                    <th class="tab-table__head" onclick="sortTable(2)">Email</th>
                                    <th class="tab-table__head" onclick="sortTable(3)">Department</th>
                                    <?php 
                                        // Checking if there is a customer set
                                        if($customerID == 0) {
                                            ?>
                                                <th class="tab-table__head" onclick="sortTable(4)">Customer</th>
                                            <?php
                                        }
                                    ?>
                                    <th class="tab-table__head">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="tab-table__body">
                                <?php
                                    // Creating a list to fill it later 
                                    $listUsers;
                                    
                                    // Checking if a customer id is set
                                    if ($customerID != 0) {
                                        // Checking for the status
                                        switch ($userStatus) {
                                            case 'Archived':
                                                $listUsers = $ContactCtrl->getContactsCustomer($customerID, 'Archived');
                                                break;
                                            case 'Deleted':
                                                $listUsers = $ContactCtrl->getContactsCustomer($customerID, 'Deleted');
                                                break;
                                            default:
                                                $listUsers = $ContactCtrl->getContactsCustomer($customerID, 'Active');
                                                break;
                                        }
                                    } else {
                                         // Checking for the status
                                         switch ($userStatus) {
                                            case 'Archived':
                                                $listUsers = $ContactCtrl->getContacts('Archived');
                                                break;
                                            case 'Deleted':
                                                $listUsers = $ContactCtrl->getContacts('Deleted');
                                                break;
                                            default:
                                                $listUsers = $ContactCtrl->getContacts('Active');
                                                break;
                                        }
                                    }

                                    // Looping through the results
                                    foreach ($listUsers as $user) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td"><?php echo $user->getContactName(); ?></td>
                                        <td class="tab-table__td"><?php echo $user->getContactPhoneNumber(); ?></td>
                                        <td class="tab-table__td"><?php echo $user->getContactEmail(); ?></td>
                                        <td class="tab-table__td"><?php echo $user->getContactDepartmentName(); ?></td>
                                        <?php 
                                            // Checking if there is a customer set
                                            if($customerID == 0) {
                                                ?>
                                                    <td class="tab-table__td"><?php echo $user->getContactCustomerName(); ?></td>
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
                                                            <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                            <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf187;</i></a>
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
        </div>
    </body>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Archive Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to archive this costumer?
                </div>

                <form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        <button type="submit" name="btnDelete" class="btn btn-primary" id="btnDelete">Archive   </button>          

                        <script type="text/javascript">
                            function reply_click(clicked_id) {
                                window.yourGlobalVariable = clicked_id;
                            }


                            $('#btnDelete').click(function () {
                                $.ajax({
                                    url: 'customer_handler.php',
                                    type: 'post',
                                    data: { "CustomerID": yourGlobalVariable},
                                    success: function(response) { window.location.href='customer_list.php' }
                                });
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

        // Checking the table status
        function updateTableStatus(customerID) { 
            // Ophalen van de status
            var status = document.getElementById("userStatus").value;

            // De pagina refreshen met de nieuwe waarden
            if (customerID == 0) {
                location.replace("?status=" + status);
            } else {
                location.replace("?customer=" + customerID + "&status=" + status);
            }
        }
    </script>
</html>

<?php 
    // Looping through the results
    if (!empty($customerDetails)) {
        foreach ($customerDetails as $customer) {
            echo "<script> 
                document.getElementById('pageTitle').innerHTML = 'Overview users of ". $customer->getCustomerName() ."'; 
            </script>";
        }
    }
?>