<?php
require '../functions/datalayer/QuestionairDatabase.php';

$QD = new QuestionairDatabase();

if (isset($_POST['questionairID']) || isset($_POST['questionairName']) || isset($_POST['questionairComment']) || isset($_POST['questionairStatus']))
{
    $QID = $_POST['questionairID'];
    $QName = $_POST['questionairName'];
    $QComment = $_POST['questionairComment'];
    $QStatus = $_POST['questionairStatus'];

    $QD->update($QID, $QName, $QComment, $QStatus);
}