<?php
require '../functions/datalayer/QuestionairDatabase.php';


$QD = new QuestionairDatabase();


if (isset($_POST['questionairID']) && isset($_POST['questionID'])){

    $QID = $_POST['questionairID'];
    $QuestID = $_POST['questionID'];

    $QD->delete($QID, $QuestID);
}
