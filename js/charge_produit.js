function request(id_produit) { 
    console.log("entrer dans request(), id_produit = " + id_produit) ; 
    if (typeof id_produit !== 'undefined') {
  // your code here

    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
                //Si l'état de l'ojet xhr vaut 4 ( Le serveur a fini son travail, et toutes les données sont réceptionnées)
                // et qu'il est au statue 200 (Requête traitée avec succès.)ou 0 (aucune réponse, pratique pour les tests en local,
                //  sans serveur d'évaluation), tout est OK. 
		if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
                        //on appelle la fonction readData et on lui donne en entré la réponse à la requete XML de xhr
                        //Soit ici on envoie à la fonction "readData" le code xml généré par "XMLHttpRequest_getListData.php"
                        // (voir à la fin de cette fonction) 
			readData(xhr.responseXML);
                        // Du "document" (la page http) on va dans la balise comportant l'id "loader"
                        // on change le style "display" à "none" pour que la balise ayant l'id loader n'apparaisse pas sur la page
			document.getElementById("loader").style.display = "none";
                //Si l'état de l'objet xhr est strictement inférieur à 4 (c'est dire que la requete est en court de traitement
		} else if (xhr.readyState < 4) {
                        // Du "document" (la page http) on va dans la balise comportant l'id "loader"
                        // on change le style "display" à "inline" pour que la balise ayant l'id loader apparaisse sur la page
			document.getElementById("loader").style.display = "center";
		}
	};
        
    console.log("charge_produit" + id_produit);
    xhr.open("GET", "../ajax/a_XML_get_produit.php?variable1="+ id_produit, true);
    xhr.send(null);
    }
}
     
        
        //function readData(){
        function readData(oData) {
        //On définit l'objet "nodes" sous la forme d'un tableau avec tous les éléments de la famille "itemProjet"
        //nodes1 correspond à la liste des projets
        //nodes2 correspond à la listes des utilisateurs
        /*<list>
	<itemUtilisateur statutUtilisateur="4" nomUtilisateur="Marre" prenomUtilisateur="Thibault"/>
	<itemProjet idProjet=1 nomProjet=Android . "\" leDescriptif="Lorem Ipsum..." />";
	...
        </list>
             */ 
	var nodes = oData.getElementsByTagName("itemProduit");
        console.log(nodes);
       //id_produit -> osef
       //nom_produit
       document.getElementById("titre").value = nodes[0].getAttribute("nom_produit") ; 
       t = document.createTextNode(nodes[0].getAttribute("description"));
       p = document.getElementById("editeur");
       p.appendChild(t);
       
       t = document.createTextNode(nodes[0].getAttribute("description_rapide"));
       p = document.getElementById("courteDesc");
       p.appendChild(t);
       document.getElementById("prix").value = nodes[0].getAttribute("prix_tonne");  
        
        }
   window.onload =request();