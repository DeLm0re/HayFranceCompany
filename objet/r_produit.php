<?php

class RequeteProduit extends Hydratable
{  
    private $id_produit;
    
    public function __construct(BDD $BDD, $id_produit)
    {
        parent::__construct($BDD);
        $this->id_produit = $id_produit;
    }

    public function hydrate()
    {
        $id = $this->id_produit;
        if(is_int($id))
        {
            $resultat = $this->exeRequete("SELECT * FROM produit "
                    . "WHERE id_produit = $id");
            parent::hydrateInfos($resultat);
        }
    }
}

