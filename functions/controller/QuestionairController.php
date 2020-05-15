<?php

require '../functions/datalayer/QuestionairDatabase.php';





class QuestionairController
{
    private $db;

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


}
