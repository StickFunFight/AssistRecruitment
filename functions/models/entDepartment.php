<?php

class EntDepartment {
    private $DepartmentID;
    private $DepartmentName;
    private $DepartmentComment;
    private $DepartmentStatus;
    private $CustomerID;
    private $CustomerName;

    public function __construct($DepartmentID, $DepartmentName, $DepartmentComment, $DepartmentStatus, $CustomerID, $CustomerName) {
        $this->DepartmentID = $DepartmentID;
        $this->DepartmentName = $DepartmentName;
        $this->DepartmentComment = $DepartmentComment;
        $this->DepartmentStatus = $DepartmentStatus;
        $this->CustomerID = $CustomerID;
        $this->CustomerName = $CustomerName;
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

    public function getCustomerName() {
        return $this->CustomerName;
    }
} 

?>