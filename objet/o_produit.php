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
    
    public function getCategories()
    {
        $tab_categories = NULL;
        $index = 0;
        $resultat = parent::selectAnimalProduit();
        foreach ($resultat as $ligne) 
        {
            $tab_categories[$index]['id_categorie'] = $ligne['id_animal'];
            $tab_categories[$index]['nom_categorie'] = $ligne['animal'];
            $index += 1;
        }
        return $tab_categories;
    }
    
    public function appartientCategorie($categorie)
    {
        $appartient = false;
        $categories = $this->getCategories();
        foreach ($categories as $ligne)
        {
            if($categorie === intval($ligne['id_categorie'])
                    || $categorie === $ligne['nom_categorie'])
            {
                $appartient = true;
            }
        }
        return $appartient;
    }
}

