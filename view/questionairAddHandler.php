<?php

require '../functions/datalayer/QuestionairDatabase.php';


$QD = new QuestionairDatabase();


if (isset($_POST['questionairName']) && isset($_POST['questionairStatus'])){

    $QName = $_POST['questionairName'];
    $QStatus = $_POST['questionairStatus'];
    echo $QD->AddQuestionair($QName, $QStatus);

}
