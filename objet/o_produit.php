<?php

include 'r_produit.php';

class Produit extends RequeteProduit
{
    public function __construct(BDD $BDD, $id_produit)
    {
        parent::__construct($BDD, $id_produit);
    }
    
    public function donneInfos()
    {
        $this->hydrate();
        return $this->_infos; 
    }
}

