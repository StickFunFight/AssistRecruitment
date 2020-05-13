<?php

require_once 'database.class.php';

class CategoryDatabase
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();

    }

    public function catOpslaan($categorieNaam)
    {
        $catStatus = 'Active';
        $query = "INSERT INTO categorie (categorieName, categorieStatus) VALUES (? ,?)";
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $categorieNaam);
        $stm->bindParam(2, $catStatus);
        if ($stm->execute()) {
        }

    }

    public function catAanpassen($categorieNaam, $categorieStatus, $customerID)
    {
        $query = sprintf("UPDATE categorie SET categorieName = ?,
                                       categorieStatus= ?
                                       WHERE categorieID = ?");
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $categorieNaam);
        $stm->bindParam(2, $categorieStatus);
        $stm->bindParam(3, $customerID);
        if ($stm->execute()) {

        }
    }

    function checkScan($cID)
    {
        $query =sprintf("SELECT scanStatus FROM scan 
                  JOIN scan_question ON scan_question.scanID = scan.scanID
                  JOIN question ON question.questionID = scan_question.questionID
                  WHERE question.categorieID = ?");
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $cID);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            $count = 0;
            foreach ($result as $item) {
                $count++;
            }
            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    function checkQuestion($cID)
    {
        $query =sprintf("SELECT questionStatus from question WHERE categorieID = ?");
        $stm = $this->conn->prepare($query);
        $stm->bindParam(1, $cID);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            $count = 0;
            foreach ($result as $status) {
                $count++;
            }
            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        }

    }

    function DeleteQaCategory($cID)
    {
        if ($this->checkScan($cID) == false) {
            if ($this->checkQuestion($cID)==false) {
                $query = sprintf("UPDATE categorie SET categorieStatus = 'Archived' WHERE categorieID = ?");
                $stm = $this->conn->prepare($query);
                $stm->bindParam(1, $cID);
                if ($stm->execute()) {
                    echo "Categorie op 'deleted' gezet";
                }
            }else{
                echo "Er zijn vragen met de status 'Active' die bij deze categorie horen!";
            }
        }else{
            echo "Er zijn scans met de status Actief die gebruik maken van deze categorie!";
        }
    }
}
