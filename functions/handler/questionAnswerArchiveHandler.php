<?php
require '../controller/QA_QuestionFunctions.php';

$QF = new QA_QuestionFunctions();

if (isset($_POST['answerID'])){

    $answerID = $_POST['answerID'];
    if($QF->checkifActiveAnswer($answerID) == true){
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("message not sent")';
        echo '</script>';
//        $QF->DeleteAnswer($answerID);
    }
}

