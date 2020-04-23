<?php

class EntContact
{
    private $show_ContactID;
    private $show_ContactName;
    private $show_ContactPhoneNumber;
    private $show_ContactEmail;
    private $show_ContactStatus;
    private $show_ContactCustomerName;
    private $show_ContactDepartmentName;

    public function __construct(string $show_ContactID, string $show_ContactName, string $show_ContactPhoneNumber, string $show_ContactEmail, string $show_ContactStatus, string $show_ContactCustomerName, string $show_ContactDepartmentName)
    {
        $this->show_ContactID = $show_ContactID;
        $this->show_ContactName = $show_ContactName;
        $this->show_ContactPhoneNumber = $show_ContactPhoneNumber;
        $this->show_ContactEmail = $show_ContactEmail;
        $this->show_ContactStatus = $show_ContactStatus;
        $this->show_ContactCustomerName = $show_ContactCustomerName;
        $this->show_ContactDepartmentName = $show_ContactDepartmentName;
    }

    public function getContactID() : string
    {
        return $this->show_ContactID;
    }

    public function getContactName() : string
    {
        return $this->show_ContactName;
    }
 
    public function getContactPhoneNumber() : string
    {
        return $this->show_ContactPhoneNumber;
    }

    public function getContactEmail() : string
    {
        return $this->show_ContactEmail;
    }

    public function getContactStatus() : string
    {
        return $this->show_ContactStatus;
    }

    public function getContactCustomerName()
    {
        return $this->show_ContactCustomerName;
    }

    public function getContactDepartmentName()
    {
        return $this->show_ContactDepartmentName;
    }
} 

?>