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
    
    var departement = document.getElementById("span_validation_overlay").innerHTML;
    var xhr = getXMLHttpRequest();
        xhr.open("GET", "../ajax/a_departement.php?dep="+departement, true);
        xhr.send(null);
    
    /*On fait une action avec notre donnée*/
    document.getElementById("mon_departement").innerHTML = departement;
    
     /*On masque l'overlay*/
    document.getElementById("overlay").style.display = "none";
}