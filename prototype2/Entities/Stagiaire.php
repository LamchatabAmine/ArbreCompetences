<?php

class Stagiaire
{
    private $Id;
    private $Nom;
    private $CNE;
    private $Ville;


    public function getId()
    {
        return $this->Id;
    }
    public function setId($id)
    {
        $this->Id = $id;
    }

    public function getNom()
    {
        return $this->Nom;
    }
    public function setNom($nom)
    {
        $this->Nom = $nom;
    }

    public function getCNE()
    {
        return $this->CNE;
    }
    public function setCNE($CNE)
    {
        $this->CNE = $CNE;
    }

    public function getVille()
    {
        return $this->Ville;
    }
    public function setVille($Ville)
    {
        $this->Ville = $Ville;
    }
}
