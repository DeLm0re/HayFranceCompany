<?php

include_once 'abs_hydratable.php';
include_once 'o_produit.php';
include_once 'o_prix_transport.php';
include_once 'o_panier.php';
include_once 'o_liste_produit.php';



abstract class RequeteUtilisateur extends Hydratable
{
    private $id_utilisateur;
    const USER_ALREADY_EXISTS = "Cet utilisateur existe déjà";
    const INSCRIPTION_SUCCESSFUL = "Inscription réussie";
    
    public function __construct(BDD $BDD, $id_utilisateur) 
    {
        parent::__construct($BDD);
        $this->id_utilisateur = $id_utilisateur;
    }
    
    public function hydrate() 
    {
        $id = intval($this->id_utilisateur);
        $resultat = $this->exeRequete("SELECT id_utilisateur, nom, prenom, "
                . "civilite, email, ville, adresse, departement, id_panier "
                . "FROM utilisateur WHERE id_utilisateur = $id");
        parent::hydrateInfos($resultat);
    }
    
    protected function inscription($nom, $pre, $civ, $ema, $pas, $vil, $adr, $dep)
    {
        if($this->existeDeja($nom, $pre, $ema))
        {
            return self::USER_ALREADY_EXISTS;
        }
        $param = array( 1 => $nom, 2 => $pre, 3 => $civ, 4 => $ema, 
            5 => md5($pas), 6 => $vil, 7 => $adr, 8 => $dep, 9 => NULL);
        $this->bindRequete("INSERT INTO utilisateur (nom, prenom, civilite, "
                . "email, password, ville, adresse, departement, id_panier) "
                . "VALUES (?,?,?,?,?,?,?,?,?)", $param);
        
        $id_panier = $this->initialisePanier($this->getBDD()->getLastInsertId());
        $this->connexion($ema, $pas);               
        $this->bindRequete("UPDATE utilisateur SET id_panier = ? "
                . "WHERE id_utilisateur = ?", 
                array(1 => $id_panier, 2 => $this->id_utilisateur));
        $this->deconnexion(-1);
        return self::INSCRIPTION_SUCCESSFUL;
    }

    protected function connexion($email, $password)
    {
        $param[1] = $email;
        $param[2] = md5($password);
        $resultat = $this->bindRequete("SELECT id_utilisateur FROM utilisateur "
                . "WHERE email = ? AND password = ?", $param);
        foreach ($resultat as $ligne)
        {
            $this->id_utilisateur = $ligne['id_utilisateur'];
        }
        
        $panier = new Panier($this->getBDD(), $this->id_utilisateur);
        $panier->changeDepartement($this->getInfos()['departement']);
    }
    
    protected function deconnexion($statut)
    {
        $this->id_utilisateur = $statut;
    }
    
    private function initialisePanier($id_utilisateur)
    {
        $param = array( 1 => 0, 2 => 0, 3 => 0, 4 => $id_utilisateur, 5 => 1);
        $this->bindRequete("INSERT INTO panier (prix_panier, format_produit, "
                . "nb_palette, id_utilisateur, id_prix_transport) "
                . "VALUES (?,?,?,?,?)", $param);
        return $this->getBDD()->getLastInsertId();
    }
        
    private function existeDeja($nom, $prenom, $email)
    {
        $existe = false;
        $resultat = $this->exeRequete("SELECT nom, prenom, email FROM utilisateur");
        foreach ($resultat as $ligne)
        {
            if(($nom === $ligne['nom'] && $prenom === $ligne['prenom'])
                    || $email === $ligne['email'])
            {
                $existe = true;
            }
        }
        return $existe;
    }

}



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
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        parent::connexion($email, $password);
        $this->hydrate();
    }
    
    public function deconnecte()
    {
        $_SESSION['email'] = NULL;
        $_SESSION['password'] = NULL;
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



 