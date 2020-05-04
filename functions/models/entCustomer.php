<?php

class EntCustomer {
    private $CustomerID;
    private $CustomerName;
    private $CustomerComment;
    private $CustomerRefrence;
    private $CustomerStatus;

    public function __construct($CustomerID, $CustomerName, $CustomerComment, $CustomerRefrence, $CustomerStatus) {
        $this->CustomerID = $CustomerID;
        $this->CustomerName = $CustomerName;
        $this->CustomerComment = $CustomerComment;
        $this->CustomerRefrence = $CustomerRefrence;
        $this->CustomerStatus = $CustomerStatus;
    }

    public function getCustomerID() {
        return $this->CustomerID;
    }

    public function getCustomerName() {
        return $this->CustomerName;
    }
 
    public function getCustomerComment() {
        return $this->CustomerComment;
    }

    public function getCustomerRefrence() {
        return $this->CustomerRefrence;
    }

    public function getCustomerStatus() {
        return $this->CustomerStatus;
    }
} 

?>