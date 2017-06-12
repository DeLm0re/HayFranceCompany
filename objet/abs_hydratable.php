<?php

abstract class Hydratable
{
    private $BDD;
    protected $_infos;
    
    public function __construct(BDD $BDD)
    {
        $this->BDD = $BDD;
    }
 
    public function __set($nom, $valeur)
    {
        $this->_infos[$nom] = $valeur;
    }

    public function __get($nom)
    {
        if (isset($this->_infos[$nom]))
        {
            return $this->_infos[$nom];
        }
        else 
        {    
            return NULL;
        }
    }
    
    protected function getInfos()
    {
        return $this->_infos;
    }
    
    protected function getBDD()
    {
        return $this->BDD;
    }
    
    protected function hydrateInfos($resultat)
    {   
        foreach($resultat as $ligne)
        {
            $cles = array_keys($ligne);
            for($i = 0; $i < count($cles); $i++)
            {
               $this->$cles[$i] = $ligne[$cles[$i]];
            }
        }   
    }
    
    protected function exeRequete($requete)
    {
        return $this->BDD->exe_requete($requete);
    }
    
    protected function bindRequete($requete, $param)
    {
        return $this->BDD->bind_requete($requete, $param);
    }

    abstract public function hydrate();

}

