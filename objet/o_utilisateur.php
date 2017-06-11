<?php

include 'r_utilisateur.php';

class Utilisateur extends RequeteUtilisateur
{
    const HORS_CONNEXION = -1;
    
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD, self::HORS_CONNEXION);
    }
    
    public function getInfos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }


    public function donneInfos()
    {
        
    }
    
    public function inscrit($nom, $prenom, $civilite, $email, $password, $ville, $adresse, $departement)
    {
        parent::inscription($nom, $prenom, $civilite, $email, $password, $ville, $adresse, $departement);
        $this->hydrate();
    }
    
    public function connecte($email, $password)
    {
        parent::connexion($email, $password);
        $this->hydrate();
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

