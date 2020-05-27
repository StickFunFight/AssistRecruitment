<?php
require '../functions/datalayer/ScanDB.php';

if (isset($_POST['scanID'])){

    $ScanID = $_POST['scanID'];

    $CAF = new ScanDB();
    $CAF->archiveScan($ScanID);
    echo "Succes";

}else echo "failed";

?>