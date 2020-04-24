<?php

class EntScan {
    private $ScanID;
    private $ScanName;
    private $ScanStatus;
    private $ScanIntroductionText;
    private $ScanReminderText;
    private $ScanStartDate;
    private $ScanEndDate;

    public function __construct($ScanID, $ScanName, $ScanStatus, $ScanIntroductionText, $ScanReminderText, $ScanStartDate, $ScanEndDate) {
        $this->ScanID = $ScanID;
        $this->ScanName = $ScanName;
        $this->ScanStatus = $ScanStatus;
        $this->ScanIntroductionText = $ScanIntroductionText;
        $this->ScanReminderText = $ScanReminderText;
        $this->ScanStartDate = $ScanStartDate;
        $this->ScanEndDate = $ScanEndDate;
    }

    public function getScanID() {
        return $this->ScanID;
    }

    public function getScanName() {
        return $this->ScanName;
    }
 
    public function getScanStatus() {
        return $this->ScanStatus;
    }

    public function getScanIntroductionText() {
        return $this->ScanIntroductionText;
    }

    public function getScanReminderText() {
        return $this->ScanReminderText;
    }

    public function getScanStartDate() {
        return $this->ScanStartDate;
    }

    public function getScanEndDate() {
        return $this->ScanEndDate;
    }
} 

?>