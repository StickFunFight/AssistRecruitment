<?php
require '../datalayer/CategoryDatabase.php';

$CAF = new CategoryDatabase();

if (isset($_POST['catID'])){

    $catID = $_POST['catID'];

    $CAF->DeleteQaCategory($catID);
    echo "Succes";

}else echo "failed";

?>