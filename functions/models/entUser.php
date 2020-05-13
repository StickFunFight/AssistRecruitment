<?php
    class entUser {
        private $UserID;
        private $ContactID;
        private $ContactName;
        private $UserPhoneNumber;
        private $UserEmail;
        private $UserComment;
        private $UserStatus;
        private $UserCustomerName;
        private $UserDepartmentName;
        private $UserCustomerID;
        private $userDepartmentID;
        private $userRights;
        private $userBirthDate;
        private $userPassword;
        private $userType;

        public function __construct($UserID, $ContactID, $ContactName, $UserPhoneNumber, $UserEmail, $UserComment, $UserStatus, $UserCustomerName, 
                                    $UserDepartmentName, $UserCustomerID, $userDepartmentID, $userRights, $userBirthDate, $userPassword, $userType) {
            $this->UserID = $UserID;
            $this->ContactID = $ContactID;
            $this->ContactName = $ContactName;
            $this->UserPhoneNumber = $UserPhoneNumber;
            $this->UserEmail = $UserEmail;
            $this->UserComment = $UserComment;
            $this->UserStatus = $UserStatus;
            $this->UserCustomerName = $UserCustomerName;
            $this->UserDepartmentName = $UserDepartmentName;
            $this->UserCustomerID = $UserCustomerID;
            $this->userDepartmentID = $userDepartmentID;
            $this->userRights = $userRights;
            $this->userBirthDate = $userBirthDate;
            $this->userPassword = $userPassword;
            $this->userType = $userType;
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
        public function getUserRights() {
            return $this->userRights;
        }
        
        public function getUserBirthDate() {
            return $this->userBirthDate;
        }

        public function getUserPassword() {
            return $this->userPassword;
        }

        public function getUserType() {
            return $this->userType;
        }
    } 
?>