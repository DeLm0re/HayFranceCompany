<?php

class ListeProduit extends RequeteListeProduit
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
    }
    
    public function donneListeProduits($categorie = NULL)
    {
        $this->hydrate();
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


class RequeteListeProduit extends Hydratable
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
        $this->hydrate();
    }

    public function hydrate()
    {
        $liste_produits = NULL;
        $index = 0;
        $resultat = $this->exeRequete('SELECT id_produit FROM produit');
        foreach ($resultat as $ligne)
        {
            $produit = new Produit($this->getBDD(), $ligne['id_produit']);
            $liste_produits[$index] = $produit;
            $index += 1;
        }
        $this->_infos = $liste_produits;
    }
}