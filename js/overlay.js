/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function clic_zone(data,nom) {

    if (data < 10){
        data = '0'+data;
    }

    /*On insère ce choix dans le span de validation*/
    document.getElementById("span_validation_overlay").innerHTML = nom+' ('+data+')';

    /*On affiche la div de validation*/
    document.getElementById("validation_overlay").style.display = "inherit";
}


function detecte_choix() {

    var liste, texte;
    liste = document.getElementById("select_overlay");
    texte = liste.options[liste.selectedIndex].text;

    document.getElementById("span_validation_overlay").innerHTML = texte;

    /*On affiche la div de validation*/
    document.getElementById("validation_overlay").style.display = "inherit";
}

function validation(){
    
    /*On fait une action avec notre donnée*/
    document.getElementById("mon_departement").innerHTML = document.getElementById("span_validation_overlay").innerHTML;
    
     /*On masque l'overlay*/
    document.getElementById("overlay").style.display = "none";
}

