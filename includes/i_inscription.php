<!--REMARQUES : 
 - spellcheck="false", permet d'indiquer au navigateur de ne pas appliquer une vérification orthographique dans les champs
 - checked="true", permet de cocher l'imput radio spécifié par défault (ici M.)
-->
<link href="../css/i_inscription.css" rel="stylesheet" type="text/css"/>

<fieldset id="formulaire_inscription">
    <form>
        <p>Inscription<p> 
            
        <p>Civilité : <input id="civMr" type="radio" name="civilite" value="M." checked="true">
        <label for="M.">M.</label>
        <input id="civMm" type="radio" name="civilite" value="Mme."><label for="Mme.">Mme.</label>
        </p>
        
        <span id="erreur_prenom" class="erreur"></span>
        <p>Prénom : <input id="prenom" type="text" spellcheck="false" onchange="request(readData,'prenom');"></p>
            <span id="ok_prenom" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_prenom" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_nom" class="erreur"></span>
        <p>Nom : <input id="nom" type="text" spellcheck="false" onchange="request(readData,'nom');"></p>
            <span id="ok_nom" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_nom" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_email" class="erreur"></span>
        <p>Adresse mail : <input id="email" type="text" spellcheck="false" onchange="request(readData,'email');"></p>
            <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_mdp" class="erreur"></span>
        <p>Mot de passe : <input id="mdp" type="password" onchange="request(readData,'mdp');"></p>
            <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_cmdp" class="erreur"></span>
        <p>Confirmation de votre mot de passe : <input id="cmdp" type="password" onchange="request(readData,'cmdp');"></p>
            <span id="ok_cmdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_cmdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_ville" class="erreur"></span>
        <p>Votre ville : <input id="ville" type="text" onchange="request(readData,'ville');"></p>
            <span id="ok_ville" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_ville" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_adresse" class="erreur"></span>
        <p">Votre adresse : <textarea id="adresse" rows=3 cols=40 onchange="request(readData,'adresse');"></textarea></p>
            <span id="ok_adresse" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_adresse" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_dpt" class="erreur"></span>
        <p>Votre numéro de département <input id="dpt" type="number"  min="1" max="95" onchange="request(readData,'dpt');"></p>
            <span id="ok_dpt" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_dpt" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <button id="button" value="?" onclick="request2(readData);">Se connecter</button>
</fieldset>

