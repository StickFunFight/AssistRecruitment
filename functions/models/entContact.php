<?php

class EntContact {
    private $UserID;
    private $ContactName;
    private $ContactPhoneNumber;
    private $ContactEmail;
    private $ContactStatus;
    private $ContactCustomerName;
    private $ContactDepartmentName;

    public function __construct($UserID, $ContactName, $ContactPhoneNumber, $ContactEmail, $ContactStatus, $ContactCustomerName, $ContactDepartmentName) {
        $this->UserID = $UserID;
        $this->ContactName = $ContactName;
        $this->ContactPhoneNumber = $ContactPhoneNumber;
        $this->ContactEmail = $ContactEmail;
        $this->ContactStatus = $ContactStatus;
        $this->ContactCustomerName = $ContactCustomerName;
        $this->ContactDepartmentName = $ContactDepartmentName;
    }

    public function getUserID() {
        return $this->UserID;
    }

    public function getContactName() {
        return $this->ContactName;
    }
 
    public function getContactPhoneNumber() {
        return $this->ContactPhoneNumber;
    }

    public function getContactEmail() {
        return $this->ContactEmail;
    }

    public function getContactStatus() {
        return $this->ContactStatus;
    }

    public function getContactCustomerName() {
        return $this->ContactCustomerName;
    }

    public function getContactDepartmentName() {
        return $this->ContactDepartmentName;
    }
} 

?>