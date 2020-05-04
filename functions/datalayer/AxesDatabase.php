<?php

require_once 'database.class.php';

class AxesDatabase{

    private $conn;

    public function __construct(){
    $database = new Database();
    $this->conn = $database->getConnection();

}



}