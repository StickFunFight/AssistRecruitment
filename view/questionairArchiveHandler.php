<?php
require_once '../functions/datalayer/QuestionairDatabase.php';

if (isset($_POST['questionairID'])){
    $QD = new QuestionairDatabase();
    $QID = $_POST['questionairID'];
    $QD->archiveerQuestionair($QID);
}