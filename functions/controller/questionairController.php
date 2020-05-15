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

    public function setQuestionairID($QName)
    {
        $this->QuestionairID=$this->db->getQuestionairID($QName);
    }

    /**
     * @return mixed
     */
    public function getQuestionairID()
    {
        return $this->QuestionairID;
    }

    public function GetQuestionairList(){
        $Lijst = array();

        $Lijst = $this->db->GetQuestionairList($this->QuestionairID);

        // Returning the list given from the Database class
        return $Lijst;
    }
}