<?php
require 'CategoryAddFunction.php';

if (isset($_POST['catName']) && isset($_POST['catStatus']) && isset($_POST['oldCatName'])){

    $catName = $_POST['catName'];
    $catStatus = $_POST['catStatus'];
    $oldCatName = $_POST['oldCatName'];

    $CAF = new CategoryAddFunction();
    $CAF->catAanpassen($catName, $catStatus, $oldCatName);
    echo "Succes";
    echo $catName, $oldCatName;

}else echo "failed";

?>
