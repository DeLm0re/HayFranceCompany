<?php

abstract class RequetePrixTransport extends Hydratable
{
    private $nb_departement;
    
    public function __construct(BDD $BDD, $nb_departement) 
    {
        parent::__construct($BDD);
        $this->nb_departement = $nb_departement;
    }
    
    public function hydrate()
    {
        $nb = intval($this->nb_departement);
        $resultat = $this->exeRequete("SELECT * FROM prix_transport "
                . "WHERE id_prix_transport = $nb");
        parent::hydrateInfos($resultat);   
    }
}



class PrixTransport extends RequetePrixTransport
{
    public function __construct(BDD $BDD, $nb_departement) 
    {
        parent::__construct($BDD, $nb_departement);
        $this->hydrate();
    }
    
    public function infos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }
}
