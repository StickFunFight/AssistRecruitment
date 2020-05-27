<?php

require '../functions/datalayer/QuestionairDatabase.php';

class questionairController
{

    private $db;
    private $QuestionairID;

    public function __construct()
    {
        $this->db = new QuestionairDatabase();
    }

    public function setQuestionairID($QID)
    {
        $this->QuestionairID= $QID;
    }

    /**
     * @return mixed
     */
    public function getQuestionairID()
    {
        return $this->QuestionairID;
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