<?php


class Qa_QuestionDelete
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
        $query = "UPDATE question SET questionStatus = 'deleted' WHERE questionName = '$Qid'";


        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            Header("Location:Qa_QD.php");
        } else echo "oeps";

    }
}





?>


