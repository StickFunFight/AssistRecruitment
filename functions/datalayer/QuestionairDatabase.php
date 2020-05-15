<?php
require '../functions/models/EntCategory.php';
require '../functions/models/EntQuestionair.php';

class QuestionairDatabase
{
    private $db;


    public function __construct()
    {
        require_once 'database.class.php';
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function GetQuestionair(){
        {
            $lijst = array();
            $query = "SELECT * FROM questionair";
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $item) {
                    $entQuestionair = new EntQuestionair($item->questionairID, $item->questionairName, $item->questionairComment, $item->questionairStatus);
                    array_push($lijst, $entQuestionair);
                }
                return $lijst;
            } else {
                echo "oef foutje";
            }
        }

    }

    function archiveerQuestionair($QairID){
        //variabele (n) uit de url halen
        $query = "UPDATE questionair SET questionairStatus = 'Archived' WHERE questionairID = $QairID";

        $stm = $this->db->prepare($query);
        if ($stm->execute()) {

        } else return "oeps";
    }

    function showQuestionair($QairID){
        $query = "SELECT * FROM questionair WHERE questionairID = '$QairID'";
        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            echo $result->questionairName;
        } else echo "oeps";
    }

}