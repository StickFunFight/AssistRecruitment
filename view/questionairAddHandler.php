<?php

require '../functions/datalayer/QuestionairDatabase.php';


$QD = new QuestionairDatabase();


if (isset($_POST['questionairName']) && isset($_POST['questionairComment']) && isset($_POST['questionairStatus']) ){

    $QName = $_POST['questionairName'];
    $QComment = $_POST['questionairComment'];
    $QStatus = $_POST['questionairStatus'];
    echo $QD->AddQuestionair($QName, $QComment, $QStatus);

}
