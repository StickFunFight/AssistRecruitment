<?php

class entAnswerScore
{
    private $AnswerID;
    private $AnswerScore;
    private $QuestionID;
    private $QuestionName;

    public function __construct($AnswerID, $AnswerScore, $QuestionID, $QuestionName)
    {
        $this->AnswerID = $AnswerID;
        $this->AnswerScore = $AnswerScore;
        $this->QuestionID = $QuestionID;
        $this->QuestionName = $QuestionName;
    }

    public function getAnswerID()
    {
        return $this->AnswerID;
    }

    public function getAnswerScore()
    {
        return $this->AnswerScore;
    }

    public function getQuestionID()
    {
        return $this->QuestionID;
    }

    public function getQuestionName()
    {
        return $this->QuestionName;
    }

}

?>