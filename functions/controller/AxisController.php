<?php

require '../functions/datalayer/AxisDatabase.php';

class AxisController
{
    private $db;

    public function __construct()
    {
        $this->db = new AxisDatabase();
    }

    public function GetAxis(){
        $Lijst = $this->db->GetAllAxis();
        var_dump($Lijst);
        return $Lijst;
    }
}