<?php

class EntCustomer
{
    private $show_customerID;
    private $show_customerName;
    private $show_customerComment;
    private $show_customerReference;
    
    public function __construct(string $show_customerID, string $show_customerName, string $show_customerComment, string $show_customerReference)
    {
        $this->show_customerID = $show_customerID;
        $this->show_customerName = $show_customerName;
        $this->show_customerComment = $show_customerComment;
        $this->show_customerReference = $show_customerReference;
        
    }

    public function getCustomerID() : string
    {
        return $this->show_customerID;
    }

    public function getCustomerName() : string
    {
        return $this->show_customerName;
    }

    public function getCustomerComment() : string
    {
        return $this->show_customerComment;
    }

    public function getCustomerReference() : string
    {
        return $this->show_customerReference;
    }

} 

?>