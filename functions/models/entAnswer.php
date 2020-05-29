<?php

class entAnswer
{
    public $answerScore;
    public $answer;
    public $tempID;


    public function __construct($tempID, $answer, $answerScore)
    {
        $this->tempID = $tempID;
        $this->answer = $answer;
        $this->answerScore = $answerScore;
    }

    /**
     * @return mixed
     */
    public function getTempID()
    {
        return $this->tempID;
    }

    /**
     * @param mixed $tempID
     */
    public function setTempID($tempID)
    {
        $this->tempID = $tempID;
    }

    /**
     * @return mixed
     */
    public function getAnswerScore()
    {
        return $this->answerScore;
    }

    /**
     * @param mixed $answerScore
     */
    public function setAnswerScore($answerScore)
    {
        $this->answerScore = $answerScore;
    }

    /**
     * @param mixed $questionID
     *
     * public function setQuestionID($questionID)
     * {
     * $this->questionID = $questionID;
     * }
     * @param mixed $answerID
     *
     * public function setAnswerID($answerID)
     * {
     * $this->answerID = $answerID;
     * }
     *
     * /**
     * @return mixed
     *
     * public function getAnswerID()
     * {
     * return $this->answerID;
     * }
     * @return mixed
     *
     * public function getQuestionID()
     * {
     * return $this->questionID;
     * }
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

}