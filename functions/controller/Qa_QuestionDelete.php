<?php

require '../functions/models/EntCategory.php';
class QaOverView
{
    private $db;

    public function __construct()
    {
        require_once '../functions/datalayer/database.class.php';
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function DeleteQaQuestion($Qid){
        //variabele (n) uit de url halen
        $query = "delete from question where questionID = $Qid ";


        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            Header("Location:Qa_QuestionDelete.php");
        } else echo "oeps";

    }
}





?>


