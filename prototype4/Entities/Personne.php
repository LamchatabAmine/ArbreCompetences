<?php

class Personne
{
    protected $nom;
    

    public function __construct($nom)
    {
        // Add error handling for input validation
        

        $this->nom = $nom;
    
    }


    public function getNom()
    {
        return $this->nom;
    }
}

