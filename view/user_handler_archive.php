<?php
require '../functions/datalayer/UserDB.php';

if (isset($_POST['userID'])){

    $UserID = $_POST['userID'];

    $CAF = new UserDB();
    $CAF->archiveUser($UserID);
    echo "Succes";

}else echo "failed";

?>