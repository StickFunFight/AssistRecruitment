<?php

require '../functions/controller/Qa_QuestionDelete.php';

if (isset($_POST['questionName'])){

    $questionName = $_POST['questionName'];

    $QQD = new Qa_QuestionDelete();
    $QQD->questionDelete($questionName);
    echo "Succes";
}else echo "failed";


?>
