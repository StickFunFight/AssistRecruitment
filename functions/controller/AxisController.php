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
        $Lijst = array();

        $Lijst = $this->db->GetAllAxis();

        // Returning the list given from the Database class
        return $Lijst;
    }
}