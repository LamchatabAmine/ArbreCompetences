<?php
class Competence
{
    private $Id;
    private $Reference;
    private $Code;
    private $Nom;
    private $Description;

    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getReference()
    {
        return $this->Reference;
    }

    public function setReference($Reference)
    {
        $this->Reference = $Reference;
    }

    public function getCode()
    {
        return $this->Code;
    }

    public function setCode($Code)
    {
        $this->Code = $Code;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }
}
