<?php
require '../functions/datalayer/UserDB.php';

if (isset($_POST['scanID'], ['userID'])){

    $ScanID = $_POST['scanID'];
    $UserID = $_POST['userID'];

    $CAF = new UserDB();
    $CAF->archiveScan($ScanID);
    echo "Succes";

}else echo "failed";

?>