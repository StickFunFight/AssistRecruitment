<?php

class EntContact {
    private $UserID;
    private $ContactID;
    private $ContactName;
    private $UserPhoneNumber;
    private $UserEmail;
    private $UserComment;
    private $UserStatus;
    private $ContactBirth;
    private $UserCustomerName;
    private $UserDepartmentName;
    private $UserCustomerID;
    private $userDepartmentID;
    private $userDepartmentComment;

    public function __construct($UserID, $ContactID, $ContactName, $UserPhoneNumber, $UserEmail, $UserComment, $UserStatus, $ContactBirth, $UserCustomerName, $UserDepartmentName, $UserCustomerID, $userDepartmentID, $userDepartmentComment) {
        $this->UserID = $UserID;
        $this->ContactID = $ContactID;
        $this->ContactName = $ContactName;
        $this->UserPhoneNumber = $UserPhoneNumber;
        $this->UserEmail = $UserEmail;
        $this->UserComment = $UserComment;
        $this->UserStatus = $UserStatus;
        $this->ContactBirth = $ContactBirth;
        $this->UserCustomerName = $UserCustomerName; 
        $this->UserDepartmentName = $UserDepartmentName;
        $this->UserCustomerID = $UserCustomerID;
        $this->userDepartmentID = $userDepartmentID;
        $this->userDepartmentComment = $userDepartmentComment;
    }

    public function getUserID() {
        return $this->UserID;
    }

    public function getContactID() {
        return $this->ContactID;
    }

    public function getContactName() {
        return $this->ContactName;
    }

    public function getUserPhoneNumber() {
        return $this->UserPhoneNumber;
    }

    public function getUserEmail() {
        return $this->UserEmail;
    }

    public function getUserComment() {
        return $this->UserComment;
    }

    public function getUserStatus() {
        return $this->UserStatus;
    }

    public function getContactBirth() {
        return $this->ContactBirth;
    }

    public function getUserCustomerName() {
        return $this->UserCustomerName;
    }

    public function getUserDepartmentName() {
        return $this->UserDepartmentName;
    }

    public function getUserCustomerID() {
        return $this->UserCustomerID;
    }

    public function getuserDepartmentID() {
        return $this->userDepartmentID;
    }

    public function getuserDepartmentComment() {
        return $this->userDepartmentComment;
    }

} 

?>