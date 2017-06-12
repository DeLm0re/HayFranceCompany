<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



for ($i = 0; $i < sizeof($id_tag); $i += 1)
{
    if (!est_dans($description_tag[$i], $descriptions_deja_comparees) )
    {
        $nom = $description_tag[$i];
        //echo "<div class=\"input-field #212121 grey darken-4 orange-text col s12\" >";
        // echo "<select multiple name=\"valeur_tags[]\" onchange=\"recupereValeur();\">";
        //echo "<option value=\"\" disabled selected> $nom </option>";
    }
    for ($j = $i; $j < sizeof($id_tag); $j += 1)
    {
        if (est_dans($description_tag[$j], $descriptions_deja_comparees) )
        {
            break;
        }
        else if ($description_tag[$j] === $description_tag[$i])
        {
            $valeurId = $id_tag[$j];
            $valeurNom = $nom_tag[$j];
           // echo "<option value=$valeurId>$valeurNom</option>";
        }
    }
    
    if (!est_dans($description_tag[$i], $descriptions_deja_comparees) )
    {
      //  echo "</select>";
      //  echo "</div>";
    }
    $descriptions_deja_comparees[$i + 1] = $description_tag[$i];
}
echo "</div>";


//Vérifie qu'une valeur est dans un tableau
function est_dans($valeur, $tableau)
{
    $retour = false;
    for ($i = 0; $i < sizeof($tableau); $i += 1)
    {
        if ($valeur === $tableau[$i])
        {
            $retour = true;
        }
    }
    return $retour;

}
