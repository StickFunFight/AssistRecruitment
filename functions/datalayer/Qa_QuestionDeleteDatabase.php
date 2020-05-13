<?php

require_once 'database.class.php';
class Qa_QuestionDeleteDatabase
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    function DeleteQaQuestion($Qid){
        //variabele (n) uit de url halen
        $query ="UPDATE question SET questionStatus = 'Archived' WHERE questionID = ?";
        $stm = $this->db->prepare($query);
        $stm->bindParam(1, $Qid);
        if ($stm->execute()) {

        } else echo "oeps";
    }

    function showQ($Qid){
        $query ="SELECT * FROM question WHERE questionID = ?";
        $stm = $this->db->prepare($query);
        $stm->bindParam(1, $Qid);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
                echo $result->questionName;
        } else echo "oeps";
    }
}


