<?php
require_once '../functions/controller/QA_QuestionFunctions.php';
$QF = new QA_QuestionFunctions();
if(isset($_POST['questionID']) && isset($_POST['CategoryQuestionEdit']) && isset($_POST['QuestionNameEdit']) && isset($_POST['QuestionExampleEdit']) && isset($_POST['QuestionStatusEdit']) && isset($_POST['QuestionTypeEdit'])){
    $questionID = $_POST['questionID'];
    $selCategory = $_POST['CategoryQuestionEdit'];
    $txQuestion = $_POST['QuestionNameEdit'];
    $taExemple = $_POST['QuestionExampleEdit'];
    $selStatus = $_POST['QuestionStatusEdit'];
    $selQuestionType = $_POST['QuestionTypeEdit'];

    $QF->updateQuestion($questionID, $selCategory, $txQuestion, $taExemple, $selStatus, $selQuestionType);
    ?><script>alert("STOP");</script><?php
}
else{
    ?><script>alert("STOP");</script><?php
}