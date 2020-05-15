<?php

require_once 'database.class.php';

class QuestionairArchiveerDB{

    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();

    }
    function archiveerQuestionair($QairID){
        //variabele (n) uit de url halen
        $query = "UPDATE questionair SET questionairStatus = 'Archived' WHERE questionairID = $QairID";

        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {

        } else echo "oeps";
    }

    function showQuestionair($QairID){
        $query = "SELECT * FROM questionair WHERE questionairID = '$QairID'";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            echo $result->questionairName;
        } else echo "oeps";
    }




}
