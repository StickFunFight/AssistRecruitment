<?php

require_once 'database.class.php';

class AxisDatabase{

    private $conn;

    public function __construct(){
    $database = new Database();
    $this->conn = $database->getConnection();

}
    function archiveerAxis($Aid){
        //variabele (n) uit de url halen
        $query = "UPDATE axis SET AxisStatus = 'Archived' WHERE AxisId = $Aid";

        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {

        } else echo "oeps";
    }

    function showQ($Aid){
        $query = "SELECT * FROM axis WHERE AxisId = '$Aid'";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            echo $result->AxisName;
        } else echo "oeps";
    }




}