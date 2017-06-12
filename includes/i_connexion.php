<link href="../css/i_inscription.css" rel="stylesheet" type="text/css"/>

<fieldset id="formulaire_connexion">
    <form>
        <p>Connexion<p> 
            
       
            
        <span id="erreur_email" class="erreur"></span>
        <p>Adresse mail : <input id="email" type="text" spellcheck="false" onchange="request_connexion(readData_connexion,'email');"></p>
            <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_mdp" class="erreur"></span>
        <p>Mot de passe : <input id="mdp" type="password" onchange="request_connexion(readData_connexion,'mdp');"></p>
            <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        
        
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button" type="button" value="Se connecter" onclick="request2_connexion(readData_connexion);">
</fieldset>
