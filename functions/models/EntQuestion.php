<?php

class EntQuestion
{
    private $questionID;
    private $categorieID;
    private $AxisID;
    private $questionName;
    private $questionExample;
    private $questionStatus;
    private $questionType;

    /**
     * EntQuestion constructor.
     * @param $questionID
     * @param $caegorieID
     * @param $AxisID
     * @param $questionName
     * @param $questionExample
     * @param $questionStatus
     * @param $questionType
     */
    public function __construct($questionID, $categorieID, $AxisID, $questionName, $questionExample, $questionStatus, $questionType)
    {
        $this->questionID = $questionID;
        $this->categorieID = $categorieID;
        $this->AxisID = $AxisID;
        $this->questionName = $questionName;
        $this->questionExample = $questionExample;
        $this->questionStatus = $questionStatus;
        $this->questionType = $questionType;
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
    public function getCaegorieID()
    {
        return $this->caegorieID;
    }

    /**
     * @param mixed $caegorieID
     */
    public function setCaegorieID($caegorieID)
    {
        $this->caegorieID = $caegorieID;
    }

    /**
     * @return mixed
     */
    public function getAxisID()
    {
        return $this->AxisID;
    }

    /**
     * @param mixed $AxisID
     */
    public function setAxisID($AxisID)
    {
        $this->AxisID = $AxisID;
    }

    /**
     * @return mixed
     */
    public function getQuestionName()
    {
        return $this->questionName;
    }

    /**
     * @param mixed $questionName
     */
    public function setQuestionName($questionName)
    {
        $this->questionName = $questionName;
    }

    /**
     * @return mixed
     */
    public function getQuestionExample()
    {
        return $this->questionExample;
    }

    /**
     * @param mixed $questionExample
     */
    public function setQuestionExample($questionExample)
    {
        $this->questionExample = $questionExample;
    }

    /**
     * @return mixed
     */
    public function getQuestionStatus()
    {
        return $this->questionStatus;
    }

    /**
     * @param mixed $questionStatus
     */
    public function setQuestionStatus($questionStatus)
    {
        $this->questionStatus = $questionStatus;
    }

    /**
     * @return mixed
     */
    public function getQuestionType()
    {
        return $this->questionType;
    }

    /**
     * @param mixed $questionType
     */
    public function setQuestionType($questionType)
    {
        $this->questionType = $questionType;
    }
}