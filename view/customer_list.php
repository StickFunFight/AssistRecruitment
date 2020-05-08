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
                        <h1 class="ce__title" id="pageTitle">Overview Customers<h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="customer__select">
                                        <select id="customerStatus" name="cbxStatusScans" class="form-control" onchange="updateTableStatus()">
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
                                        <a href="customer-add" class="btn add-container__btn"><i class='fas add-container--icon'>&#xf055;</i> Add customer</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="tab-table table table-hover" id="filterTable">
                            <thead class="tab-table__header">
                                <tr class="tab-table__row">
                                    <!-- Voor de onlcick gebruik maken van int zodat JavaScript de column kan vinden -->
                                    <th class="customer__th_name" onclick="sortTable(0)">Name</th>
                                    <th class="customer__th_comment" onclick="sortTable(1)">Comment</th>
                                    <th class="customer__td_refrence" onclick="sortTable(2)">Reference</th>
                                    <th class="customer__td_icon" onclick="sortTable(3)">Actions</th>
                                   
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
                                                $listUsers = $CustomerCtrl->getCustomers($customerID, 'Archived');
                                                break;
                                            case 'Deleted':
                                                $listUsers = $CustomerCtrl->getCustomers($customerID, 'Deleted');
                                                break;
                                            default:
                                                $listUsers = $CustomerCtrl->getCustomers($customerID, 'Active');
                                                break;
                                        }
                                    } else {
                                         // Checking for the status
                                         switch ($userStatus) {
                                            case 'Archived':
                                                $listUsers = $CustomerCtrl->getCustomers('Archived');
                                                break;
                                            case 'Deleted':
                                                $listUsers = $CustomerCtrl->getCustomers('Deleted');
                                                break;
                                            default:
                                                $listUsers = $CustomerCtrl->getCustomers('Active');
                                                break;
                                        }
                                    }

                                    // Looping through the results
                                    foreach ($listUsers as $user) {                                  
                                ?>
                                    <tr class="tab-table__row filter__row">
                                        <td class="tab-table__td" onclick="toDetails(<?php echo $user->getCustomerID();?>)" ><?php echo $user->getCustomerName(); ?> </td>
                                        <td class="tab-table__td" onclick="toDetails(<?php echo $user->getCustomerID();?>)"><?php echo $user->getCustomerComment(); ?></td>
                                        <td class="tab-table__td" onclick="toDetails(<?php echo $user->getCustomerID();?>)"><?php echo $user->getCustomerReference(); ?></td>

                                        <td class="tab-table__td">
                                            <a class="editKnop" href="customer-edit?customer=<?php echo $user->getCustomerID();?>"><i class="fas tab-table__icon">&#xf044;</i></a>
                                            <?php
                                                // Checking for status and user an different icon for a different icon for that status
                                                switch ($userStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" name="deleteKnop" href="#" data-toggle="modal" data-target="#deleteModal" id='<?php echo $user->getCustomerID();?>' onClick="reply_click(this.id)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                            <a class="deleteKnop" name="activeKnop" href="#" data-toggle="modal" data-target="#activeModal" id='<?php echo $user->getCustomerID();?>' onClick="reply_click(this.id)"><i class="fas fa-pastafarianism"></i></a>
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" name="archiveKnop" href="#" data-toggle="modal" data-target="#archiveModal" id='<?php echo $user->getCustomerID();?>' onClick="reply_click(this.id)"><i class="fas tab-table__icon">&#xf187;</i></a>
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

    <!--Archive Modal--->
    <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">Archive Customer</h5>
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
                <button type="submit" name="btnDelete" class="btn btn-primary" id="btnArchive">Archive   </button>          

                <script type="text/javascript">
                function reply_click(clicked_id)
                {
                    window.yourGlobalVariable = clicked_id;
                }

                $('#btnArchive').click(function () {

                $.ajax({
                    url: 'customer_handler_archive',
                    type: 'post',
                    data: { "CustomerID": yourGlobalVariable},
                    success: function(response) { window.location.href='customer_listtested?status=<?php echo $userStatus;?>' }
                });

                });

                </script>
               
            </div>
            </form>

            </div>
        </div>
        </div>
            
    <!--Delete Modal--->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Delete Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this costumer?
            </div>

            <form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                <button type="submit" name="btnDelete" class="btn btn-primary" id="btnDelete">Delete   </button>          

                <script type="text/javascript">
                function reply_click(clicked_id)
                {
                    window.yourGlobalVariable = clicked_id;
                }

                $('#btnDelete').click(function () {

                $.ajax({
                    url: 'customer_handler_delete',
                    type: 'post',
                    data: { "CustomerID": yourGlobalVariable},
                    success: function(response) { window.location.href='customer_listtested?status=<?php echo $userStatus;?>' }
                });

                });

                </script>
               
            </div>
            </form>

            </div>
        </div>
        </div>

    <!--Active Modal--->
    <div class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activeModal">Activate Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to activate this costumer?
            </div>

            <form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                <button type="submit" name="btnActive" class="btn btn-primary" id="btnActive">Activate   </button>          

                <script type="text/javascript">
                function reply_click(clicked_id)
                {
                    window.yourGlobalVariable = clicked_id;
                }

                $('#btnActive').click(function () {

                $.ajax({
                    url: 'customer_handler_activate',
                    type: 'post',
                    data: { "CustomerID": yourGlobalVariable},
                    success: function(response) { window.location.href='customer_listtested?status=<?php echo $userStatus;?>' }
                });

                });

                </script>
               
            </div>
            </form>

            </div>
        </div>
        </div>

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

        // Function set table status
        function updateTableStatus() {
            // Ophalen van de status
            var status = document.getElementById("customerStatus").value;

            // De pagina refreshen met de nieuwe waarden
            location.replace("?status=" + status);
}

        function toDetails(customerID){
            location.assign("customer-edit?customer=" + customerID);
        }

    </script>
</html>

<?php 
    // Looping through the results
    // if (!empty($customerDetails)) {
    //     foreach ($customerDetails as $customer) {
    //         echo "<script> 
    //             document.getElementById('pageTitle').innerHTML = 'Overview Customers of ". $customer->getCustomerName() ."'; 
    //         </script>";
    //     }
    // }
?>