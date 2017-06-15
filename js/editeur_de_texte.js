function resultat(){
    document.getElementById("resuEditeur").value = document.getElementById("editeur").innerHTML;
}

function commande(nom, argument) {
  if (typeof argument === 'undefined') {
    argument = '';
  }
  
  switch(nom){
	case "createLink":
		argument = prompt("Quelle est l'adresse du lien ?");
	break;
        case "forecolor":
		argument = prompt("Quelle est couleur voulez vous ?");
	break;
    }
  // Exécuter la commande
  document.execCommand(nom, false, argument);
}

