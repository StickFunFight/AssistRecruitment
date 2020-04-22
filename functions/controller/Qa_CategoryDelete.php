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

    function DeleteQaCategory($cID)
    {

        $query = "SELECT categorieStatus FROM categorie WHERE categorieID = $id";
            if (actief)
            {
                $stm = $this->db->prepare($query);
                if($stm->execute())
                {
                    Header("Location:Qa_CategoryDelete");
                    //  $query = "DELETE FROM categorie WHERE categorieID = $cID";
                }
                else
                {
                    echo"YOU FUCKED UP SOMWHERE";
                }
            }
            else
            {
                echo "nog niks";
            }

    }
}
?>


