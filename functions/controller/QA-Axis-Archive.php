<?php

require '../datalayer/AxisDatabase.php';

$AD = new AxisDatabase();

if (isset($_POST['AxisID'])){

    $Aid = $_POST['AxisID'];
    $AD->archiveerAxis($Aid);
}
else if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    $AD->showA($id);
}


