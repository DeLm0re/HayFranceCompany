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
        return $this->getBDD()->getLastRequestStatus();
    }
    
    protected function updatePanierProduit($idpa, $idpr, $nbpa)
    {
        $this->bindRequete('UPDATE panier_produit SET id_panier = ?, '
                . 'id_produit = ?, nb_palette = ?',
                array(1 => $idpa, 2 => $idpr, 3 => $nbpa));
        return $this->getBDD()->getLastRequestStatus();
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
    
    public function donnePrixProduit(Produit $produit)
    {
        $this->hydrate();
        $prix_transport = new PrixTransport($this->getBDD(), $this->infos()['id_prix_transport']);
        
        $prix_tonne = intval($produit->infos()['prix_tonne']);
        $format = intval($this->donneFormatProduit($produit));
        $quantite = intval($this->donneQuantiteProduit($produit));
        $prix_livraison = floatval($prix_transport->infos()['prix'.$quantite]);
        
        $format_final = 0;
        if($format === 32 ){
            $format_final = 32*24;
        }
        else{
            $format_final = 22*36;            
        }
        $total = ($format_final*$quantite*$prix_tonne/1000) + $prix_livraison;
        return $total;
    }
    
    public function donnePrixTotal()
    {
        $prix_total = 0;
        $liste = $this->donneContenu();
        $max = count($liste);
        for($i = 0; $i < $max; $i++)
        {
            $prix_total += $this->donnePrixProduit($liste[$i]);
        }
        return $prix_total;
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
    
    public function changeNbrPalette(Produit $produit, $nbpa)
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        $id_produit = $produit->getInfos()['id_produit'];
        return parent::updatePanierProduit($id_panier, $id_produit, $nbpa);
    }
    
    public function ajouteProduit(Produit $produit, $format, $nb_palette)
    {
        $this->hydrate();
        $id_panier = $this->getInfos()['id_panier'];
        $id_produit = $produit->getInfos()['id_produit'];
        return parent::insertPanierProduit($id_panier, $id_produit, $format, $nb_palette);
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
