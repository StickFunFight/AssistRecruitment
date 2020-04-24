<?php

require_once 'database.class.php';
class QaDatabase
{
    private $db;

    public function __construct()
    {
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


