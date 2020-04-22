<?php
if(isset($_POST['callFunc1'])){
    require '../functions/controller/QA_QuestionFunctions.php';

    $QA = new QA_QuestionAddClass();
    $QA->setQuestion($callFunc1);
}