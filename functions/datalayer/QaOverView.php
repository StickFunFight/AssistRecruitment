<?php
require '../functions/models/EntCategory.php';
require '../functions/models/EntQuestionAnswer.php';

class QaOverView
{
    private $db;

    public function __construct()
    {
        require_once 'database.class.php';
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function GetAllCategories()
    {
        $lijst = array();
        $query = "SELECT * FROM categorie where categorieStatus = 'Active'";
        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $item) {
                $entCategorie = new EntCategory($item->categorieID, $item->categorieName, $item->categorieStatus);
                array_push($lijst, $entCategorie);
            }
            return $lijst;

        } else {
            echo "oef foutje";
        }
    }

    function GetQuestionAnswers()
    {
        $lijst = array();
        $query = "SELECT * FROM QuestionAnswer";
        $stm = $this->db->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $item) {
                $entQuestionAnswer = new EntQuestionAnswer($item->questionID, $item->categorieID, $item->questionStatus, $item->questionName, $item->questionType, $item->answerID);
                if (!empty($lijst[$item->questionID])) {
                    $entQuestionAnswer = $lijst[$item->questionID];
                }
                $Answers = $entQuestionAnswer->getAnswers();
                array_push($Answers, $item->answer);
                $entQuestionAnswer->setAnswers($Answers);
                $lijst[$item->questionID] = $entQuestionAnswer;
//                array_push($lijst, $entQuestionAnswer);
            }
            return $lijst;
        } else {
            echo "oef foutje";
        }
    }
}