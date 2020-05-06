<?php

require '../datalayer/AxisDatabase.php';

$AD = new AxisDatabase();

if (isset($_POST['AxisID'])){

    $Aid = $_POST['AxisID'];
    $AD->archiveerAxis($Aid);
    echo "Succes";
}else echo "failed";
?>

