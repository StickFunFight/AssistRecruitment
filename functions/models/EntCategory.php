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
}
