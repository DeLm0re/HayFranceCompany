<?php

include 'r_produit.php';

class Produit extends RequeteProduit
{
    public function __construct(BDD $BDD, $id_produit)
    {
        parent::__construct($BDD, $id_produit);
        $this->hydrate();
    }
    
    public function getInfos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }
}

