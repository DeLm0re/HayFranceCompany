<?php

include_once 'o_bdd.php';
include_once '../o_utilisateur';

class Admin extends Utilisateur
{
    public function __construct(BDD $BDD) 
    {
        parent::__construct($BDD);
    }
    
    public function ajouteProduit($nom, $description, $description_rapide, $prix_tonne, $id_image)
    {
        $this->insertProduit($nom, $description, $description_rapide, $prix_tonne, $id_image);
    }
    
    public function modifieProduit(Produit $produit, $nom, $description, 
            $description_rapide, $prix_tonne, $nom_image, $url_image)
    {
        $this->updateProduit($produit->getInfos()['id_produit'], $nom, $description,
                $description_rapide, $prix_tonne, $nom_image, $url_image);
    }
    
    public function supprimeProduit(Produit $produit)
    {
        $this->deleteProduit($produit->getInfos()['id_produit']);
    }
    
    public function changePrix()
    {
        
    }
    
    private function insertProduit($nom, $desc, $dera, $prix, $idim)
    {
        $this->bindRequete('INSERT INTO produit (nom_produit, description, '
                . 'description_rapide, prix_tonne) '
                . 'VALUES (?, ?, ?, ?)',
                array(1 => $nom, 2 => $desc, 3 => $dera, 4 => $prix));
        $this->bindRequete('INSERT INTO produit_image '
                . '(id_produit, id_image) '
                . 'VALUES (?, ?)',
                array(1 => $this->getBDD()->lastInsertId(), 2 => $idim));
    }

    private function updateProduit($id, $nom, $desc, $dera, $prix)
    {
        $this->bindRequete('UPDATE produit '
                . 'INNER JOIN produit_image ON produit.id_produit = produit_image.id_produit '
                . 'SET produit.nom_produit = ?, produit.description = ?, '
                . 'produit.description_rapide = ? ,produit.prix_tonne = ?, '
                . 'WHERE produit.id_produit = ?',
                array( 1 => $nom, 2 => $desc, 3 => $dera, 4 => $prix, 
                    5 => $id));
    }
    
    private function deleteProduit($id_produit)
    {
        $this->bindRequete('DELETE FROM produit_image WHERE id_produit = ?',
                array( 1 => $id_produit));
        $this->bindRequete('DELETE FROM produit WHERE id_produit = ?',
                array( 1 => $id_produit));
    }
}
