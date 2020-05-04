<?php

require_once 'database.class.php';

class AxisDatabase{

    private $conn;

    public function __construct(){
    $database = new Database();
    $this->conn = $database->getConnection();

}
    public function AxisOpslaan($AxisName){


        $query = "INSERT INTO axis (AxisName, AxisStatus) VALUES ('$AxisName', 'Active')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){

        }

    }

    public function AxisAanpassen($AxisName, $AxisStatus, $AxisID){
        $query = sprintf("UPDATE axis SET AxisName = '$AxisName',
                                       AxisStatus= '$AxisStatus'
                                       WHERE AxisID = $AxisID");
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){

        }
    }


}