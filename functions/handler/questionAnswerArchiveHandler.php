<?php
require '../functions/QA_QuestionFunctions.php';

$QF = new QA_QuestionFunctions();

if (isset($_POST['answerID'])){

    $answerID = $_POST['answerID'];

    $QF->DeleteAnswer($answerID);
}

