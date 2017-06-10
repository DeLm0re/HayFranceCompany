<?php

include 'r_prix_transport.php';

class PrixTransport extends RequetePrixTransport
{
    public function __construct(BDD $BDD, $nb_departement) 
    {
        parent::__construct($BDD, $nb_departement);
    }
    
    public function donnePrix()
    {
        $this->hydrate();
        return $this->_infos;
    }
}

