<?php
require '../functions/datalayer/UserDB.php';

if (isset($_POST['userID'])) {

    $UserID = $_POST['userID'];

    $CAF = new UserDB();
    $CAF->deleteUser($UserID);
    echo "Succes";

} else echo "failed";

?>