<?php

class EntQuestionAnswer
{
    private $questionID;
    private $categorieID;
    private $questionStatus;
    private $questionName;
    private $questionType;
    private $answerID;
    private $answer;

    /**
     * EntQuestionAnswer constructor.
     * @param $questionID
     * @param $categorieID
     * @param $questionStatus
     * @param $questionName
     * @param $questionType
     * @param $answerID
     * @param $answer
     */
    public function __construct($questionID,$categorieID, $questionStatus, $questionName, $questionType, $answerID, $answer)
    {
        $this->questionID = $questionID;
        $this->categorieID = $categorieID;
        $this->questionStatus = $questionStatus;
        $this->questionName = $questionName;
        $this->questionType = $questionType;
        $this->answerID = $answerID;
        $this->answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getQuestionID()
    {
        return $this->questionID;
    }

    /**
     * @return mixed
     */
    public function getCategorieID()
    {
        return $this->categorieID;
    }


    /**
     * @return mixed
     */
    public function getQuestionStatus()
    {
        return $this->questionStatus;
    }

    /**
     * @return mixed
     */
    public function getQuestionName()
    {
        return $this->questionName;
    }

    /**
     * @return mixed
     */
    public function getQuestionType()
    {
        return $this->questionType;
    }

    /**
     * @return mixed
     */
    public function getAnswerID()
    {
        return $this->answerID;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}