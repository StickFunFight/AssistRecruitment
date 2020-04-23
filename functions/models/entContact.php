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

    /**
     * entContact constructor.
     * @param $contactID
     * @param $contactName
     * @param $contactPhonenumber
     * @param $contactEmail
     * @param $contactComment
     * @param $contactStatus
     * @param $contactCustomerID
     * @param $contactUserID
     */
    public function __construct($contactID, $contactName, $contactPhonenumber, $contactEmail, $contactComment, $contactStatus, $contactCustomerID, $contactUserID)
    {
        $this->contactID = $contactID;
        $this->contactName = $contactName;
        $this->contactPhonenumber = $contactPhonenumber;
        $this->contactEmail = $contactEmail;
        $this->contactComment = $contactComment;
        $this->contactStatus = $contactStatus;
        $this->contactCustomerID = $contactCustomerID;
        $this->contactUserID = $contactUserID;
    }


    /**
     * @return mixed
     */
    public function getContactID()
    {
        return $this->contactID;
    }

    /**
     * @return mixed
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @return mixed
     */
    public function getContactPhonenumber()
    {
        return $this->contactPhonenumber;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @return mixed
     */
    public function getContactComment()
    {
        return $this->contactComment;
    }

    /**
     * @return mixed
     */
    public function getContactStatus()
    {
        return $this->contactStatus;
    }

    /**
     * @return mixed
     */
    public function getContactCustomerID()
    {
        return $this->contactCustomerID;
    }

    /**
     * @return mixed
     */
    public function getContactUserID()
    {
        return $this->contactUserID;
    }


}
?>