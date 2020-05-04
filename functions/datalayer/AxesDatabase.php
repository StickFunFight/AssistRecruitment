<?php

require_once 'database.class.php';

class AxesDatabase{

    private $conn;

    public function __construct(){
    $database = new Database();
    $this->conn = $database->getConnection();

}
    public function AxesOpslaan($AxisName){


        $query = "INSERT INTO Axis (AxisName, AxisStatus) VALUES ('$AxisName', 'Active')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){
            Header("Location: Qa.php");
        }

    }


}