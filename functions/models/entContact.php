<?php
class entContact
{
    private $contactID;
    private $contactName;
    private $contactPhonenumber;
    private $contactEmail;
    private $contactComment;
    private $contactStatus;
    private $contactCustomerName;
    private $contactDepartmentName;

    /**
     * entContact constructor.
     * @param $contactID
     * @param $contactName
     * @param $contactPhonenumber
     * @param $contactEmail
     * @param $contactComment
     * @param $contactStatus
     * @param $contactCustomerName
     * @param $contactDepartmentName
     */
    public function __construct($contactID, $contactName, $contactPhonenumber, $contactEmail, $contactComment, $contactStatus, $contactCustomerName, $contactDepartmentName)
    {
        $this->contactID = $contactID;
        $this->contactName = $contactName;
        $this->contactPhonenumber = $contactPhonenumber;
        $this->contactEmail = $contactEmail;
        $this->contactComment = $contactComment;
        $this->contactStatus = $contactStatus;
        $this->contactCustomerName = $contactCustomerName;
        $this->contactDepartmentName = $contactDepartmentName;
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
    public function getContactCustomerName()
    {
        return $this->contactCustomerName;
    }

    /**
     * @return mixed
     */
    public function getContactDepartmentName()
    {
        return $this->contactDepartmentName;
    }


}
?>