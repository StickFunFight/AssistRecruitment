<?php

class QA_QuestionFunctions
{
    private $conn;

    public function __construct()
    {
        require_once "../functions/datalayer/database.class.php";
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setQuestion($categorieID, $questionName, $questionExemple, $questionStatus, $questionType)
    {
        $sql = "INSERT INTO question (categorieID, questionName, questionExemple, questionStatus, questionType) VALUES ($categorieID, '$questionName', '$questionExemple', '$questionStatus', '$questionType')";
        $stm = $this->conn->prepare($sql);
        echo $sql;
        $stm->execute();
    }

    public function updateQuestion($questionID, $categorieID, $questionname, $questionExemple, $questionStatus, $questionType){
        $sql = "UPDATE question SET categorieID = '$categorieID', questionname = '$questionname', questionExemple = '$questionExemple', questionStatus = '$questionStatus', questionType = '$questionType' WHERE questionID = '$questionID'";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
    }

    public function getCategories(){
        $sql = "SELECT * FROM categorie";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $cat){
                echo "<option value=".$cat->categorieID.">".$cat->categorieName."</option>";
            }
        }
    }

    public function getQuestionID(){
        $sql = "SELECT * FROM question";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $question){
                echo "<option value=".$question->questionID.">".$question->questionName."</option>";
            }
        }
    }

    public function getQuestionData($questionID){
        $sql = "SELECT q.questionID, q.questionName, q.questionExemple, q.questionStatus, q.questionType, c.categorieName FROM question q JOIN categorie c ON c.categorieID = q.categorieID WHERE q.questionID = '$questionID'";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
               return $row;
            }
        }
    }

    public function getDataFromSelectedQuestionID($questionID){

    }

    public function fillCategorySelect(){

    }
}