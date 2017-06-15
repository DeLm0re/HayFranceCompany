/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function suppression_produit(id_produit){
    
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            if(xhr.responseText === "suppression"){
                document.location.reload(false);
            }
        }
    };

    var id = encodeURIComponent(id_produit);

    xhr.open("GET", "../ajax/a_suppression_produit.php?id="+id, true);
    xhr.send(null);
}

function modifie_palette_produit(id_produit){
    
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            if(xhr.responseText === "modification"){
                document.location.reload(false);
            }
        }
    };
    
    var id = encodeURIComponent(id_produit);
    var nbr = encodeURIComponent(document.getElementById("select_p").value);
    
    xhr.open("GET", "../ajax/a_modifie_palette_produit.php?id="+id+"&nbr="+nbr+"", true);
    xhr.send(null);
}


