<?php

class EntQuestionair {
    private $QuestionairID;
    private $QuestionairName;
    private $QuestionairComment;
    private $QuestionairStatus;

    public function __construct($QuestionairID, $QuestionairName, $QuestionairComment, $QuestionairStatus) {
        $this->QuestionairID = $QuestionairID;
        $this->QuestionairName = $QuestionairName;
        $this->QuestionairComment = $QuestionairComment;
        $this->QuestionairStatus = $QuestionairStatus;
    }

    public function getQuestionairID() {
        return $this->QuestionairID;
    }

    public function getQuestionairName() {
        return $this->QuestionairName;
    }
 
    public function getQuestionairComment() {
        return $this->DepartmentComment;
    }

    public function getQuestionairStatus() {
        return $this->QuestionairStatus;
    }
} 

?>