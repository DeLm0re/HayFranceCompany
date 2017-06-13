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
    
    protected function selectNomUrlImage()
    {
        $id = intval($this->id_produit);
        $resultat = $this->exeRequete("SELECT image.nom_image, image.url "
                . "FROM produit_image "
                . "INNER JOIN image "
                . "ON produit_image.id_image = image.id_image "
                . "WHERE produit_image.id_produit = $id");
        return $resultat;
    }
}



class Produit extends RequeteProduit
{
    public function __construct(BDD $BDD, $id_produit)
    {
        parent::__construct($BDD, $id_produit);
        $this->hydrate();
    }
    
    public function infos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }
    
    public function getNomImages()
    {
        $noms = NULL;
        $index = 0;
        $resultat = parent::selectNomUrlImage();
        foreach ($resultat as $ligne)
        {
            $noms[$index] = $ligne['nom_image'];
            $index += 1;
        }
        return $noms;
    }
    
    public function getUrlImages()
    {
        $urls = NULL;
        $index = 0;
        $resultat = parent::selectNomUrlImage();
        foreach ($resultat as $ligne)
        {
            $urls[$index] = $ligne['url'];
            $index += 1;
        }
        return $urls;
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


