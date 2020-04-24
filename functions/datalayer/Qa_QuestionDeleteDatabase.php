<?php

require_once 'database.class.php';
class QaQuestionDeleteDatabase
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    function DeleteQaQuestion($Qid){
        //variabele (n) uit de url halen
        $query = "UPDATE question SET questionStatus = 'Archived' WHERE questionID = $Qid";

        $stm = $this->db->prepare($query);
        if ($stm->execute()) {

        } else echo "oeps";
    }

    function showQ($Qid){
        $query = "SELECT * FROM question WHERE questionID = '$Qid'";
        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
                echo $result->questionName;
        } else echo "oeps";
    }
}
?>


