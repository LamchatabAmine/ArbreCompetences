
<?php


class Stagiaire
{
    private $id;
    private $nom;
    private $CNE;
    private $ville;

    function getId()
    {
        return $this->id;
    }
    function setId($id)
    {
        return $this->id = $id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }


    function getCNE()
    {
        return $this->CNE;
    }

    function setCNE($CNE)
    {
        $this->CNE = $CNE;
    }

    function getVille()
    {
        return $this->ville;
    }


    function setVille($ville)
    {
        $this->ville = $ville;
    }
}




?>