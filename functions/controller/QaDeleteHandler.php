<?php

require '../functions/datalayer/QaDatabase.php';

$QQD = new QaDatabase();

if (isset($_POST['questionName'])){

    $questionName = $_POST['questionName'];
    $QQD->DeleteQaQuestion($questionName);
    echo "Succes";
}else echo "failed";
?>
