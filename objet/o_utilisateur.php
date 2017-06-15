<?php

include_once 'abs_hydratable.php';
include_once 'o_produit.php';
include_once 'o_prix_transport.php';
include_once 'o_panier.php';
include_once 'o_liste_produit.php';
include_once 'o_liste_animal.php';



abstract class RequeteUtilisateur extends Hydratable
{
    private $id_utilisateur;
    
    public function __construct(BDD $BDD, $id_utilisateur) 
    {
        parent::__construct($BDD);
        $this->id_utilisateur = $id_utilisateur;
    }
    
    public function hydrate() 
    {
        $id = intval($this->id_utilisateur);
        $resultat = $this->bindRequete('SELECT id_utilisateur, nom, prenom, '
                . 'civilite, email, ville, adresse, departement, id_panier '
                . 'FROM utilisateur WHERE id_utilisateur = ?',
                array(1 => $id));
        parent::hydrateInfos($resultat);
    }
    
    protected function estConnecte()
    {
        if($this->id_utilisateur === -1)
        {
            return false;
        }
        return true;
    }
    
    protected function inscription($nom, $pre, $civ, $ema, $pas, $vil, $adr, $dep)
    {
        if($this->existeDeja($nom, $pre, $ema))
        {
            return false;
        }
        $param = array( 1 => $nom, 2 => $pre, 3 => $civ, 4 => $ema, 
            5 => md5($pas), 6 => $vil, 7 => $adr, 8 => $dep, 9 => NULL);
        $this->bindRequete("INSERT INTO utilisateur (nom, prenom, civilite, "
                . "email, password, ville, adresse, departement, id_panier) "
                . "VALUES (?,?,?,?,?,?,?,?,?)", $param);
        
        $id_panier = $this->initialisePanier($this->getBDD()->getLastInsertId(), $dep);
        $this->connexion($ema, $pas);               
        $this->bindRequete("UPDATE utilisateur SET id_panier = ? "
                . "WHERE id_utilisateur = ?", 
                array(1 => $id_panier, 2 => $this->id_utilisateur));
        $this->deconnexion(-1);
        return true;
    }
    
    protected function modification($ema, $pas, $vil, $adr, $dep)
    {
        if($this->existeDeja(NULL, NULL, $ema))
        {
            return false;
        }
        $param = array( 1 => $ema, 2 => md5($pas), 3 => $vil, 4 => $adr, 
            5 => $dep, 6 => $this->id_utilisateur);
        $this->bindRequete("UPDATE utilisateur  SET email = ?, password = ?, "
                . "ville = ?, adresse = ?, departement = ? "
                . "WHERE id_utilisateur = ?", $param);
        return true;
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
    
    private function initialisePanier($id_utilisateur, $nb_departement)
    {
        $param = array( 1 => 0, 2 => $id_utilisateur, 3 => $nb_departement);
        $this->bindRequete("INSERT INTO panier (prix_panier, "
                . "id_utilisateur, id_prix_transport) "
                . "VALUES (?,?,?)", $param);
        return $this->getBDD()->getLastInsertId();
    }
        
    private function existeDeja($nom, $prenom, $email)
    {
        $existe = false;
        $resultat = $this->bindRequete("SELECT nom, prenom, email FROM utilisateur "
                . "WHERE id_utilisateur != ?", array( 1 => $this->id_utilisateur));
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
        $is_ok = parent::inscription($nom, $prenom, $civilite, $email, $password, $ville, $adresse, $departement);
        $this->hydrate();
        return $is_ok;
    }
    
    public function modifie($email, $password, $ville, $adresse, $departement)
    {
        $is_ok = parent::modification($email, $password, $ville, $adresse, $departement);
        $this->hydrate();
        return $is_ok;
    }
    
    public function connecte($email, $password)
    {
        parent::connexion($email, $password);
        $this->changeDepartement($this->donneInfos()['departement']);
        if($this->estConnecte() === true)
        {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            return true;
        }
        return false;
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

    public function ajouteProduitPanier(Produit $produit, $format, $nb_palette)
    {
        return $this->getPanier()->ajouteProduit($produit, $format, $nb_palette);
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
    
    public function donneQuantiteProduit(Produit $produit)
    {
        return $this->getPanier()->donneQuantiteProduit($produit);
    }
    
    public function donneFormatProduit(Produit $produit)
    {
        return $this->getPanier()->donneFormatProduit($produit);
    }
    
    public function consulteListeProduit($categorie = NULL)
    {
        $liste = new ListeProduit($this->getBDD());
        return $liste->donneListeProduits($categorie);
    }
    
    public function donneListeAnimal()
    {
        $liste = new ListeAnimal($this->getBDD());
        return $liste->donneListeAnimal();
    }
    
    public function donneListeIdAnimal()
    {
        $liste = new ListeAnimal($this->getBDD());
        return $liste->donneListeIdAnimal();
    }
    
    private function getPanier()
    {
        return new Panier($this->getBDD(), $this->getInfos()['id_utilisateur']);
    }
}



 