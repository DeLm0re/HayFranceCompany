<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mentions légales</title>
    </head> 
    <body>
        <div>
            <span>Mentions légales relatives à l'entreprise HayFranceCompany et à ses produits.</span>
        </div>

        <div>
            <span>
                Éditeur <br>
                DOULIERE HAY FRANCE SAS<br>
                1 rue Copernic<br>
                Z.A du Salat<br>
                13310 SAINT MARTIN DE CRAU<br>
                Email : contact@doulierehayfrance.com<br>
                Tél : O4 90 47 44 15<br>
            </span>
        </div>

        <div>
            <span>
                Société par actions simplifiées, SAS<br>
                au capital de 10 000 €<br>
                immatriculé sur RCS de Nîmes N° Siret  794 242 966 00016<br>
                N° de TVA intracommunautaire : FR55794242966<br>
            </span>
        </div>
        <div>
            <span>
                Réalisation <br>
                Site réalisé par R. Jacquiez, P. Parrat, V. Petrini, T. Hipault, A. Parant, 
                étudiants de deuxième année de l'ISEN-Toulon<br>
                http://isen-toulon.fr/<br>
            </span>
        </div>
        <div>
            <span>
                Hébergement<br>
                Le site est hébergé chez OVH<br>
                2 rue Kellermann<br>
                59100 Roubaix<br>
                France<br>
                http://www.ovh.com<br>
            </span>
            <span>
                SAS au capital de 10 M€ - RCS Roubaix-Tourcoing 424 761 419 00045<br>
                Code APE 6202A - N°TVA : FR 22-424-761-419<br>
                Déclaration faite au CNIL<br>
            </span>

            <span>
                SAS OVH - http://www.ovh.com<br>
            </span>
        </div>  
        <div>
            <span>
                Crédits Photos :<br>
                Adrien PERRIN<br>
                Shutterstock<br>
                www.sutterstock.com<br>
                123 RF<br>
                www.123rf.com<br>
                Dreamstime<br>
                www.dreamstime.com<br>
            </span>

        </div>
    </body>
</html>