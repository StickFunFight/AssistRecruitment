<?php
require '../datalayer/CategoryDatabase.php';

$CAF = new CategoryDatabase();

if (isset($_POST['catName'])){

    $catName = $_POST['catName'];


    $CAF->catOpslaan($catName);
    echo "Succes";

}else echo "failed";

?>
