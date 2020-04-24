<?php

require '../datalayer/Qa_QuestionDeleteDatabase.php';

$QD = new Qa_QuestionDeleteDatabase();

if (isset($_POST['CustomerID'])){

    $Qid = $_POST['CustomerID'];
    $QD->DeleteQaQuestion($Qid);
    echo "Succes";
}else echo "failed";
?>
