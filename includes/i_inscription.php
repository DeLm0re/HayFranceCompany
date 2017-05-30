<!--REMARQUES : 
 - spellcheck="false", permet d'indiquer au navigateur de ne pas appliquer une vérification orthographique dans les champs
 - checked="true", permet de cocher l'imput radio spécifié par défault (ici M.)
-->

<fieldset id="formulaire_inscription">
    <form>
        <p>Inscription<p> 
            
        <p>Civilité : <input type="radio" name="civilite" value="M." checked="true">
        <label for="M.">M.</label>
        <input type="radio" name="civilite" value="Mme."><label for="Mme.">Mme.</label>
        </p>
        
        <p>Prénom : <input id="prenom" type="text" spellcheck="false" onchange="request(readData,'prenom');"></p>
            <span id="ok_prenom" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_prenom" style="display: none;"><img src="../images/ko.png"/></span>
            
        <p>Nom : <input id="nom" type="text" spellcheck="false" onchange="request(readData,'nom');"></p>
            <span id="ok_nom" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_nom" style="display: none;"><img src="../images/ko.png"/></span>
            
        <p>Adresse mail : <input id="email" type="text" spellcheck="false" onchange="request(readData,'email');"></p>
            <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
        
        <p>Mot de passe : <input id="mdp" type="password" onchange="request(readData,'mdp');"></p>
            <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <p>Confirmation de votre mot de passe : <input id="cmdp" type="password" onchange="request(readData,'cmdp');"></p>
            <span id="ok_cmdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_cmdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <button id="button" value="?" onclick="request(readData,'button');">Se connecter</button>
</fieldset>

