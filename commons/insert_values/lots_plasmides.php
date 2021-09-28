<?php
session_start();
require '../config.php';
include '../header.php';
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plasmithèque</title><!-- Lien vers le CSS général des pages d'insertion de valeurs -->
    <link rel="stylesheet" href="../../assets/css/plasmitheque.css"> <!-- Lien vers le CSS spécifique à cette page -->
    <script src="../../assets/javascript/toggleInput.js" async></script>
    <!-- Lien vers le script js spécifique à cette page -->
</head>
<body>
<h1>Lots de plasmide</h1> <!-- Titre au sommet de la page -->


<?php

$requeteOperateur = $dbSeqens->query('SELECT DISTINCT operateur FROM lots_plasmides');
$affichageOperateur = $requeteOperateur->fetchAll(PDO::FETCH_ASSOC);


//Début du formulaire d'insertion
echo "<form method='post' action='./processing/process_lot_plasmides.php'>";

echo "<p>Choose name :</p>";
echo '<input list="plasmide-list" id="select-plasmide" name="plasmide" required/>';

echo '<datalist id="plasmide-list">';

$requetePLSM = $dbSeqens->query("SELECT numero_interne_plsm FROM plasmitheque");
$affichagePLSM = $requetePLSM->fetchAll(PDO::FETCH_ASSOC);

$requeteNom = $dbSeqens->query("SELECT nom_clone FROM plasmitheque");
$affichageNom = $requeteNom->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < sizeof($affichagePLSM); ++$i) {
    echo "<option value='{$affichagePLSM[$i]['numero_interne_plsm']}'</option>";
    echo $affichageNom[$i]['nom_clone'];
}

echo '</datalist>';


//Nom du clone (Champ de texte)
echo "<p>Nombre de tubes créés :</p>";
echo "<input type='number' name='nombre_tubes_crees' min='1' max='4' required>";

//Date
echo "<p>Date de création de lot :</p>";
echo "<input type='date' name='date_creation_lot' value=''>";



//Menu déroulant pour les Vecteurs de clonages
//On parcourt $affichageVecteurClonage et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo '<p>Opérateur : </p>';
echo "<select name='operateur' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOperateur); ++$i) {
    echo '<option>' . $affichageOperateur[$i]['operateur'] . '</option>';
}
echo "</select>";



//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputOperateurButton" onclick="showInput(\'inputAddOperateur\', \'hideInputOperateurButton\', \'showInputOperateurButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOperateurButton" onclick="hideInput(\'inputAddOperateur\', \'hideInputOperateurButton\', \'showInputOperateurButton\')">Annuler</button>';

//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddOperateur" name="operateur_add">';

echo '<p>Protocole :</p>';
echo '<input type="file" id="protocole" name="protocole">';


//Bouton pour envoyer le formulaire vers le fichier de traitement (./processing/process_plasmitheque.php)
echo "<p><button type='submit' id='submitButton'>Ajouter</button></p>";
echo "</form>";
//Fin du formulaire d'insertion
?>
</body>
</html>