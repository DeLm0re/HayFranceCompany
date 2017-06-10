<?php

class Utilisateur
{
    private $id_utilisateur;
    private $panier;
    private $infos_utilisateur;
    
    public function __construct()
    {
        
    }
    
    private function hydrate()
    {
        
    }
    
    public function __set($nom, $valeur)
    {
        $this->infos_utilisateur[$nom] = $valeur;
    }

    public function __get($nom)
    {
        if (isset($this->infos_utilisateur[$nom]))
        {
            return $this->infos_utilisateur[$nom];
        }
        else 
        {    
            return NULL;
        }
    }
    
    public function donneInfos()
    {
        
    }
    
    public function inscrit()
    {
        
    }
    
    public function connecte()
    {
        
    }
    
    public function changeDepartement()
    {
        
    }

    public function ajouteProduitPanier()
    {
        
    }
    
    public function retireProduitPanier()
    {
        
    }
    
    public function videPanier()
    {
        
    }
    
    public function donneContenuPanier()
    {
        
    }
}

