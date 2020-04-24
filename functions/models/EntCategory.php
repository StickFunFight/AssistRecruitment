<?php
class EntCategory
{
    private $categorieID;
    private $categorieName;
    private $categorieStatus;

    function __construct($categorieID, $categorieName, $categorieStatus)
    {
        $this->categorieID = $categorieID;
        $this->categorieName = $categorieName;
        $this->categorieStatus = $categorieStatus;
    }

    function GetID(){
        return $this->categorieID;
    }

    function GetNaam(){
        return $this->categorieName;
    }

    function GetStatus(){
        return $this->categorieStatus;
    }

    /**
     * @param mixed $categorieID
     */
    public function setCategorieID($categorieID)
    {
        $this->categorieID = $categorieID;
    }

    /**
     * @param mixed $categorieName
     */
    public function setCategorieName($categorieName)
    {
        $this->categorieName = $categorieName;
    }

    /**
     * @param mixed $categorieStatus
     */
    public function setCategorieStatus($categorieStatus)
    {
        $this->categorieStatus = $categorieStatus;
    }
}
