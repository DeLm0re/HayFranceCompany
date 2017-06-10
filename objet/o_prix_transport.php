<?php

include 'r_prix_transport.php';

class PrixTransport extends RequetePrixTransport
{
    public function __construct(BDD $BDD, $nb_departement) 
    {
        parent::__construct($BDD, $nb_departement);
        $this->hydrate();
    }
    
    public function getInfos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }
}

