<?php

class RequeteListeImage extends Hydratable
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
        $this->hydrate();
    }

    public function hydrate()
    {
        $resultat = $this->exeRequete('SELECT * FROM image');
        $this->_infos = $resultat;
    }
}



class ListeImage extends RequeteListeImage
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
    }
    
    public function donneListeImage()
    {
        $this->hydrate();
        $images = NULL;
        $index = 0;
        foreach ($this->_infos as $image) 
        {
            $images[$index] = $image['nom_image'];
            $index += 1;
        }
        return $images;
    }
    
    public function donneListeIdImage()
    {
        $this->hydrate();
        $images = NULL;
        $index = 0;
        foreach ($this->_infos as $image) 
        {
            $images[$index] = $image['id_animal'];
            $index += 1;
        }
        return $images;
    }
}