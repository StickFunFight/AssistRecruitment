<?php
    include '../functions/controller/DepartmentController.php';
    require('menu.php');
    $ctrlDepartment = new DepartmentController();

    if(isset($_POST['submitCreateDepartment'])){
        $departmentName = $_POST['departmentName'];
        $departmentComment = $_POST['departmentComment'];
        $customerID = $_POST['customerID'];

        $ctrlDepartment->CreateDepartment($departmentName, $departmentComment, $customerID);
    }
?>

<!--This is where the HTML code comes in-->
<html>
<link rel="stylesheet" href="../assests/styling/customer-add.css">
    <head>
        <meta charset = "utf-8">
        <title>An interesting title</title>
    </head>
    <body>
        <div class="page__content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page__title">Department aanmaken</h1>
                    </div>
                </div>

                <!--Creating an HTML form-->
                <form method="post" class="department-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form__label">Department name:</label>
                            <input name="departmentName" class="form-control customer-add__input" type="text" required>
                        </div>
                    </div>

                    <div class="row page__row"> 
                        <div class="col-sm-6">
                            <label class="form__label">Department comment:</label>
                            <textarea name="departmentComment" class="form-control customer-add__input" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form__label">Customer ID:</label>
                            <input name="customerID" class="form-control customer-add__input">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input name="submitCreateDepartment" class="btn btn-add" type="submit" id="createDepartmentButton" value="Add department">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>