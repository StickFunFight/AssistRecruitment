<?php

require '../datalayer/QuestionairDatabase.php';
require '../controller/questionairController.php';

$QD = new QuestionairDatabase();
$QC = new questionairController();

if (isset($_POST['questionairName']) && isset($_POST['questionairStatus'])){

    $QName = $_POST['questionairName'];
    $QStatus = $_POST['questionairStatus'];
    if($QD->AddQuestionair($QName, $QStatus)){
        $QC->setQuestionairID($QName);
    }
}
