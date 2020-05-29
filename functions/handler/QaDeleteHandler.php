<?php

require '../datalayer/Qa_QuestionDeleteDatabase.php';

$QD = new Qa_QuestionDeleteDatabase();

if (isset($_POST['QuestionId'])) {

    $Qid = $_POST['QuestionId'];
    $QD->DeleteQaQuestion($Qid);
    echo "Succes";
} else if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    $QD->showQ($id);;
}
