<?php
// Inlcude Database class
require '../functions/datalayer/database.class.php';
// Including controller
require '../functions/controller/DepartmentController.php';
require '../functions/controller/CustomerController.php';
// Including entity classes
require '../functions/models/EntDepartment.php';
require '../functions/models/entCustomer.php';

// Creating connections with the classes
$CustomerCtrl = new CustomerController();
$departmentCtrl = new DepartmentController();

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
$dpStatus;

// Checking for a status and filling dpStatus with that status
if (isset($_GET['status'])) {
    $dpStatus = $_GET['status'];
} else {
    $dpStatus = "none";
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
                    <h1 class="ce__title" id="pageTitle">Overview Departments<h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <form method="POST" action="testfile?customer=<?php echo $customerID; ?>&tab=scan">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="customer__select">
                                    <select id="dpStatus" name="cbxDepartmentStatus" class="form-control"
                                            onchange="updateTableStatus(<?php echo $customerID; ?>)">
                                        <?php
                                        // Checking if a status has been set
                                        if ($dpStatus != "none") {
                                            $overviewStatus[] = "Active";
                                            $overviewStatus[] = "Archived";
                                            $overviewStatus[] = "Deleted";

                                            // Looping through the statusses and checking wich one is equeal
                                            foreach ($overviewStatus as $value) {
                                                if ($value == $dpStatus) {
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
                                        <a href="department-add?customer=<?php echo $customerID; ?>"
                                           class="btn add-container__btn"><i
                                                    class='fas add-container--icon'>&#xf055;</i> Add department</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="department-add" class="btn add-container__btn"><i
                                                    class='fas add-container--icon'>&#xf055;</i> Add department</a>
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
                            <th class="tab-table__head">Name
                                <div class="table__icon-top" onclick="sortTable('filterTable', 0, 'asc')"></div>
                                <div class="table__icon-bottom" onclick="sortTable('filterTable', 0, 'desc')"></div>
                            </th>
                            <th class="tab-table__head">Comment
                                <div class="table__icon-top" onclick="sortTable('filterTable', 1, 'asc')"></div>
                                <div class="table__icon-bottom" onclick="sortTable('filterTable', 1, 'desc')"></div>
                            </th>
                            <?php
                            // Checking if there is a customer set
                            if ($customerID == 0) {
                                ?>
                                <th class="tab-table__head">Customer
                                    <div class="table__icon-top" onclick="sortTable('filterTable', 2, 'asc')"></div>
                                    <div class="table__icon-bottom"
                                         onclick="sortTable('filterTable', 2, 'desc')"></div></td>
                                <?php
                            }
                            ?>
                            <th class="tab-table__head">Actions</th>
                        </tr>
                        </thead>

                        <tbody class="tab-table__body">
                        <?php
                        // Creating a list to fill it later
                        $listDepartments;

                        // Checking if a customer id is set
                        if ($customerID != 0) {
                            // Checking for the status
                            switch ($dpStatus) {
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
                        } else {
                            // Checking for the status
                            switch ($dpStatus) {
                                case 'Archived':
                                    $listDepartments = $departmentCtrl->getDepartments('Archived');
                                    break;
                                case 'Deleted':
                                    $listDepartments = $departmentCtrl->getDepartments('Deleted');
                                    break;
                                default:
                                    $listDepartments = $departmentCtrl->getDepartments('Active');
                                    break;
                            }
                        }

                        // Looping through the results
                        foreach ($listDepartments as $department) {
                            ?>
                            <tr class="tab-table__row filter__row">
                                <td class="tab-table__td"
                                    onclick="toDetails(<?php echo $customerID; ?>, <?php echo $department->getDepartmentID(); ?>)"><?php echo $department->getDepartmentName(); ?></td>
                                <td class="tab-table__td"
                                    onclick="toDetails(<?php echo $customerID; ?>, <?php echo $department->getDepartmentID(); ?>)"><?php echo $department->getDepartmentComment(); ?></td>
                                <?php
                                // Checking if there is a customer set
                                if ($customerID == 0) {
                                    ?>
                                    <td class="tab-table__td"
                                        onclick="toDetails(<?php echo $customerID; ?>, <?php echo $department->getDepartmentID(); ?>)"><?php echo $department->getCustomerName(); ?></td>
                                    <?php
                                }
                                ?>
                                <td class="tab-table__td">
                                    <?php
                                    // Checking if there is a customer set
                                    if ($customerID == 0) {
                                        ?>
                                        <a class="editKnop"
                                           href="department-edit?department=<?php echo $department->getDepartmentID(); ?>"><i
                                                    class="fas tab-table__icon">&#xf044;</i></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="editKnop"
                                           href="department-edit?department=<?php echo $department->getDepartmentID(); ?>&customer=<?php echo $customerID; ?>"><i
                                                    class="fas tab-table__icon">&#xf044;</i></a>
                                        <?php
                                    }

                                    // Checking for status and user an different icon for a different icon for that status
                                    switch ($dpStatus) {
                                        case 'Archived':
                                            ?>
                                            <a class="deleteKnop" href="#" data-toggle="modal"
                                               data-target="#deleteModal"
                                               id='<?php echo $department->getDepartmentID(); ?>'
                                               onClick="reply_click(this.id)"><i
                                                        class="fas tab-table__icon">&#xf2ed;</i></a>
                                            <?php
                                            break;
                                        case 'Deleted':
                                            ?>

                                            <?php
                                            break;
                                        default:
                                            ?>
                                            <a class="deleteKnop" href="#" data-toggle="modal"
                                               data-target="#archiveModal"
                                               id='<?php echo $department->getDepartmentID(); ?>'
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
                    <h5 class="modal-title" id="deleteModal">Delete Department</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this department?
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
                                    url: 'department_handler_delete',
                                    type: 'post',
                                    data: {"departmentID": yourGlobalVariable},
                                    success: function (response) {
                                        window.location.href = 'department-list?status=<?php echo $dpStatus;?>'
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
                    <h5 class="modal-title" id="archiveModal">Archive Department</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to archive this department?
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
                                    url: 'department_handler_archive',
                                    type: 'post',
                                    data: {"departmentID": yourGlobalVariable},
                                    success: function (response) {
                                        window.location.href = 'department-list?status=<?php echo $dpStatus;?>'
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
            var status = document.getElementById("dpStatus").value;

            // De pagina refreshen met de nieuwe waarden
            if (customerID == 0) {
                location.replace("?status=" + status);
            } else {
                location.replace("?customer=" + customerID + "&status=" + status);
            }
        }

        // Function to go to the details onclick
        function toDetails(customerID, departmentID) {
            // Sending the user to a new page
            if (customerID == 0) {
                location.assign("department-edit?department=" + departmentID);
            } else {
                location.assign("department-edit?department=" + departmentID + "&customer=" + customerID);
            }
        }
    </script>
    </html>

<?php
// Looping through the results
if (!empty($customerDetails)) {
    foreach ($customerDetails as $customer) {
        echo "<script> 
                document.getElementById('pageTitle').innerHTML = 'Overview departments of " . $customer->getCustomerName() . "'; 
            </script>";
    }
}
?>