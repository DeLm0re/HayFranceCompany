<?php

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

