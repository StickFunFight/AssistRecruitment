<?php

//Include Menu
require('menu.php');

include '../functions/datalayer/database.class.php';

// Class job toevoegen aan het bestand
include '../functions/controller/getCustList.php';
// Class used technologie toevoegen aan het bestand
include '../functions/models/entCustomer.php';



//Connectie maken met class CustomerDB
$CustomerDB = new CustomerDB(); 


?>

<html>
<head>
</head>

    <body>
        <!-- Jouw container -->
        <div class="page__content">
            <!-- Bootstrap container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <h1 class="customer__header">Overview Customers</h1>
                        <br>
                    </div>    
                </div>

                <div class="row">
                    <div class="col-sm-12"></div>
                        <table class="table table-hover customer__table">
                        <thead>
                        <tr class="customer__row">
                            <th class="customer__th_name">Name</th>
                            <th class="customer__th_comment">Comment</th>
                            <th class="customer__td_refrence">Reference</th>
                            <th class="customer__td_icon">Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="customer__select">
                                            <select id="customerStatus" name="cbxStatus" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Archived">Archived</option>
                                                <option value="Deleted">Deleted</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-status" name="btnChangeStatus" value="Verander status">
                                    </div>
                                </div>
                            </form>

                            
                        <?php

                        if(isset($_POST['btnChangeStatus'])){

                            $status = $_POST['cbxStatus'];

                            $listCustomer = $CustomerDB->getCustomers($status);
                        }else{
                            $listCustomer = $CustomerDB->getCustomers("Active");
                        }

                        // Loop om door de functies heen te lopen
                        foreach($listCustomer as $customer){

                            
                            echo "<br>";
                            echo "<tr class='customer__row'>";

                            echo "<td class='customer__td_name' onclick='naarDetails(".$customer->getCustomerID().")'>";
                            echo $customer->getCustomerNaam();
                            echo "</td>";
                        
                            echo "<td class='customer__td_comment'>";
                            echo $customer->getCustomerComment();
                            echo "</td>";

                            echo "<td class='customer__td_refrence'>";
                            echo $customer->getCustomerRefrence();
                            echo "</td>";

                            echo "<td class='customer__td_icon'>";
                            // echo '<a class="editKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-edit"></i></a>
                            echo '<a class="editKnop" href="https://youtu.be/oHg5SJYRHA0"><i class="fas fa-edit"></i></a>
                            <a class="deleteKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-trash-alt"></i></a>
                            <a class="profileKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-user"></i></a>';

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

    <script>
        function naarDetails(var customerID){
            // document.getElementById("iets").innerHTML = "Paragraph changed!";
            echo 'hey hallo en welkom';
        }
    </script>
</html>