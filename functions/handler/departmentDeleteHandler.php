
<?php
    require '../functions/controller/DepartmentController.php';

    // Checking for department ID
    if (isset($_POST['departmentID'])){

        $departmentID = $_POST['departmentID'];

        $departmentCtrl = new DepartmentController();
        $departmentCtrl->deleteDepartment($departmentID);
        echo "Succes";

    }else echo "failed";
?>