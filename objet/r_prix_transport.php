<?php

class RequetePrixTransport extends Hydratable
{
    private $nb_departement;
    
    public function __construct(BDD $BDD, $nb_departement) 
    {
        parent::__construct($BDD);
        $this->nb_departement = $nb_departement;
    }
    
    public function hydrate()
    {
        $nb = $this->nb_departement;
        if(is_int($nb))
        {
            $resultat = $this->exeRequete("SELECT * FROM prix_transport "
                    . "WHERE id_prix_transport = $nb");
            parent::hydrateInfos($resultat);   
        }
    }
}

