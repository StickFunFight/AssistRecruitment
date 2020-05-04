<?php

require_once 'database.class.php';

class AxisDatabase{

    private $conn;

    public function __construct(){
    $database = new Database();
    $this->conn = $database->getConnection();

}
    public function AxesOpslaan($AxisName){


        $query = "INSERT INTO axis (AxisName, AxisStatus) VALUES ('$AxisName', 'Active')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){
            
        }

    }


}