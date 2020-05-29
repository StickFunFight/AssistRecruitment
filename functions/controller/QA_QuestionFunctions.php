<?php
require_once '../functions/datalayer/database.class.php';

class QA_QuestionFunctions
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getLastInsertedID()
    {
        $lastID = $this->conn->lastInsertId();
        return $lastID;
    }

    public function getAnswer($answerID)
    {
        $sql = "SELECT * FROM answer WHERE answerID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $answerID);
        if ($stm->execute()) {
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                return $row;
            }
        } else {
            echo "OEPS";
        }
    }

    public function updateQuestionAnswer($answerID, $answerName, $answerScore)
    {
        // Create Query to update answer status Status
        $query = "UPDATE answer SET answerScore = ?, answer = ? WHERE answerID = ?";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $answerScore);
        $stm->bindParam(2, $answerName);
        $stm->bindParam(3, $answerID);
        if ($stm->execute()) {

        }
    }

    public function deleteAnswer($answerID)
    {
        // Create Query to update answer status Status
        $query = "UPDATE answer SET status = 'Archived' WHERE answerID = ?";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $answerID);
        if ($stm->execute()) {

        }
    }

    public function checkifActiveAnswer($answerID)
    {
        $query = "SELECT a.answerID, a.questionID, q.questionID, s.scanStatus, s.scanID, sq.scanID
                    FROM answer a, question q, scan s, scan_question sq
                    WHERE a.questionID = q.questionID
                    AND s.scanStatus = 'Active'
                    AND q.questionID = sq.questionID
                    AND sq.scanID = s.scanID
                    AND a.answerID = ?";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $answerID);
        if ($stm->execute()) {
            if ($stm->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function setQuestion($categorieID, $axisID, $questionName, $questionExemple, $questionStatus, $questionType)
    {
        $sql = "INSERT INTO question (categorieID, axisID, questionName, questionExemple, questionStatus, questionType) VALUES ($categorieID, $axisID, '$questionName', '$questionExemple', '$questionStatus', '$questionType')";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
    }

    public function updateQuestion($questionID, $categorieID, $taAxis, $questionname, $questionExemple, $questionStatus, $questionType)
    {
        $sql = "UPDATE question SET categorieID = ?, axisID = ?, questionName = ?, questionExemple = ?, questionStatus = ?, questionType = ? WHERE questionID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $categorieID);
        $stm->bindParam(2, $taAxis);
        $stm->bindParam(3, $questionname);
        $stm->bindParam(4, $questionExemple);
        $stm->bindParam(5, $questionStatus);
        $stm->bindParam(6, $questionType);
        $stm->bindParam(7, $questionID);
        $stm->execute();
        print_r($sql);
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categorie";
        $stm = $this->conn->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $cat) {
                echo "<option value=" . $cat->categorieID . ">" . $cat->categorieName . "</option>";
            }
        }
    }

    public function getCategoryName($categoryID)
    {
        $sql = "SELECT * FROM categorie WHERE categorieID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $categoryID);
        if ($stm->execute()) {
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                return $row;
            }
        } else {
            echo "OEPS";
        }
    }

    public function getQuestionID()
    {
        $sql = "SELECT * FROM question";
        $stm = $this->conn->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $question) {
                echo "<option value=" . $question->questionID . ">" . $question->questionName . "</option>";
            }
        }
    }

    public function getQuestionData($questionID)
    {
        $sql = "SELECT q.questionID, q.questionName, q.questionExemple, q.questionStatus, q.questionType, c.categorieName, q.categorieID FROM question q JOIN categorie c ON c.categorieID = q.categorieID WHERE q.questionID = '$questionID'";
        $stm = $this->conn->prepare($sql);
        if ($stm->execute()) {
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                return $row;
            }
        }
    }

    public function getAllAxis()
    {
        $sql = "SELECT * FROM axis";
        $stm = $this->conn->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $axis) {
                echo "<option value=" . $axis->AxisId . ">" . $axis->AxisName . "</option>";
            }
        }

    }

    public function getQuestionAnswer($arrayQA, $questionID)
    {

        $sql = "SELECT * FROM answer WHERE questionID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $questionID);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $answer) {
                $realID = $answer->answerID;
                $answerName = $answer->answer;
                $answerScore = $answer->answerScore;

                $entQuestion = new entAnswer($realID, $answerName, $answerScore);
                array_push($arrayQA, $entQuestion);

            }
            return $arrayQA;
        }
    }

    public function setQuestionAnswer($answer, $answerScore, $questionID)
    {
        $sql = "INSERT INTO answer (answer, answerScore, questionID) VALUES (?, ?, ?)";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $answer);
        $stm->bindParam(2, $answerScore);
        $stm->bindParam(3, $questionID);
        if ($stm->execute()) {
            echo "Antwoord: " . $answer;
            echo "Score: " . $answerScore;
            echo "QuestionID" . $questionID;
        }

    }

    public function putinArrayAnswer($arrayTempAnswer, $answer, $answerScore)
    {
        $entQuestion = new entAnswer("1", $answer, $answerScore);
        array_push($arrayTempAnswer, $entQuestion);

        return $arrayTempAnswer;
    }

    public function readArrayAnswer($arrayTempAnswer)
    {
        return $arrayTempAnswer;
    }

    public function getDataFromSelectedQuestionID($questionID)
    {

    }

    public function fillCategorySelect()
    {

    }
}