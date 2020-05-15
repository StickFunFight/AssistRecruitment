<?php


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
        $query = "INSERT INTO questionair (questionairName, questionairStatus) VALUES (
                  $QName , $QStatus
                  )";
        $stm = $this->conn->prepare($query);
        if ($stm->execute())
        {

        }
    }

    public function getQuestionairID($QName)
    {
        $query = "SELECT questionairID FROM questionair WHERE questionairName = '$QName'";
        $stm = $this->conn->prepare($query);
        if ($stm->execute())
        {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result->questionairID;
        }
    }

    public function GetQuestionairList($QID){

        $lijst = array();
        $query = "SELECT * FROM question
                  JOIN questionair_question ON questionair_question.questionID = question.questionID
                  JOIN questionair ON questionair.questionairID = questionair_question.questionairID
                  WHERE questionair.questionairID = 1";
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
}