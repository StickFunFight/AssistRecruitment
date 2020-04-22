<?php
require '../functions/models/EntCategory.php';
class QaOverView
{
    private $db;

    public function __construct()
    {
        require_once '../functions/datalayer/database.class.php';
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function GetAllCatergies()
    {
        $lijst = array();
        $query = "SELECT * FROM categorie where categorieStatus = 'Actief'";
        $stm = $this->db->prepare($query);
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