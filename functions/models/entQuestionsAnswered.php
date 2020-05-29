<?php

class entQuestionAnswered {
    private $QuestionID;
    private $AnswerID;
    private $AnswerName;
    private $AnswerScore;

    public function __construct($QuestionID, $AnswerID, $AnswerName, $AnswerScore) {
        $this->QuestionID = $QuestionID;
        $this->AnswerID = $AnswerID;
        $this->AnswerName = $AnswerName;
        $this->AnswerScore = $AnswerScore;
    }

    public function getQuestionID() {
        return $this->QuestionID;
    }

    public function getAnswerID() {
        return $this->AnswerID;
    }

    public function getAnswerName() {
        return $this->AnswerName;
    }

    public function getAnswerScore() {
        return $this->AnswerScore;
    }
} 

?>