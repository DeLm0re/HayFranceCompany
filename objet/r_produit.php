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
    
    protected function selectAnimalProduit()
    {
        $id = intval($this->id_produit);
        $resultat = $this->exeRequete("SELECT animal_produit.id_animal, "
                . "animal.animal FROM animal_produit "
                . "INNER JOIN animal "
                . "ON animal_produit.id_animal = animal.id_animal "
                . "WHERE animal_produit.id_produit = $id");
        return $resultat;
    }
}

