<?php
require_once 'database.class.php';

class QA_QuestionAddClass
{

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setQuestion($categorieID, $questionname, $questionExemple, $questionStatus, $questionType)
    {

        $sql = "INSERT INTO question (categorieID, questionname, questionExemple, questionStatus, questionType) VALUES ($categorieID, $questionname, $questionExemple, $questionStatus, $questionType)";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(":categorieID", $categorieID, PDO::PARAM_INT);
        $stm->bindParam(":questionname", $questionname, PDO::PARAM_STR);
        $stm->bindParam(":questionExemple", $questionExemple, PDO::PARAM_STR);
        $stm->bindParam(":questionStatus", $questionStatus, PDO::PARAM_STR);
        $stm->bindParam(":questionType", $questionType, PDO::PARAM_STR);

        $stm->execute();
    }
}

