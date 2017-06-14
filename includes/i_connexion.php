<span id="erreur_connexion" class="erreur"></span>
<fieldset id="formulaire_connexion">
    <form>
        <p>Connexion<p> 
            
        
      
        <span id="erreur_email_connexion" class="erreur"></span>
        <p>Adresse mail : <input id="email_connexion" type="text" spellcheck="false" onchange="request_connexion(readData_connexion,'email_connexion');"></p>
            <span id="ok_email_connexion" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email_connexion" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_mdp_connexion" class="erreur"></span>
        <p>Mot de passe : <input id="mdp_connexion" type="password" onchange="request_connexion(readData_connexion,'mdp_connexion');"></p>
            <span id="ok_mdp_connexion" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp_connexion" style="display: none;"><img src="../images/ko.png"/></span>
        
        
        
        <span id="loader_connexion" style="display: none;"><img id="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button_connexion" type="button" value="Se connecter" onclick="request2_connexion(readData_connexion);">
</fieldset>
