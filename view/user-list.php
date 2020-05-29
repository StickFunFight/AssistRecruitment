<?php
// Inlcude Database class
require '../functions/datalayer/database.class.php';
// Including controller
require '../functions/controller/UserController.php';
require '../functions/controller/CustomerController.php';
// Including entity classes
require '../functions/models/entContact.php';
require '../functions/models/entCustomer.php';

// Creating connections with the classes
$CustomerCtrl = new CustomerController();
$userCtrl = new UserController();

// Creating a customer id to fil it later
$customerID;

// If there is a customer id, it will be of the customer, else it will be 0
// This is to later check wich functions shouldn't be activeted
if (isset($_GET['customer'])) {
    $customerID = $_GET['customer'];
} else {
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
                                    <select id="userStatus" name="cbxUserStatus" class="form-control"
                                            onchange="updateTableStatus(<?php echo $customerID; ?>)">
                                        <?php
                                        // Checking if a status has been set
                                        if ($userStatus != "none") {
                                            $customerStatus[] = "Active";
                                            $customerStatus[] = "Archived";
                                            $customerStatus[] = "Deleted";

                                            // Looping through the statusses and checking wich one is equeal
                                            foreach ($customerStatus as $value) {
                                                if ($value == $userStatus) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $value; ?>"><?php echo $value; ?></option>
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
                                <input class="form-control input__filter" id="Filter" type="text"
                                       placeholder="Search...">
                            </div>

                            <div class="col-sm-2">
                                <div class="add-container">
                                    <?php
                                    // Checking for customer id to know where to add the new user to
                                    if ($customerID != 0) {
                                        ?>
                                        <a href="user-add?customer=<?php echo $customerID; ?>"
                                           class="btn add-container__btn"><i
                                                    class='fas add-container--icon'>&#xf055;</i> Add user</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="user-add" class="btn add-container__btn"><i
                                                    class='fas add-container--icon'>&#xf055;</i> Add user</a>
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
                            <th class="tab-table__head">Name
                                <div class="table__icon-top" onclick="sortTable('filterTable', 0, 'asc')"></div>
                                <div class="table__icon-bottom" onclick="sortTable('filterTable', 0, 'desc')"></div>
                            </th>
                            <th class="tab-table__head">Phone number
                                <div class="table__icon-top" onclick="sortTable('filterTable', 1, 'asc')"></div>
                                <div class="table__icon-bottom" onclick="sortTable('filterTable', 1, 'desc')"></div>
                            </th>
                            <th class="tab-table__head">Email
                                <div class="table__icon-top" onclick="sortTable('filterTable', 2, 'asc')"></div>
                                <div class="table__icon-bottom" onclick="sortTable('filterTable', 2, 'desc')"></div>
                            </th>
                            <?php
                            // Checking if there is a customer set
                            if ($customerID == 0) {
                                ?>
                                <th class="tab-table__head">Customer
                                    <div class="table__icon-top" onclick="sortTable('filterTable', 3, 'asc')"></div>
                                    <div class="table__icon-bottom" onclick="sortTable('filterTable', 3, 'desc')"></div>
                                </th>
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
                                    $listUsers = $userCtrl->getUsersCustomer($customerID, 'Archived');
                                    break;
                                case 'Deleted':
                                    $listUsers = $userCtrl->getUsersCustomer($customerID, 'Deleted');
                                    break;
                                default:
                                    $listUsers = $userCtrl->getUsersCustomer($customerID, 'Active');
                                    break;
                            }
                        } else {
                            // Checking for the status
                            switch ($userStatus) {
                                case 'Archived':
                                    $listUsers = $userCtrl->getUsers('Archived');
                                    break;
                                case 'Deleted':
                                    $listUsers = $userCtrl->getUsers('Deleted');
                                    break;
                                default:
                                    $listUsers = $userCtrl->getUsers('Active');
                                    break;
                            }
                        }

                        // Looping through the results
                        foreach ($listUsers as $user) {
                            ?>
                            <tr class="tab-table__row filter__row">
                                <td class="tab-table__td"
                                    onclick="toDetails(<?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getContactName(); ?></td>
                                <td class="tab-table__td"
                                    onclick="toDetails(<?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserPhoneNumber(); ?></td>
                                <td class="tab-table__td"
                                    onclick="toDetails(<?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserEmail(); ?></td>
                                <?php
                                // Checking if there is a customer set
                                if ($customerID == 0) {
                                    ?>
                                    <td class="tab-table__td"
                                        onclick="toDetails(<?php echo $customerID; ?>, <?php echo $user->getUserID(); ?>)"><?php echo $user->getUserCustomerName(); ?></td>
                                    <?php
                                }
                                ?>
                                <td class="tab-table__td">
                                    <a class="editKnop" href="user-edit?user=<?php echo $user->getUserID(); ?>"><i
                                                class="fas tab-table__icon">&#xf044;</i></a>
                                    <?php
                                    // Checking for status and user an different icon for a different icon for that status
                                    switch ($userStatus) {
                                        case 'Archived':
                                            ?>
                                            <a class="deleteKnop" href="#" data-toggle="modal"
                                               data-target="#deleteModal" id='<?php echo $user->getUserID(); ?>'
                                               onClick="reply_click(this.id)"><i
                                                        class="fas tab-table__icon">&#xf2ed;</i></a>
                                            <?php
                                            break;
                                        case 'Deleted':
                                            ?>

                                            <?php
                                                // Checking for status and user a different icon for a different icon for that status
                                                switch ($userStatus) {
                                                    case 'Archived':
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#deleteModal" id='<?php echo $user->getUserID();?>' onClick="reply_click(this.id)"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                                                        <?php
                                                        break;
                                                    case 'Deleted':
                                                        ?>
                                                        
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#archiveModal" id='<?php echo $user->getUserID();?>' onClick="reply_click(this.id)"><i class="fas tab-table__icon">&#xf187;</i></a>
                                                        <?php
                                                        break;
                                                }
                                            ?>
                                            <a class="deleteKnop" href="#" data-toggle="modal"
                                               data-target="#archiveModal" id='<?php echo $user->getUserID(); ?>'
                                               onClick="reply_click(this.id)"><i
                                                        class="fas tab-table__icon">&#xf187;</i></a>
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

    <!--Delete Modal--->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>

                <form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        <button type="submit" name="btnDelete" class="btn btn-primary" id="btnDelete">Delete</button>

                        <script type="text/javascript">
                            function reply_click(clicked_id) {
                                window.yourGlobalVariable = clicked_id;
                            }

                            $('#btnDelete').click(function () {

                                $.ajax({
                                    url: 'user_handler_delete',
                                    type: 'post',
                                    data: {"userID": yourGlobalVariable},
                                    success: function (response) {
                                        window.location.href = 'user-list?status=<?php echo $userStatus;?>'
                                    }
                                });

                            });

                        </script>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--Archive Modal--->
    <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModal">Archive User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to archive this user?
                </div>

                <form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        <button type="submit" name="btnArchive" class="btn btn-primary" id="btnArchive">Archive</button>

                        <script type="text/javascript">
                            function reply_click(clicked_id) {
                                window.yourGlobalVariable = clicked_id;
                            }

                            $('#btnArchive').click(function () {

                                $.ajax({
                                    url: 'user_handler_archive',
                                    type: 'post',
                                    data: {"userID": yourGlobalVariable},
                                    success: function (response) {
                                        window.location.href = 'user-list?status=<?php echo $userStatus;?>'
                                    }
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
        $(document).ready(function () {
            $("#Filter").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#filterTable .filter__row").filter(function () {
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

        // Function to go to the details onclick
        function toDetails(customerID, userID) {
            // Sending the user to a new page
            if (customerID == 0) {
                location.assign("user-edit?user=" + userID);
            } else {
                location.assign("user-edit?user=" + userID + "&customer=" + customerID);
            }
        }
    </script>
    </html>

<?php
// Looping through the results
if (!empty($customerDetails)) {
    foreach ($customerDetails as $customer) {
        echo "<script> 
                document.getElementById('pageTitle').innerHTML = 'Overview users of " . $customer->getCustomerName() . "'; 
            </script>";
    }
}
?>