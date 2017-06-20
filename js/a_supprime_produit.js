function appelSupprime(id_produit) {

    if (confirm("Voulez-vous supprimer le produit ?") === true) {
        if (typeof id_produit !== 'undefined') {

            var xhr = getXMLHttpRequest();
            xhr.onreadystatechange = function () {
                //Si l'état de l'ojet xhr vaut 4 ( Le serveur a fini son travail, et toutes les données sont réceptionnées)
                // et qu'il est au statue 200 (Requête traitée avec succès.)ou 0 (aucune réponse, pratique pour les tests en local,
                //  sans serveur d'évaluation), tout est OK. 
                if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
                    //on appelle la fonction readData et on lui donne en entré la réponse à la requete XML de xhr
                    //Soit ici on envoie à la fonction "readData" le code xml généré par "XMLHttpRequest_getListData.php"
                    // (voir à la fin de cette fonction) 
                    retourInfo(xhr.responseText);
                    // Du "document" (la page http) on va dans la balise comportant l'id "loader"
                    // on change le style "display" à "none" pour que la balise ayant l'id loader n'apparaisse pas sur la page
                    //document.getElementById("loader").style.display = "none";
                    //Si l'état de l'objet xhr est strictement inférieur à 4 (c'est dire que la requete est en court de traitement
                } //else if (xhr.readyState < 4) {
                // Du "document" (la page http) on va dans la balise comportant l'id "loader"
                // on change le style "display" à "inline" pour que la balise ayant l'id loader apparaisse sur la page
                //document.getElementById("loader").style.display = "center";
                //}
            };
            //alert(id_produit);   
            console.log("supprime_produit" + id_produit);
            xhr.open("GET", "../ajax/a_supp_produit_definitif.php?variable1=" + id_produit, true);
            xhr.send(null);
        }
    }
}

function retourInfo(info) {
    window.location.reload();
}

   