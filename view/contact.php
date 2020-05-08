<?php

//Include Menu
require('menu.php');
include '../functions/controller/contactController.php';
include '../functions/models/EntContact.php';

//Connectie maken met class contactcontroller
$contactController = new contactController();

?>
<html>

<head>
  <link rel="stylesheet" href="../assests/styling/contact.css">
  <link rel="stylesheet" href="../assests/styling/customer-edit.css">
  <title>Overview contacts</title>
</head>

<body>
  <form method="post" class="page__content">

    <!-- Jouw container -->
    <div class="page__content">
      <!-- Bootstrap container -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="ce__title">Overview Contacts</h1>
          </div>
        </div>
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
              <input class="form-control form-control-lg" id="Filter" type="text" placeholder="Zoek naar een user">
            </div>

            <div class="col-sm-6">
              <input type="submit" class="btn btn-status" name="btnChangeStatusScans" value="Change Status">
            </div>
          </div>
        </form>

        <div class="row">
          <div class="col-sm-12"></div>
          <table class="table table-hover contacttable" style="font-family:verdana" id="ContactTable">
            <thead>
              <tr class="contacthead">
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

              if (isset($_POST['btnChangeStatusScans'])) {
                $status = $_POST['cbxStatusScans'];
                $listContact = $contactController->getContacts($status);
              } else {
                $listContact = $contactController->getContacts("Active");
              }
              //   in de table body
              //   Functies ophalen
              //$listContact = $contactController->getContacts($status);

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
                  echo '<a class="deleteKnop" href="DetailsContact?contact=' . $contact->getUserID() . '"><i class="fas fa-trash-alt"></i></a>
                      <a class="editKnop" href="DetailsContact?contact=' . $contact->getUserID() . '"><i class="fas fa-edit"></i></a>
                      <a class="profileKnop" href="DetailsContact?contact=' . $contact->getUserID() . '"><i class="fas fa-user"></i></a>';

                  echo "</td>";

                  echo "</tr>";
                }
              } else {
                echo "geen array";
              }

              ?>

            </tbody>
  </form>
</body>



</html>

<script>
  $(document).ready(function(){
        $("#Filter").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#ContactTable .contact__row").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>