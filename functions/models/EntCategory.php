<?php
class EntCategory
{
    private $categorieID;
    private $categorieName;
    private $categorieStatus;

    function __construct($categorieID, $categorieName, $categorieStatus)
    {
        $this->ID = $categorieID;
        $this->Name = $categorieName;
        $this->Status = $categorieStatus;

    }
    function GetID(){
        return $this->ID;
    }

    function GetNaam(){
        return $this->Name;
    }

    function GetStatus(){
        return $this->Status;
    }
}
