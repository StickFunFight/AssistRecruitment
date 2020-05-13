
<?php
require '../functions/datalayer/CustomerDB.php';

if (isset($_POST['CustomerID'])){

    $CustomerID = $_POST['CustomerID'];

    $CAF = new CustomerDB();
    $CAF->activateCustomer($CustomerID);
    echo "Succes";

}else echo "failed";

?>