<?php
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

        $query = "SELECT scanStatus FROM scan 
                  JOIN scan_question ON scan_question.scanID = scan.scanID
                  JOIN question ON question.questionID = scan_question.questionID
                  WHERE question.categorieID = '$cID' " ;
        $stm = $this->db->prepare($query);
        if($stm->execute())
        {
            $result = $stm->fetchAll(PDO::FETCH_ALL);
            foreach($result as $status)
            {
                echo $status;
                if($status == "actief")
                {
                    echo "Er is een scan actief waarin deze categorie gebruikt wordt";
                }
                else
                {
                    $query = "SELECT questionStatus from question WHERE categorieID = $cID";
                    $stm = $this->db->prepare($query);
                    if($stm->execute())
                    {
                        $result = $stm->fetchAll(PDO::FETCH_ALL);
                        foreach($result as $status)
                        {
                            echo $status;
                            if ($status == "actief")
                            {

                            }
                            else
                            {
                                $query = "UPDATE category SET categorieStatus = 'deleted' WHERE categoryID = '$cID'";
                                $stm = $this->db->prepare($query);
                                if($stm->execute())
                                {
                                    echo "Categorie op 'deleted' gezet";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>