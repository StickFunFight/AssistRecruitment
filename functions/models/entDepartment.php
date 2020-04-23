<?php

class EntDepartment
{
    private $show_DepartmentID;
    private $show_DepartmentName;
    private $show_departmentComment;
    private $show_DepartmentStatus;
    private $show_CustomerID;

    public function __construct(string $show_DepartmentID, string $show_DepartmentName, string $show_departmentComment, string $show_DepartmentStatus, string $show_CustomerID)
    {
        $this->show_DepartmentID = $show_DepartmentID;
        $this->show_DepartmentName = $show_DepartmentName;
        $this->show_departmentComment = $show_departmentComment;
        $this->show_DepartmentStatus = $show_DepartmentStatus;
        $this->show_CustomerID = $show_CustomerID;
    }

    public function getDepartmentID() : string
    {
        return $this->show_DepartmentID;
    }

    public function getDepartmentName() : string
    {
        return $this->show_DepartmentName;
    }
 
    public function getdepartmentComment() : string
    {
        return $this->show_departmentComment;
    }

    public function getDepartmentStatus() : string
    {
        return $this->show_DepartmentStatus;
    }

    public function getCustomerID() : string
    {
        return $this->show_CustomerID;
    }
} 

?>