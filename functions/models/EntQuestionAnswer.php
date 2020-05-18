<?php

class EntQuestionAnswer
{
    private $answerScore;
    private $questionID;
    private $answerID;
    private $answer;

    public function __construct($answer, $answerScore)
    {
        $this->answer = $answer;
        $this->answerScore = $answerScore;
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
     * @return mixed
     */
    public function getQuestionID()
    {
        return $this->questionID;
    }

    /**
     * @param mixed $questionID
     */
    public function setQuestionID($questionID)
    {
        $this->questionID = $questionID;
    }

    /**
     * @return mixed
     */
    public function getAnswerID()
    {
        return $this->answerID;
    }

    /**
     * @param mixed $answerID
     */
    public function setAnswerID($answerID)
    {
        $this->answerID = $answerID;
    }

    /**
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