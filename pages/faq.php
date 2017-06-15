<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Foire aux questions</title>
    </head>
    <body>
        <div>
            <span>Bienvenue dans la F.A.Q de HayFranceCompany ! <br>
                Toutes les interrogations que vous pouvez avoir sont traitées ici ! <br>
            </span>
        </div>
        <div>
            <!--<p>Comment faire si j'ai perdu mon mot de passe ou mon nom d'utilisateur ?</p>-->
            <div>
                <div>
                    <span>Si je n'ai pas reçu mon bon de commande par mail, qui dois-je contacter ?<br></span>
                </div>
                <div>
                    <span>
                        Avant toute chose, assurez-vous bien d'avoir validé votre commande. Si c'est le cas et que vous n'avez toujours
                        pas reçu de mail de confirmation, veuillez patienter au moins un jour ouvré (le serveur est possiblement suchargé 
                        ou en maintenance). <br> Si après plusieurs jours vous n'avez toujours aucune nouvelle, veuillez contacter 
                        contact@doulierehayfrance.com pour expliquez plus en détail votre problème.
                    </span>
                </div>
            </div>

            <!-- Toute cette partie vient de hayfrancecompany.com (wordpress) !!-->
            <div>
                <div>
                    <span>Quelles sont les modalités et la durée de contractualisation avec les agriculteurs ?<br></span>
                </div>
                <div>
                    <span>
                        La contractualisation avec les agriculteurs ou les propriétaires fonciers consiste en une convention d’achat de 
                        récolte qui engage le producteur et l’acheteur uniquement sur la vente de la culture en place. <br> Elle n'a aucune
                        prise sur le foncier, car elle est fractionnée par les dates de récolte. Elle correspond à la durée de vie de la culture.
                    </span>
                </div>
            </div>

            <div>
                <div>
                    <span>
                        Quelle est la politique en termes de prix ?<br>
                    </span>
                </div>
                <div>
                    <span>
                        Le prix de base des conventions est fixé sur les seuls cours officiels des fourrages, luzerne déshydratée et foin de Crau ;
                        il est régulé par une règle de trois sur la base.<br>
                    </span>
                </div>
            </div>

            <div>
                <div>
                    <span>
                        Quelles sont les conditions de production demandées sur la variété utilisée, les conditions de coupe et de séchage 
                        réalisées par l’agriculteur ou la société d’exploitation ?<br>
                    </span>
                </div>
                <div>
                    <span>
                        Les fourrages doivent être de qualité. Cette qualité dépend en premier lieu de leur culture, pour chacune (foin, luzerne…), 
                        elle doit correspondre au cahier des charges joint à la convention. <br> Les semences doivent être garanties sans OGM. 
                        Les coupes sont à réaliser de 7 à 9 cm du sol pour qu'il n'y ait pas de remontée de terre et le taux d'humidité 
                        du foin pressé correspondre à une moyenne de 14% d’humidité. <br>
                    </span>
                </div>
            </div>

            <div>
                <div>
                    <span>
                        Quels est l’accompagnement et le contrôle mis en œuvre par la société pour s’assurer du niveau de qualité du 
                        fourrage ?<br>
                    </span>
                </div>
                <div>
                    <span>
                        L’accompagnement est réalisé par des techniciens agrémentés affiliés par un contrat à Hay France Company et Fourrage 
                        Doulière pour le diagnostic et le suivi des récoltes.<br>
                    </span>
                    <span>
                        La sas Fourrage Doulière est inscrite auprès du GNIS pour l’agrément de vente de semence fourragère certifiée.<br>
                    </span>
                    <span>
                        Le niveau de qualité du fourrage est optimisé par le cahier des charges établi pour chaque variété et joint à la 
                        convention contractualisée avec les entreprises de travaux agricoles. Celles-ci s’engagent pour 5 ans, correspondant
                        à la durée de la culture mais aussi à l’amortissement du matériel.<br>
                    </span>
                    <span>
                        La création en octobre 2016 d’une entreprise de récolte, d’une CUMA affiliée à Hay France Company basée à Eyguières (13)
                        a été réalisée.<br>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>
