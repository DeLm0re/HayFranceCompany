<?php

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
        $resultat = $this->exeRequete("SELECT id_utilisateur, nom, prenom, "
                . "civilite, email, ville, adresse, departement, id_panier "
                . "FROM utilisateur WHERE id_utilisateur = $id");
        parent::hydrateInfos($resultat);
    }
    
    protected function connexion($email, $password)
    {
        $param[1] = $email;
        $param[2] = $password;
        $resultat = $this->bindRequete("SELECT id_utilisateur FROM utilisateur "
                . "WHERE email = ? AND password = ?", $param);
        foreach ($resultat as $ligne)
        {
            $this->id_utilisateur = $ligne['id_utilisateur'];
        }
    }
}

