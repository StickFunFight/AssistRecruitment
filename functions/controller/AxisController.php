<?php

require '../datalayer/AxisDatabase.php';

class AxisController
{
    private $db;

    public function __construct()
    {
        $this->db = new AxisDatabase();
    }

    public function GetAxis(){
        $Lijst = $this->db->GetAllAxis();
        return $Lijst;
    }
}