<?php

require_once 'database.class.php';

class CategoryDatabase{

    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();

    }


    public function catOpslaan($categorieNaam){


        $query = "INSERT INTO categorie (categorieName, categorieStatus) VALUES ('$categorieNaam', 'Active')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){
            Header("Location: Qa.php");
        }

    }

    public function catAanpassen($categorieNaam, $categorieStatus, $customerID){
        $query = sprintf("UPDATE categorie SET categorieName = '%s',
                                       categorieStatus= '%s'
                                       WHERE categorieID = %d", $categorieNaam, $categorieStatus, $customerID);
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){

        }
    }

}
