<?php
require '../datalayer/AxesDatabase.php';

$AD = new AxesDatabase();

if (isset($_POST['AxisName'])){

    $AxisName = $_POST['AxisName'];


    $AD->AxesOpslaan($AxisName);
    echo "Succes";

}else echo "failed";

?>
