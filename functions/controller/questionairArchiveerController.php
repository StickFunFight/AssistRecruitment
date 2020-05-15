<?php
require'../datalayer/QuestionairArchiveerDB.php';

$QRD = new QuestionairArchiveerDB();

if (isset($_POST['questionairID'])){

    $QairID = $_POST['questionairID'];
    $QRD->archiveerQuestionair($QairID);
    echo "Succes";
}else echo "failed";