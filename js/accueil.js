/**
 * Created by Rulio on 27/02/14.
 */

function callScript(scriptName, args) {

    var xhr_object = null;

    // ### Construction de l’objet XMLHttpRequest selon le type de navigateur
    // Cas des navigateurs de type Netscape (Firefore, Conqueror, etc.)
    if (window.XMLHttpRequest)
        xhr_object = new XMLHttpRequest();
    // Cas du navigateur Internet Explorer
    else if (window.ActiveXObject)
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
    // Cas des navigateurs ne comprenant pas cette technologie (anciens navigateurs)
    else {
        // XMLHttpRequest non supporté par le navigateur
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        return;
    }

    xhr_object.open("POST", scriptName, true);

    //  Définition du comportement à adopter sur le changement d’état de l’objet
    // XMLHttpRequest
    xhr_object.onreadystatechange = function () {
        // Etat : requête terminée, réponse récupérée
        if (xhr_object.readyState == 4) {
            //alert(xhr_object.responseText); // DEBUG MODE
            // ### Interprétation du retour du script appellé
            // Mode d’interprétation 1: on affiche dans la page le retour
            // comme s’il s’agissait de code HTML
            //document.write(xhr_object.responseText);
            // Mode d’interprétation 2: on interprète le retour comme
            // s’il s’agissait de code javascript
            eval(xhr_object.responseText);
        }
        return xhr_object.readyState;
    }
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //  Envoi de la requête
    xhr_object.send(args);

}


function insertionCommentaire(id) {
    // --- Récupération des paramètres nécessaire au script PHP
    var commentaire = document.getElementById('textarea' + id).value;
    var publication = id;

    var _data = "commentaire=" + commentaire + "&publication=" + publication;
    // --- Appel au script PHP de traitement
    callScript("../Modele/insertionCommentaire.php", _data);
}

function suppressionCommentaire(id) {
    // --- Récupération des paramètres nécessaire au script PHP
    var commentaire = id;

    var _data = "commentaire=" + commentaire;
    // --- Appel au script PHP de traitement
    callScript("../Modele/suppressionCommentaire.php", _data);
}
