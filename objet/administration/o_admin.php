<?php
include_once 'o_liste_image.php';

class Admin extends Utilisateur
{
    public function __construct(BDD $BDD) 
    {
        parent::__construct($BDD);
    }
   
    public function donneListeUrlImage()
    {
        $liste = new ListeImage($this->getBDD());
        return $liste->donneListeUrlImage();
    }
    
    public function donneListeIdImage()
    {
        $liste = new ListeImage($this->getBDD());
        return $liste->donneListeIdImage();
    }
    
    public function donneListeNomImage()
    {
        $liste = new ListeImage($this->getBDD());
        return $liste->donneListeNomImage();
    }
    
    public function ajouteProduit($nom, $description, $description_rapide, $prix_tonne)
    {
        $this->insertProduit($nom, $description, $description_rapide, $prix_tonne);
        return $this->getBDD()->getLastInsertId();
    }
    
    public function ajouteImage($nom, $url)
    {
        $this->insertImage($nom, $url);
        return $this->getBDD()->getLastInsertId();
    }
    
    public function ajouteAnimal($nom)
    {
        $this->insertAnimal($nom);
        return $this->getBDD()->getLastInsertId();
    }
    
    public function ajouteImageProduit($id_produit, $id_image)
    {
        $this->insertImageProduit($id_produit, $id_image);
    }
    
    public function supprimeImageProduit($id_produit)
    {
        $this->deleteImageProduit($id_produit);
    }
    
    public function ajouteAnimalProduit($id_produit, $id_animal)
    {
        $this->insertAnimalProduit($id_produit, $id_animal);
    }
    
    public function supprimeAnimalProduit($id_produit)
    {
        $this->deleteAnimalProduit($id_produit);
    }
    
    public function modifieProduit(Produit $produit, $nom, $description, 
            $description_rapide, $prix_tonne)
    {
        $this->updateProduit($produit->getInfos()['id_produit'], $nom, $description,
                $description_rapide, $prix_tonne);
    }
    
    public function supprimeProduit(Produit $produit)
    {
        $this->deleteProduit($produit->getInfos()['id_produit']);
    }
    
    //Vincent
    public function supprimeAnimal($id_animal){
        $this->deleteAnimal($id_animal) ; 
    }
    
    public function changePrix()
    {
        
    }
    
    private function insertProduit($nom, $desc, $dera, $prix)
    {
        $this->bindRequete('INSERT INTO produit (nom_produit, description, '
                . 'description_rapide, prix_tonne) '
                . 'VALUES (?, ?, ?, ?)',
                array(1 => $nom, 2 => $desc, 3 => $dera, 4 => $prix));
    }
    
    private function insertImage($nom, $url)
    {
        $this->bindRequete('INSERT INTO image (nom_image, url) VALUES (?, ?)',
                array(1 => $nom, 2 => $url));
    }
    
    private function insertAnimal($nom)
    {
        $this->bindRequete('INSERT INTO animal (animal) VALUES (?)',
                array(1 => $nom)) ; 
    }


    private function insertImageProduit($idp, $idi)
    {
        $this->bindRequete('INSERT INTO produit_image '
                . '(id_produit, id_image) '
                . 'VALUES (?, ?)',
                array(1 => $idp, 2 => $idi));
    }
    
    private function deleteImageProduit($idp)
    {
        $this->bindRequete('DELETE FROM produit_image WHERE id_produit = ?',
                array(1 => $idp));
    }    
    
    private function deleteAnimalProduit($idp)
    {
        $this->bindRequete('DELETE FROM animal_produit WHERE id_produit = ?',
                array(1 => $idp));
    }

    private function insertAnimalProduit($idp, $ida)
    {
        $this->bindRequete('INSERT INTO animal_produit '
                . '(id_produit, id_animal) '
                . 'VALUES (?, ?)',
                array(1 => $idp, 2 => $ida));
    }
    
    private function updateProduit($id, $nom, $desc, $dera, $prix)
    {
        $this->bindRequete('UPDATE produit SET nom_produit = ?, '
                . 'description = ?, description_rapide = ?, prix_tonne = ? '
                . 'WHERE id_produit = ?',
                array( 1 => $nom, 2 => $desc, 3 => $dera, 4 => $prix, 
                    5 => $id));
    }
    
    private function deleteProduit($id_produit)
    {
        $this->bindRequete('DELETE FROM produit_image WHERE id_produit = ?',
                array( 1 => $id_produit));
        $this->bindRequete('DELETE FROM animal_produit WHERE id_produit = ?',
                array( 1 => $id_produit));
        $this->bindRequete('DELETE FROM produit WHERE id_produit = ?',
                array( 1 => $id_produit));
    }
    
    //Vincent
    private function deleteAnimal($id_animal)
    {
        $this->bindRequete('DELETE FROM animal_produit WHERE id_animal = ?',
                array( 1 => $id_animal));
        $this->bindRequete('DELETE FROM animal WHERE id_animal = ?',
                array(1 => $id_animal)) ; 
    }
}


/*

 * donneListeUrlImage()
 * donneListeIdImage()
 * 
 * 
 * 
 *  */