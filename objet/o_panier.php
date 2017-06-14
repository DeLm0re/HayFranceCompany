<?php

abstract class RequetePanier extends Hydratable
{
    private $id_utilisateur;
    
    public function __construct(BDD $BDD, $id_utilisateur)
    {
        parent::__construct($BDD);
        $this->id_utilisateur = $id_utilisateur;
        $this->hydrate();
    }

    public function hydrate()
    {
        $id = intval($this->id_utilisateur);
        $resultat = $this->bindRequete('SELECT * FROM panier '
                . 'WHERE id_utilisateur = ?',
                array(1 => $id));
        parent::hydrateInfos($resultat);
    }
    
    protected function updateDepartement($idpa, $nbde)
    {
        $this->bindRequete('UPDATE panier SET id_prix_transport = ? '
                . 'WHERE id_panier = ?',
                array(1 => $nbde, 2 => $idpa));
    }
    
    protected function insertPanierProduit($idpa, $idpr, $form, $nbpa)
    {
        $this->bindRequete('INSERT INTO panier_produit (id_panier, id_produit, '
                . 'format, nb_palette) '
                . 'VALUES (?, ?, ?, ?)',
                array(1 => $idpa, 2 => $idpr, 3 => $form, 4 => $nbpa));
    }
    
    protected function deletePanierProduit($idpa, $idpr)
    {
        $this->bindRequete('DELETE FROM panier_produit '
                . 'WHERE id_panier = ? AND id_produit = ?',
                array(1 => $idpa, 2 => $idpr));
    }
    
    protected function videPanierProduit($idpa)
    {
        $this->bindRequete('DELETE FROM panier_produit WHERE id_panier = ?',
                array(1 => $idpa));
    }
    
    protected function selectPanierProduit($idpa)
    {
        $resultat = $this->bindRequete('SELECT id_produit FROM panier_produit '
                . 'WHERE id_panier = ?',
                array(1 => $idpa));
        return $resultat;
    }
    
    protected function selectFormatProduit($idpa, $idpr)
    {
        $resultat = $this->bindRequete('SELECT format FROM panier_produit '
                . 'WHERE id_panier = ? AND id_produit = ?',
                array(1 => $idpa, 2 => $idpr));
        return $resultat;
    }
    
    protected function selectQuantiteProduit($idpa, $idpr)
    {
        $resultat = $this->bindRequete('SELECT nb_palette FROM panier_produit '
                . 'WHERE id_panier = ? AND id_produit = ?',
                array(1 => $idpa, 2 => $idpr));
        return $resultat;
    }
}



class Panier extends RequetePanier
{
    public function __construct(BDD $BDD, $id_utilisateur) 
    {
        parent::__construct($BDD, $id_utilisateur);
        $this->hydrate();
    }
    
    public function infos() 
    {
        $this->hydrate();
        return parent::getInfos();
    }
    
    public function donneContenu()
    {
        $this->hydrate();
        $tab_produits = NULL;
        $index = 0;
        $id_panier = $this->getInfos()['id_panier'];
        $resultat = parent::selectPanierProduit($id_panier);
        foreach ($resultat as $ligne) 
        {
            $produit = new Produit($this->getBDD(), $ligne['id_produit']);
            $tab_produits[$index] = $produit;
            $index += 1;
        }
        return $tab_produits;
    }
    
    public function donneFormatProduit(Produit $produit)
    {
        $this->hydrate();
        $format = NULL;
        $id_produit = $produit->getInfos()['id_produit'];
        $id_panier = $this->getInfos()['id_panier'];
        $resultat = parent::selectFormatProduit($id_panier, $id_produit);
        foreach ($resultat as $ligne) 
        {
                $format = $ligne['format'];
        }
        return $format;
    }
    
    public function donneQuantiteProduit(Produit $produit)
    {
        $this->hydrate();
        $quantite = NULL;
        $id_produit = $produit->getInfos()['id_produit'];
        $id_panier = $this->getInfos()['id_panier'];
        $resultat = parent::selectQuantiteProduit($id_panier, $id_produit);
        foreach ($resultat as $ligne) 
        {
            $quantite = $ligne['nb_palette'];
        }
        return $quantite;
    }
    
    public function ajouteProduit(Produit $produit, $format, $nb_palette)
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        $id_produit = $produit->getInfos()['id_produit'];
        parent::insertPanierProduit($id_panier, $id_produit, $format, $nb_palette);
    }
    
    public function retireProduit(Produit $produit)
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        $id_produit = $produit->getInfos()['id_produit'];
        parent::deletePanierProduit($id_panier, $id_produit);
    }
    
    public function seVide()
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        parent::videPanierProduit($id_panier);
    }
    
    public function changeDepartement($nb_departement)
    {
        $this->hydrate();
        $nb = intval($nb_departement);
        $id_panier = $this->getInfos()['id_panier'];
        parent::updateDepartement($id_panier, $nb);
        $this->hydrate();
    }
}
