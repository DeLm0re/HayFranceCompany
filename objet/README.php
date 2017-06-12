<?php

/* Doc sur comment utiliser les objets
 * Chaque page doit inclure session_objet.php, vous avez enuite accès à
 * la variable $user qui contient toutes les méthodes utiles
 * Note : comme c'est un include, l'autocomplétion ne marche pas... 
 */

/* Ajoute un utilisateur à la BDD, si il n'existe pas déjà
 * NOTE : Cette méthode peut être appelée lorsque l'utilisateur n'est pas connecté
 * NOTE : $password ne doit pas être en md5
 */
$user->inscrit($nom, $prenom, $civilite, $email, $password, $ville, $adresse, $departement);
$user->inscrit('Hipault', 'Théo', 'M', 'theo@gmail.com', 'mdp', 'Toulon', '12 rue du Rekt', 83);

/* Connecte l'utilisateur et modifie les variables de session
 * NOTE : $password ne doit pas être en md5
 */
$user->connecte($email, $password);
$user->connecte('theo@gmail.com', 'mdp');

/* Deconnecte l'utilisateur et détruit les variables de session
 */
$user->deconnecte();

/* Renvoie un tableau contenant la liste des produits disponibles
 * NOTE : Cette méthode peut être appelée lorsque l'utilisateur n'est pas connecté
 */
$produits = $user->consulteListeProduit();
$infos_produit1 = $produits[0]->infos();
$infos_produit2 = $produits[1]->infos();

/* Renvoie un tableau contenant la liste des produits disponibles d'une seule catégorie
 * NOTE : On peut passer le nom exact de la catégorie, ou son id dans la BDD
 */
$produitsTries = $user->consulteListeProduit($categorie);
$produitsTries1 = $user->consulteListeProduit('Vache');
$produitsTries2 = $user->consulteListeProduit(1);

/* Modifie le département du panier pour les calculs des prix
 * NOTE : Cette méthode ne modifie PAS les données de l'utilisateur, uniquement
 * le panier
 */
$user->changeDepartement($nb_departement);
$user->changeDepartement(93);

/* Ajoute ou retire un produit du panier 
 * NOTE : $produit doit être de classe Produit
 */
$listeProduits = $user->consulteListeProduit();
$user->ajouteProduitPanier($listeProduits[2]);
$user->retireProduitPanier($listeProduits[2]);

/* Vide le panier (efface tous les produits
 */
$user->videPanier();

/* Renvoie un tableau contenant tous les produits du panier 
 */
$produitsPanier = $user->donneContenuPanier();
$infos_produit3 = $produits[2]->infos();
$infos_produit4 = $produits[3]->infos();