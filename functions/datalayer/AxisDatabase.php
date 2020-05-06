<?php

class AxisDatabase
{

    private $conn;

    public function __construct()
    {
        require_once 'database.class.php';
        $database = new Database();
        $this->conn = $database->getConnection();

    }
    public function GetAllAxis(){ 
        {
            $lijst = array();
            $query = "SELECT * FROM axis";
            $stm = $this->conn->prepare($query);
            if ($stm->execute()) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $item) {
                    // Hier stonden de entiteit class functies maar hij wilde de database kolom namen
                    $entAxis = new EntAxis($item->AxisId, $item->AxisName, $item->AxisStatus);
                    array_push($lijst, $entAxis);
                }
                return $lijst;

            } else {
                echo "oef foutje";
            }
        }
    }

     function archiveerAxis($Aid){
        //variabele (n) uit de url halen
        $query = "UPDATE axis SET AxisStatus = 'Archived' WHERE AxisId = $Aid";

        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {

        } else echo "oeps";
    }

    function showA($Aid){
        $query = "SELECT * FROM axis WHERE AxisId = $Aid";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            echo $result->AxisName;
        } else echo "oeps";
    }
}
