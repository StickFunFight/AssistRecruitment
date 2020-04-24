<?php

require '../datalayer/Qa_QuestionDeleteDatabase.php';

$QD = new QaQuestionDeleteDatabase();

if (isset($_POST['CustomerID'])){

    $Qid = $_POST['CustomerID'];
    $QD->DeleteQaQuestion($Qid);
    echo "Succes";
}else echo "failed";
?>
