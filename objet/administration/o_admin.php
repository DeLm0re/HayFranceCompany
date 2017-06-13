<?php

include_once '../o_utilisateur';

class Admin extends Utilisateur
{
    public function __construct(BDD $BDD) 
    {
        parent::__construct($BDD);
    }
    
    public function ajouteProduit($nom, $description, $description_rapide, $prix_tonne)
    {
        
    }
    
    public function modifieProduit(Produit $produit, $nom, $description, $description_rapide, $prix_tonne)
    {
        $this->updateProduit($produit->getInfos()['id_produit'], $nom, $description,
                $description_rapide, $prix_tonne);
    }
    
    public function supprimeProduit(Produit $produit)
    {
        $this->deleteProduit($produit->getInfos()['id_produit']);
    }
    
    public function changePrix()
    {
        
    }

    private function updateProduit($id, $nom, $desc, $dera, $prix)
    {
        $this->bindRequete('UPDATE produit SET nom_produit = ?, description = ?, '
                . 'description_rapide = ?, $prix_tonne = ? WHERE id_produit = ?',
                array( 1 => $nom, 2 => $desc, 3 => $dera, 4 => $prix, 5 => $id));
    }
    
    private function deleteProduit($id_produit)
    {
        $this->bindRequete('DELETE FROM produit WHERE id_produit = ?',
                array( 1 => $id_produit));
    }
}
