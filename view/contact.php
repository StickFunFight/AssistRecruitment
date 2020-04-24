<?php

//Include Menu
require('menu.php');
include '../functions/controller/contactController.php';

//Connectie maken met class contactcontroller
$contactController = new contactController();

?>
<html>

<head>
  <link rel="stylesheet" href="../assests/styling/contact.css">
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
          <h1 class="contactheader">Overview Contacts</h1>
          <br>
        </div>
      </div>
      <div class=select_status style="width: 300px">
        <label for="status">Choose status:</label>

        <select id="status">
          <option value="status_active">Active</option>
          <option value="status_archived">Archived</option>
          <option value="status_deleted">Deleted</option>
        </select>

      </div>

      <div class="row">
        <div class="col-sm-12"></div>
        <table class="table table-hover contacttable" style="font-family:verdana">
          <thead>
            <tr class="contactrow">
              <th class="contact__th_name">Name</th>
              <th class="contact__th_email">Email</th>
              <th class="contact__th_phonenumber">Phone number</th>
              <th class="contact__th_status">Status</th>
              <th class="contact__th_Customer">Customer</th>
              <th class="contact__th_Department">Department</th>
              <th class="contact__th_icon">Actions</th>


            </tr>
          </thead>
          <tbody>



            <?php

            //   in de table body
            //   Functies ophalen
            $listContact = $contactController->getContacts();

            // Loop om door de functies heen te lopen
            if (is_array($listContact) || is_object($listContact)) {

              foreach ($listContact as $contact) {

                echo "<br>";
                echo "<tr class='contact__row'>";

                echo "<td class='contact__td_name'>";
                echo $contact->getContactName();
                echo "</td>";

                echo "<td class='contact__td_name'>";
                echo $contact->getContactEmail();
                echo "</td>";

                echo "<td class='contact__td_phonenumber'>";
                echo $contact->getContactPhonenumber();
                echo "</td>";

                echo "<td class='contact__td_status'>";
                echo $contact->getContactStatus();
                echo "</td>";

                echo "<td class='contact__td_customer'>";
                echo $contact->getContactCustomerName();
                echo "</td>";

                echo "<td class='contact__td_department'>";
                echo $contact->getContactDepartmentName();
                echo "</td>";

                echo "<td class='contact__td_icon'>";
                echo '<a class="deleteKnop" href="DetailsContact?contact=' . $contact->getContactID() . '"><i class="fas fa-trash-alt"></i></a>
                      <a class="editKnop" href="DetailsContact?contact=' . $contact->getContactID() . '"><i class="fas fa-edit"></i></a>
                      <a class="profileKnop" href="DetailsContact?contact=' . $contact->getContactID() . '"><i class="fas fa-user"></i></a>';

                echo "</td>";

                echo "</tr>";
              }
            } else {
              echo "geen array";
            }

            ?>

          </tbody>
</body>

</html>