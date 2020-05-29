<?php


class EntQuestionair
{

    public $questionairID;
    public $questionairName;
    private $questionairComment;
    private $questionairStatus;

    /**
     * EntQuestionair constructor.
     * @param $questionairID
     * @param $questionairName
     * @param $questionairStatus
     */

    public function __construct($questionairID, $questionairName, $questionairComment, $questionairStatus)
    {
        $this->questionairID = $questionairID;
        $this->questionairName = $questionairName;
        $this->questionairComment = $questionairComment;
        $this->questionairStatus = $questionairStatus;
    }

    /**
     * @return mixed
     */
    public function getQuestionairID()
    {
        return $this->questionairID;
    }

    /**
     * @param mixed $questionairID
     */
    public function setQuestionairID($questionairID)
    {
        $this->questionairID = $questionairID;
    }

    /**
     * @return mixed
     */
    public function getQuestionairName()
    {
        return $this->questionairName;
    }

    /**
     * @param mixed $questionairName
     */
    public function setQuestionairName($questionairName)
    {
        $this->questionairName = $questionairName;
    }

    /**
     * @return mixed
     */


    public function getQuestionairComment()
    {
        return $this->questionairComment;
    }

    /**
     * @param mixed $questionairComment
     */
    public function setQuestionairComment($questionairComment)
    {
        $this->questionairComment = $questionairComment;
    }

    /**
     * @return mixed
     */

    public function getQuestionairStatus()
    {
        return $this->questionairStatus;
    }

    /**
     * @param mixed $questionairStatus
     */
    public function setQuestionairStatus($questionairStatus)
    {
        $this->questionairStatus = $questionairStatus;
    }


}



