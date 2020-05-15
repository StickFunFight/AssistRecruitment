<?php

class EntQuestionair{

    private $id;
    private $Name;
    private $Comment;
    private $Status;

    /**
     * EntQuestionair constructor.
     * @param $id
     * @param $Name
     * @param $Comment
     * @param $Status
     */
    public function __construct($id, $Name, $Comment, $Status)
    {
        $this->id = $id;
        $this->Name = $Name;
        $this->Comment = $Comment;
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     * @param mixed $Comment
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }


}
