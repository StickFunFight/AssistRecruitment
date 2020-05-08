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
        $query = "INSERT INTO categorie (categorieName, categorieStatus) VALUES ('$categorieNaam', 'Active')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {
            Header("Location: Qa.php");
        }

    }

    public function catAanpassen($categorieNaam, $categorieStatus, $customerID)
    {
        $query = sprintf("UPDATE categorie SET categorieName = '%s',
                                       categorieStatus= '%s'
                                       WHERE categorieID = %d", $categorieNaam, $categorieStatus, $customerID);
        $stm = $this->conn->prepare($query);
        if ($stm->execute()) {

        }
    }

    function checkScan($cID)
    {
        $query = "SELECT scanStatus FROM scan 
                  JOIN scan_question ON scan_question.scanID = scan.scanID
                  JOIN question ON question.questionID = scan_question.questionID
                  WHERE question.categorieID = $cID";
        $stm = $this->conn->prepare($query);
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
        $query = "SELECT questionStatus from question WHERE categorieID = $cID";
        $stm = $this->conn->prepare($query);
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
                $query = "UPDATE categorie SET categorieStatus = 'Archived' WHERE categorieID = $cID";
                $stm = $this->conn->prepare($query);
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
