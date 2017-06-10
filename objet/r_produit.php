<?php

abstract class RequeteProduit extends Hydratable
{  
    private $id_produit;
    
    public function __construct(BDD $BDD, $id_produit)
    {
        parent::__construct($BDD);
        $this->id_produit = $id_produit;
    }

    public function hydrate()
    {
        $id = intval($this->id_produit);
        $resultat = $this->exeRequete("SELECT * FROM produit "
                . "WHERE id_produit = $id");
        parent::hydrateInfos($resultat);
    }
}

