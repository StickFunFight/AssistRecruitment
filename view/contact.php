<?php

//Include Menu
require('menu.php');
include '../functions/controller/contactController.php';

//Connectie maken met class CustomerDB
$contactController = new contactController();

?>
<html>
<head>
<title></title>
</head>
<body>
    <!-- Jouw container -->
    <div class="pagecontent">
            <!-- Bootstrap container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <h1 class="customerheader">Overview Contacts</h1>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12"></div>
                        <table class="table table-hover customertable" style="font-family:verdana">
                        <thead>
                        <tr class="customerrow">
                            <th class="customertd">Name</th>
                            <th class="customertd">Comment</th>
                            <th class="customertd">Reference</th>
                            <th class="customertd">Actions</th>


                        </tr>
                        </thead>
                            <tbody>



                        <?php

                     //   in de table body
                     //   Functies ophalen
                        $listContact = $contactController->getContacts();

                        echo "<br><br>" . $listContact;

                       // Loop om door de functies heen te lopen
                        foreach($listContact as $contact){

//                            echo "<br>";
                            echo "<tr class='customer__row'>";

                            echo "<td class='customer__td'>";
                            echo $contact->getContactName();
                            echo "</td>";
                        
                            echo "<td class='customer__td'>";
                            echo $contact->getContactEmail();
                            echo "</td>";

                            echo "<td class='customer__td'>";
                            echo $contact->getContactPhonenumber();
                            echo "</td>";

                            echo "<td class='customer__td'>";
                            // echo '<a class="editKnop" href="DetailsCustomer?customer='.$customer->getCustomerID().'"><i class="fas fa-edit"></i></a>
                            echo '<a class="editKnop" href="https://youtu.be/oHg5SJYRHA0"><i class="fas fa-edit"></i></a>
                            <a class="deleteKnop" href="DetailsCustomer?customer='.$contact->getContactCustomerID().'"><i class="fas fa-trash-alt"></i></a>
                            <a class="profileKnop" href="DetailsCustomer?customer='.$contact->getContactCustomerID().'"><i class="fas fa-user"></i></a>';

                            echo "</td>";

                            echo "</tr>";


                        }

                        ?>
            <!-- <table style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th>gender</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
    <td>male</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>female</td>
  </tr>
</table> -->


                        </tbody>
</body>
</html>