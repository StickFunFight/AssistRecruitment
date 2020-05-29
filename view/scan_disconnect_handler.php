<?php
require '../functions/datalayer/UserDB.php';

echo '<script>alert("Ik ben een check");</script>';

if (isset($_POST['scanID']) && isset($_POST['userID'])) {

    $scanID = $_POST['scanID'];
    $userID = $_POST['userID'];

    echo '<script>alert("Ik ben een check");</script>';

    $CAF = new UserDB();
    $CAF->deleteUserScan($userID, $scanID);
    echo "Succes";

} else echo "failed";

?>