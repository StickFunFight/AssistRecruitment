<?php
require '../datalayer/CategoryAddFunction.php';

$CAF = new CategoryAddFunction();

if (isset($_POST['catName'])){

    $catName = $_POST['catName'];


    $CAF->catOpslaan($catName);
    echo "Succes";

}else echo "failed";

?>
