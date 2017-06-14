<?php

class RequeteListeAnimal extends Hydratable
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
        $this->hydrate();
    }

    public function hydrate()
    {
        $resultat = $this->exeRequete('SELECT * FROM animal');
        $this->_infos = $resultat;
    }
}



class ListeAnimal extends RequeteListeAnimal
{
    public function __construct(BDD $BDD)
    {
        parent::__construct($BDD);
    }
    
    public function donneListeAnimal()
    {
        $this->hydrate();
        $animaux = NULL;
        $index = 0;
        foreach ($this->_infos as $animal) 
        {
            $animaux[$index] = $animal['animal'];
            $index += 1;
        }
        return $animaux;
    }
    
    public function donneListeIdAnimal()
    {
        $this->hydrate();
        $animaux = NULL;
        $index = 0;
        foreach ($this->_infos as $animal) 
        {
            $animaux[$index] = $animal['id_animal'];
            $index += 1;
        }
        return $animaux;
    }
}