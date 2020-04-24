<?php

class EntContact {
    private $ContactID;
    private $ContactName;
    private $ContactPhoneNumber;
    private $ContactEmail;
    private $ContactStatus;
    private $ContactCustomerName;
    private $ContactDepartmentName;

    public function __construct($ContactID, $ContactName, $ContactPhoneNumber, $ContactEmail, $ContactStatus, $ContactCustomerName, $ContactDepartmentName) {
        $this->ContactID = $ContactID;
        $this->ContactName = $ContactName;
        $this->ContactPhoneNumber = $ContactPhoneNumber;
        $this->ContactEmail = $ContactEmail;
        $this->ContactStatus = $ContactStatus;
        $this->ContactCustomerName = $ContactCustomerName;
        $this->ContactDepartmentName = $ContactDepartmentName;
    }

    public function getContactID() {
        return $this->ContactID;
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