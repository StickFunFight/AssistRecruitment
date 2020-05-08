
<?php
require '../functions/datalayer/DepartmentDB.php';

if (isset($_POST['departmentID'])){

    $DepartmentID = $_POST['departmentID'];

    $CAF = new DepartmentDB();
    $CAF->archiveDepartment($DepartmentID);
    echo "Succes";

}else echo "failed";

?>