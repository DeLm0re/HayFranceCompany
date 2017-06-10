<?php

include 'r_liste_produit.php';

class ListeProduit extends RequeteListeProduit
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
    }
    
    public function donneListeProduits($categorie = NULL)
    {
        $index = 0;
        $produits = $this->getInfos();
        foreach ($produits as $produit)
        {
            if($categorie !== NULL && !$produit->appartientCategorie($categorie))
            {
                unset($produits[$index]);
            }
            $index += 1;
        }
        return array_values($produits);
    }
}

