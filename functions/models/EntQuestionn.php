<?php

class EntQuestionn {

    private $questionID;
    private $categorieID;
    private $questionName;
    private $questionExemple;
    private $questionStatus;
    private $questionType;

    public function __construct(string $questionID, string $categorieID, string $questionName, string $questionExemple, string $questionStatus, string $questionType) {
        $this->questionID = $questionID;
        $this->categorieID = $categorieID;
        $this->questionName = $questionName;
        $this->questionExemple = $questionExemple;
        $this->questionStatus = $questionStatus;
        $this->questionType = $questionType;

    }

    /**
     * @return string
     */
    public function getQuestionID(): string {
        return $this->questionID;
    }

    /**
     * @return string
     */
    public function getCategorieID(): string {
        return $this->categorieID;
    }

    /**
     * @return string
     */
    public function getQuestionName(): string {
        return $this->questionName;
    }

    /**
     * @return string
     */
    public function getQuestionExemple(): string {
        return $this->questionExemple;
    }

    /**
     * @return string
     */
    public function getQuestionStatus(): string {
        return $this->questionStatus;
    }

    /**
     * @return string
     */
    public function getQuestionType(): string {
        return $this->questionType;
    }
}