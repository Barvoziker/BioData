<?php

$dbName = null;
$userName = null;
$password = null;
$host = null;

function dbCall($host, $dbName, $userName, $password)
{
    return new PDO("mysql:host={$host};dbname={$dbName}", "{$userName}", "{$password}", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

try {
    $dbSeqens = dbCall('localhost', 'db_proteus', 'root', '');
} catch (Exception $e){
     echo '<p style="color: red"> Error : cannot connect to Seqens database</p>';
}

try {
    $dbAccount = dbCall('localhost', 'connexion_seqens', 'root', '');
} catch (Exception $e){
    echo '<p style="color: red"> Error : cannot connect to Account database</p>';
}


//FONCTION POUR LES BOOL
function BOOL($titre,$nomDB){
    echo "<p>$titre :</p>";
    echo "<input name='$nomDB' type='radio' value='oui'>OUI";
    echo "<input name='$nomDB' type='radio' value='non'>NON";
}


//FONCTION POUR LES MENUS DEROULANTS
function MenuDeroulant($titre,$nomDB,$table,$nomBouton,$max,$size,$db){
    try {
        $requete = $db->query('SELECT DISTINCT '.$nomDB.' FROM '.$table);
        $affichage = $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erreur : Champ $nomDB introuvable dans la table $table de la BDD, récupération des données impossible";
    }
//On parcourt $affichage et pour chaque item qu'il contient on ajoute une option au menu déroulant
    echo "<p>$titre :</p>";
    echo "<select name='$nomDB'>";
    echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
    for ($i = 0; $i < sizeof($affichage); ++$i) {
        echo '<option>' . $affichage[$i]['$nomDB'] . '</option>';
    }
    echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
    echo '<button type="button" id="showInput'.$nomBouton.'Button" 
    onclick="showInput(\'inputAdd'.$nomBouton.'\', \'hideInput'.$nomBouton.'Button\', \'showInput'.$nomBouton.'Button\')">+</button>';
    echo '<button type="button" style="visibility: hidden" id="hideInput'.$nomBouton.'Button" 
    onclick="hideInput(\'inputAdd'.$nomBouton.'\', \'hideInput'.$nomBouton.'Button\', \'showInput'.$nomBouton.'Button\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
    echo '<input type="text" style="visibility: hidden" id="inputAdd'.$nomBouton.'" name="'.$nomDB.'_add" maxlength="'.$max.'" size="'.$size.'">';

}

function text($titre,$nomDB,$max){
    echo "<p>$titre :</p>";
    echo "<input type='text' name='$nomDB' maxlength='$max' size='$max'>";
}

function textArea($titre,$nomDB,$rows,$max){
    echo "<p>$titre : </p>";
    echo "<textarea rows = '$rows' cols = '50' name='$nomDB' id='$nomDB' maxlength='$max' 
    placeholder='entrez les informations ici...'></textarea>";
}

function dateForm($titre,$nomDB){
    echo "<p>$titre</p>";
    echo "<input type='date' name='$nomDB' value=''>";
}