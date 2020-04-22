<?php
require '../functions/controller/CategoryAddFunction.php';

if (isset($_POST['catName'])){

    $catName = $_POST['catName'];

    $CAF = new CategoryAddFunction();
    $CAF->catOpslaan($catName);
    echo "Succes";

}else echo "failed";

?>
