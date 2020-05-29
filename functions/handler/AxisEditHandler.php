<?php
require '../datalayer/AxisDatabase.php';

$AD = new AxisDatabase();

if (isset($_POST['AxisName']) && isset($_POST['AxisStatus']) && isset($_POST['AxisID'])) {

    $AxisName = $_POST['AxisName'];
    $AxisStatus = $_POST['AxisStatus'];
    $AxisID = $_POST['AxisID'];

    $AD->AxisAanpassen($AxisName, $AxisStatus, $AxisID);
    echo "Succes";
} else echo "failed";
?>