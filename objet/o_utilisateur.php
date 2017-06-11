<?php

include 'r_utilisateur.php';

class Utilisateur extends RequeteUtilisateur
{
    const HORS_CONNEXION = -1;
    
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD, self::HORS_CONNEXION);
    }

    public function donneInfos()
    {
        $this->hydrate();
        $infos = $this->getInfos();
        unset($infos['id_panier']);
        unset($infos['id_utilisateur']);
        return $infos;
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
    
    public function deconnecte()
    {
        parent::deconnexion(self::HORS_CONNEXION);
        $this->hydrate();
    }
    
    public function changeDepartement($nb_departement)
    {
        $this->hydrate();
        $panier = $this->getPanier();
        $panier->changeDepartement($nb_departement);
        $this->hydrate();
    }

    public function ajouteProduitPanier(Produit $produit)
    {
        $this->getPanier()->ajouteProduit($produit);
    }
    
    public function retireProduitPanier(Produit $produit)
    {
        $this->getPanier()->retireProduit($produit);
    }
    
    public function videPanier()
    {
        $this->getPanier()->seVide();
    }
    
    public function donneContenuPanier()
    {
        return $this->getPanier()->donneContenu();
    }
    
    public function consulteListeProduit($categorie = NULL)
    {
        $liste = new ListeProduit($this->getBDD());
        return $liste->donneListeProduits($categorie);
    }
    
    private function getPanier()
    {
        return new Panier($this->getBDD(), $this->getInfos()['id_utilisateur']);
    }
}

