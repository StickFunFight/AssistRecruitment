<?php

class EntDepartment {
    private $DepartmentID;
    private $DepartmentName;
    private $DepartmentComment;
    private $DepartmentStatus;
    private $CustomerID;

    public function __construct($DepartmentID, $DepartmentName, $DepartmentComment, $DepartmentStatus, $CustomerID) {
        $this->DepartmentID = $DepartmentID;
        $this->DepartmentName = $DepartmentName;
        $this->DepartmentComment = $DepartmentComment;
        $this->DepartmentStatus = $DepartmentStatus;
        $this->CustomerID = $CustomerID;
    }

    public function getDepartmentID() {
        return $this->DepartmentID;
    }

    public function getDepartmentName() {
        return $this->DepartmentName;
    }
 
    public function getdepartmentComment() {
        return $this->DepartmentComment;
    }

    public function getDepartmentStatus() {
        return $this->DepartmentStatus;
    }

    public function getCustomerID() {
        return $this->CustomerID;
    }
} 

?>