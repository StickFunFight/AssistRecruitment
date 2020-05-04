<?php

require_once 'database.class.php';

class AxisDatabase
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();

    }
    public function GetAllAxis(){
        {
            $lijst = array();
            $query = "SELECT * FROM axis";
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $item) {
                    $entAxis = new EntAxis($item->getAxisId, $item->getAxisname, $item->getAxisStatus);
                    array_push($lijst, $entAxis);
                }
                return $lijst;

            } else {
                echo "oef foutje";
            }
        }
    }

}