<?php

require '../functions/datalayer/Qa_QuestionDeleteDatabase.php';

$QD = new QaQuestionDeleteDatabase();

if (isset($_POST['questionName'])){

    $questionName = $_POST['questionName'];
    $QD->DeleteQaQuestion($Qid);
    echo "Succes";
}else echo "failed";
?>
