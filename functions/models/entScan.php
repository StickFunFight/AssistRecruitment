<?php

class EntScan {
    private $ScanID;
    private $ScanName;
    private $ScanComment;
    private $ScanStatus;
    private $ScanIntroductionText;
    private $ScanReminderText;
    private $ScanStartDate;
    private $ScanEndDate;
    private $CustomerName;
    private $CustomerID;
    private $DepartmentID;
    private $UserID;

    public function __construct($ScanID, $ScanName, $ScanComment, $ScanStatus, $ScanIntroductionText, $ScanReminderText, $ScanStartDate, $ScanEndDate, $CustomerName, $CustomerID, $DepartmentID, $UserID) {
        $this->ScanID = $ScanID;
        $this->ScanName = $ScanName;
        $this->ScanComment = $ScanComment;
        $this->ScanStatus = $ScanStatus;
        $this->ScanIntroductionText = $ScanIntroductionText;
        $this->ScanReminderText = $ScanReminderText;
        $this->ScanStartDate = $ScanStartDate;
        $this->ScanEndDate = $ScanEndDate;
        $this->CustomerName = $CustomerName;
        $this->CustomerID = $CustomerID;
        $this->DepartmentID = $DepartmentID;
        $this->UserID = $UserID;
    }

    public function getScanID() {
        return $this->ScanID;
    }

    public function getScanName() {
        return $this->ScanName;
    }

    public function getScanComment() {
        return $this->ScanComment;
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

    public function getScanCustomerName() {
        return $this->CustomerName;
    }

    public function getCustomerID() {
        return $this->CustomerName;
    }
    
    public function getDepartmentID() {
        return $this->CustomerName;
    }

    public function getUserID() {
        return $this->CustomerName;
    }
} 

?>