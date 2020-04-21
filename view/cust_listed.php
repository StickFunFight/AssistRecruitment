<?php

//Include heap.php
require("head.php");

include '../functions/datalayer/database.class.php';

// Class job toevoegen aan het bestand
include '../functions/datalayer/getCustList.php';
// Class used technologie toevoegen aan het bestand
include '../functions/models/entCustomer.php';



//Connectie maken met class CustomerDB
$CustomerDB = new CustomerDB(); 

?>

<html>
<head>
</head>

    <body>
        
        <h2 class="customer__title" style="font-family:verdana">Customer List</h2>
        

        <table class="table table-hover customer__table" style="font-family:verdana">
        <thead>
        <tr>
            <th>Name</th>
            <th>Comment</th>
            <th>Reference</th>
            <th>Actions</th>


        </tr>
        </thead>
        <tbody>
        <?php

        
        // in de table body
        // Functies ophalen
        $listCustomer = $CustomerDB->getCustomers();

        // Loop om door de functies heen te lopen
        foreach($listCustomer as $customer){


            echo "<br>"
            echo "<tr>";

            echo "<td onclick='naarDetails(".$customer->getCustomerID().")'>";
            echo $customer->getCustomerNaam();
            echo "</td>";
                        

            echo "<td>";
            echo $customer->getCustomerComment();
            echo "</td>";
                    

            echo "<td>";
            echo $customer->getCustomerRefrence();
            echo "</td>";

            echo "<td>";
            echo '<a class="editKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-edit"></i></a>
            <a class="deleteKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-trash-alt"></i></a>
            <a class="profileKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-user"></i></a>';

            echo "</td>";

            echo "</tr>";


        }
        ?>



        </tbody>
    </table>
    </div>
        <span id="iets"></span>
    </body>

    <script>
        function naarDetails(var customerID){
            document.getElementById("iets").innerHTML = "Paragraph changed!";
        }
    </script>
</html>