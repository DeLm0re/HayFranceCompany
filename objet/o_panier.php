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
        $resultat = $this->exeRequete("SELECT * FROM panier "
                . "WHERE id_utilisateur = $id");
        parent::hydrateInfos($resultat);
    }
    
    protected function updateDepartement($id_panier, $nb_departement)
    {
        $this->exeRequete("UPDATE panier "
                . "SET id_prix_transport = $nb_departement "
                . "WHERE id_panier = $id_panier");
    }
    
    protected function insertPanierProduit($id_panier, $id_produit)
    {
        $this->exeRequete("INSERT INTO panier_produit (id_panier, id_produit) "
                . "VALUES ($id_panier, $id_produit)");
    }
    
    protected function deletePanierProduit($id_panier, $id_produit)
    {
        $this->exeRequete("DELETE FROM panier_produit "
                . "WHERE id_panier = $id_panier AND id_produit = $id_produit");
    }
    
    protected function videPanierProduit($id_panier)
    {
        $this->exeRequete("DELETE FROM panier_produit "
                . "WHERE id_panier = $id_panier");
    }
    
    protected function selectPanierProduit($id_panier)
    {
        $resultat = $this->exeRequete("SELECT * FROM panier_produit "
                . "WHERE id_panier = $id_panier");
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
    
    public function ajouteProduit(Produit $produit)
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        $id_produit = $produit->getInfos()['id_produit'];
        parent::insertPanierProduit($id_panier, $id_produit);
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
