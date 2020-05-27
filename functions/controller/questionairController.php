<?php

require '../functions/datalayer/QuestionairDatabase.php';





class QuestionairController
{
    private $db;
    private $QuestionairID;

    public function __construct()
    {
        $this->db = new QuestionairDatabase();
    }

    public function GetQuestionair(){
        $Lijst = array();

        $Lijst = $this->db->GetQuestionair();

        // Returning the list given from the Database class
        return $Lijst;
    }


    /**
     * @return mixed
     */
    public function getQuestionairID()
    {
        return $this->QuestionairID;
    }

    /**
     * @param mixed $QuestionairID
     */
    public function setQuestionairID($QuestionairID)
    {
        $this->QuestionairID = $QuestionairID;
    }

    public function getQuestionairList(){
        $Lijst = array();

        $Lijst = $this->db->GetQuestionairList($this->QuestionairID);

        // Returning the list given from the Database class
        return $Lijst;
    }

    public function getQuestions(){
        $lijst2 = array();

        $lijst2 = $this->db->getQuestions();

        return $lijst2;
    }
}
