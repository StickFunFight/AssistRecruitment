<?php


class User {

    private $userId;
    private $username;
    private $userEmail;
    private $userPassword;
    private $isAdmin;
    private $userStatus;

    public function __construct($userId, $username, $userEmail, $userPassword, $isAdmin, $userStatus)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
        $this->isAdmin = $isAdmin;
        $this->userStatus = $userStatus;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function getUserStatus()
    {
        return $this->userStatus;
    }

    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

}