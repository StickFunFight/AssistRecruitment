<?php

//Include Menu
require('menu.php');
//Inlcude Database class
include '../functions/datalayer/database.class.php';
//Include Customer Controller Class
include '../functions/datalayer/CustomerDB.php';
//Customer Entity Class
include '../functions/models/entCustomer.php';

//Create connecting with CustomerDB Class
$CustomerDB = new CustomerDB();

?>

<html>

<head>
<!-- Linking to own styleheet -->
<link rel="stylesheet" href="../assests/styling/customer.css">
<link rel="stylesheet" href="../assests/styling/customer-edit.css">
</head>

<body>
    <!-- Page Container -->
    <div class="page__content">
        <!-- Bootstrap Container -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <h1 class="customer__header">Overview Customers</h1>
                    <br>
                </div>
            </div>
            <!-- Table setting -->
            <div class="row">
                <div class="col-sm-12"></div>
                <table class="table table-hover customer__table">
                    <thead>
                        <!-- Tablerow Headers -->
                        <tr class="customer__row">
                            <th class="customer__th_name">Name</th>
                            <th class="customer__th_comment">Comment</th>
                            <th class="customer__td_refrence">Reference</th>
                            <th class="customer__td_icon">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="customer__select">
                                        <!-- Combobox settings -->
                                        <select id="customerStatus" name="customerStatus" class="form-control" onchange="showCustomer(this.value)">
                                            <option value="Active">Active</option>
                                            <option value="Archived">Archived</option>
                                            <option value="Deleted">Deleted</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Status Change button -->
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-status" name="btnChangeStatus" value="Verander status">
                                </div>
                            </div>
                        </form>


                        <?php



                        //Read the Combobox Status
                        if (isset($_POST['customerStatus'])) {
                            $status = $_POST['customerStatus'];
                            $listCustomer = $CustomerDB->getCustomers($status);

                        } else {
                            $listCustomer = $CustomerDB->getCustomers("Active");
                        }

                        // Loop to go through the functions for every customer in the DB table
                        foreach ($listCustomer as $customer) {

                            echo "<br>";
                            echo "<tr class='customer__row' onclick=toDetails()>";

                            echo "<td class='customer__td_name'>";
                            echo $customer->getCustomerName();
                            echo "</td>";

                            echo "<td class='customer__td_comment'>";
                            echo $customer->getCustomerComment();
                            echo "</td>";

                            echo "<td class='customer__td_refrence'>";
                            echo $customer->getCustomerReference();
                            echo "</td>";

                            echo "<td class='customer__td_icon'>";
                            echo'
                            <a class="editKnop" href="customer-edit?customer='.$customer->getCustomerID().'"><i class="fas fa-edit"></i></a>
                            <a class="deleteKnop" href="#" data-toggle="modal" data-target="#ADModal" id='.$customer->getCustomerID().' onClick="reply_click(this.id)"><i class="fas fa-archive"></i></a>';

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <span id="iets"></span>
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
                function reply_click(clicked_id)
                {
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

$(document).ready(function(){
    $("#customerStatus").val("<?php echo $_POST['customerStatus']; ?>");
});


function toDetails($customer){
    location.replace("customer-edit?customer=<?php echo $customer->getCustomerID(); ?>"); 
}


</script>

</html>