<?php
require '../functions/models/EntCategory.php';
require '../functions/models/EntQuestionair.php';


class QuestionairDatabase
{
    private $conn;


    public function __construct()
    {
        require_once 'database.class.php';
        $database = new Database();
        $this->conn = $database->getConnection();
        }

    public function AddQuestionair($QName, $QStatus)
    {
        $query = "INSERT INTO questionair (questionairName, questionairComment, questionairStatus) VALUES (
                  '$QName', 'Dit is een test', '$QStatus'
                  )";
        $stm = $this->conn->prepare($query);
        if ($stm->execute())
        {
            return $this->conn->lastInsertId();
        }
    }

    public function GetQuestionairList($QID){

        $lijst = array();
        $query = "SELECT * FROM question
                  JOIN questionair_question ON questionair_question.questionID = question.questionID
                  JOIN questionair ON questionair.questionairID = questionair_question.questionairID
                  WHERE questionair.questionairID = $QID";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $item) {
                // Hier stonden de entiteit class functies maar hij wilde de database kolom namen
                $entQuestion = new EntQuestion($item->questionID, $item->categorieID, $item->axisID, $item->questionName, $item->questionExemple,
                                               $item->questionStatus, $item->questionType);
                array_push($lijst, $entQuestion);
            }
            return $lijst;

        } else {
           echo "oef foutje";
        }
    }


    public function getQuestions(){
        $lijst2 = array();
        $query2 = "SELECT * FROM question";
        $stm = $this->conn->prepare($query2);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $question) {
                // Hier stonden de entiteit class functies maar hij wilde de database kolom namen
                $antQuestion = new EntQuestion($question->questionID, $question->categorieID, $question->axisID, $question->questionName, $question->questionExemple,
                    $question->questionStatus, $question->questionType);
                array_push($lijst2, $antQuestion);
            }
            return $lijst2;

        } else {
            echo "oef foutje";
        }
    }

    public function add($QID, $QuestID){
        $query = "INSERT INTO questionair_question (questionairID, questionID) VALUES(
                  $QID, $QuestID
                  )";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
        }
    }

    public function GetQuestionair(){
        {
            $lijst = array();
            $query = "SELECT * FROM questionair";
            $stm = $this->conn->prepare($query);
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
            return "wowiepowie";
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