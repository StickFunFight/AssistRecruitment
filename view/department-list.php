<?php

//Include Menu
require('menu.php');

// Adding the department controller
require '../functions/controller/DepartmentController.php';
// Adding the department modal
require '../functions/models/entDepartment.php';

// Getting the connection with the department class
$DepartmentDB = new DepartmentController();

// Getting departments by status
if(isset($_POST['btnChangeStatusDepartment'])){

    $statusDepartment = $_POST['cbxStatusDepartment'];

    $listDepartments = $DepartmentDB->getDepartments($statusDepartment);
}else{
    // Status not set
    $statusDepartment = "Active";
    $listDepartments = $DepartmentDB->getDepartments($statusDepartment);
}

?>
<html>

<head>
    <link rel="stylesheet" href="../assests/styling/contact.css">
    <link rel="stylesheet" href="../assests/styling/customer-edit.css">
    <link rel="stylesheet" href="../assests/styling/customer.css">
  <title></title>
</head>

<body>
<form method="post" class="page__content">

  <!-- Jouw container -->
  <div class="page__content">
    <!-- Bootstrap container -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <br>
          <h1 class="contactheader">Overview Departments</h1>
          <br>
        </div>
      </div>
      <form method="POST" action="customer-edit?customer=<?php echo $customerID; ?>&tab=scan">
        <div class="row">
          <div class="col-sm-6">
            <div class="customer__select">
              <select id="customerStatus" name="cbxStatusDepartment" class="form-control">
                  <option selected="selected" value="Active">Active</option>
                  <option value="Archived">Archived</option>
                  <option value="Deleted">Deleted</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
              <input type="submit" class="btn btn-status" name="btnChangeStatusScans" value="Change Status">
          </div>
        </div>
      </form>

        <table class="tab-table table table-hover">
            <thead class="tab-table__header">
                <tr class="tab-table__row">
                    <th class="tab-table__head">Name</th>
                    <th class="tab-table__head">Comment</th>
                    <th class="tab-table__head">Actions</th>
                </tr>
            </thead>

            <tbody class="tab-table__body">
                <?php
                    // Looping through the results
                    foreach ($listDepartments as $department) { 
                ?>
                    <tr class="tab-table__row">
                        <td class="tab-table__td"><?php echo $department->getDepartmentName(); ?></td>
                        <td class="tab-table__td"><?php echo $department->getdepartmentComment(); ?></td>
                        <td class="tab-table__td">
                            <a class="editKnop" href="#"><i class="fas tab-table__icon">&#xf044;</i></a>

                            <a class="deleteKnop" href="#"><i class="fas tab-table__icon">&#xf2ed;</i></a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>