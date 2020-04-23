<?php
class entContact
{
    private $contactID;
    private $contactName;
    private $contactPhonenumber;
    private $contactEmail;
    private $contactComment;
    private $contactStatus;
    private $contactCustomerID;
    private $contactUserID;
    
    

    function __contstruct($contactID, $contactName, $contactPhonenumber, $contactEmail, $contactCustomerID, $contactUserID, $contactStatus)
    {
        $this->contactID = $contactID;
        $this->contactName = $contactName;
        $this->contactPhonenumber = $contactPhonenumber;
        $this->contactEmail = $contactEmail;
        $this->
        $this->contactCustomer = $contactCustomerID;
        $this->contactUserID = $contactUserID;
        $this->contactStatus = $contactStatus;
    }

    function getID(){
        return $this->contactID;
    }

    function getName(){
        return $this->contactName;
    }

    function getEmail(){
        return $this->contactEmail;
    }
    
    function getPhonenumber(){
        return $this->contactPhonenumber;
    }

    function getCustomerID(){
        return $this->contactCustomerID;
    }

    function getUserID(){
        return $this->contactUserID;
    }
    
    function getStatus(){
        return $this->contactStatus;
    }

}
?>