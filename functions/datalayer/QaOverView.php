<?php
require_once 'database.class.php';
require '../functions/models/EntCategory.php';
class QaOverView
{

    public function __construct()
    {

    }

    function GetAllCatergies()
    {
        $database = new Database();
        $db = $database->getConnection();

        $lijst = array();
        $query = "SELECT * FROM categorie where categorieStatus = 'Actief'";
        $stm = $db->prepare($query);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $item) {
                $entCategorie = new EntCategory($item->categorieID, $item->categorieName, $item->categorieStatus);
                array_push($lijst, $entCategorie);
            }
            return $lijst;

        } else {
            echo "oef foutje";
        }
    }
}