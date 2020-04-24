<?php
require '../datalayer/CategoryDatabase.php';

$CAF = new CategoryDatabase();

if (isset($_POST['catName']) && isset($_POST['catStatus']) && isset($_POST['CustomerID'])){

    $catName = $_POST['catName'];
    $catStatus = $_POST['catStatus'];
    $customerID = $_POST['CustomerID'];

    echo $catName, $catStatus, $customerID;

    $CAF->catAanpassen($catName, $catStatus, $customerID);
    echo "Succes";


}else echo "failed";

?>
