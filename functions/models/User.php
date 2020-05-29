<?php


class User {

    private $userId;
    private $username;
    private $userEmail;
    private $userPassword;
    private $userRight;
    private $userStatus;

    public function __construct($userId, $username, $userEmail, $userPassword, $userRight, $userStatus) {
        $this->userId = $userId;
        $this->username = $username;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
        $this->userRight = $userRight;
        $this->userStatus = $userStatus;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUserEmail() {
        return $this->userEmail;
    }

    public function setUserEmail($userEmail) {
        $this->userEmail = $userEmail;
    }

    public function getUserPassword() {
        return $this->userPassword;
    }

    public function setUserPassword($userPassword) {
        $this->userPassword = $userPassword;
    }

    public function getUserRight() {
        return $this->userRight;
    }

    public function setUserRight($userRight) {
        $this->userRight = $userRight;
    }

    public function getUserStatus() {
        return $this->userStatus;
    }

    public function setUserStatus($userStatus) {
        $this->userStatus = $userStatus;
    }

}