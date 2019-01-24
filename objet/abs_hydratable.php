<?php

abstract class Hydratable
{
    private $BDD;
    protected $_infos;
    
    public function __construct(BDD $BDD)
    {
        $this->BDD = $BDD;
    }
 
    public function __set($nom, $valeur)
    {
        $this->_infos[$nom] = $valeur;
    }

    public function __get($nom)
    {
        if (isset($this->_infos[$nom]))
        {
            return $this->_infos[$nom];
        }
        else 
        {
            return NULL;
        }
    }
    
    protected function getInfos()
    {
        return $this->_infos;
    }
    
    protected function getBDD()
    {
        return $this->BDD;
    }
    
    protected function hydrateInfos($resultat)
    {   
        foreach($resultat as $ligne)
        {
            $cles = array_keys($ligne);
            /*
            0 => string 'id_produit' (length=10)
            1 => string 'nom_produit' (length=11)
            2 => string 'description' (length=11)
            3 => string 'description_rapide' (length=18)
            4 => string 'prix_tonne' (length=10)
            */
            $this->id_produit = $ligne[$cles[0]];
            $this->nom_produit = $ligne[$cles[1]];
            $this->description = $ligne[$cles[2]];
            $this->description_rapide = $ligne[$cles[3]];
            $this->prix_tonne = $ligne[$cles[4]];
        }   
    }
    
    protected function exeRequete($requete)
    {
        return $this->BDD->exe_requete($requete);
    }
    
    protected function bindRequete($requete, $param)
    {
        return $this->BDD->bind_requete($requete, $param);
    }

    abstract public function hydrate();

}

