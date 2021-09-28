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
    <script src="../../assets/javascript/toggleInput.js" async></script>
    <!-- Lien vers le script js spécifique à cette page -->
</head>
<body>
<h1>Plasmithèque</h1> <!-- Titre au sommet de la page -->

<?php
// On sélectionne dans la requête tout les valeurs uniques d'une table donnée
// On stocke dans $affichageVecteurClonage le tableau associatif du résultat de la requête
// $affichageVecteurClonage[nb][nomColonne] => nb correspond à l'index d'un item de la BDD (0, 1, 2, ...) et nomColonne correspond au nom de la colonne dans la BDD.
// $affichageVecteurClonage est donc un tableau à index numérique, chaque index numérique renvoyant un tableau associatif correspondant à un item de la BDD.
// On reproduit le même procédé pour toutes les colonnes où on doit afficher un menu déroulant similaire
$requeteVecteurClonage = $dbSeqens->query('SELECT DISTINCT vecteur_clonage FROM plasmitheque');
$affichageVecteurClonage = $requeteVecteurClonage->fetchAll(PDO::FETCH_ASSOC);

$requeteTypeVecteur = $dbSeqens->query('SELECT DISTINCT type_vecteur_nb_copie FROM plasmitheque');
$affichageTypeVecteur = $requeteTypeVecteur->fetchAll(PDO::FETCH_ASSOC);

$requeteResistanceAntibiotique = $dbSeqens->query('SELECT DISTINCT resistance_antibiotique FROM plasmitheque');
$affichageResistanceAntibiotique = $requeteResistanceAntibiotique->fetchAll(PDO::FETCH_ASSOC);

//Début du formulaire d'insertion
echo "<form method='post' action='./processing/process_plasmitheque.php'>";


//Numéro interne PLSM
echo "<p>Numéro interne de plasmide : </p>";
echo "<label for='txt'>PLSM_
    <input name='numero_interne_plsm' type='text' id='txt' pattern='[1-9]{5}' maxlength='5' step='1' placeholder='XXXXX' required>
</label>";


//Nom du clone (Champ de texte)
echo "<p>Nom du clone :</p>";
echo "<input type='text' id='inputAddNameClone' name='nom_clone' required>";


//Menu déroulant pour les Vecteurs de clonages
//On parcourt $affichageVecteurClonage et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Vecteur de clonage : </p>";
echo "<select name='vecteur_clonage' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageVecteurClonage); ++$i) {
    echo '<option>' . $affichageVecteurClonage[$i]['vecteur_clonage'] . '</option>';
}
echo "</select>";

//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputVectorClonageButton" onclick="showInput(\'inputAddVectorClonage\', \'hideInputVectorClonageButton\', \'showInputVectorClonageButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputVectorClonageButton" onclick="hideInput(\'inputAddVectorClonage\', \'hideInputVectorClonageButton\', \'showInputVectorClonageButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddVectorClonage" name="vecteur_clonage_add">';


//Menu déroulant pour les Types de vecteurs
//On parcourt $affichageTypeVecteur et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Type de vecteur (nombre de copie) : </p>";
echo "<select name='type_vecteur'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageTypeVecteur); ++$i) {
    echo '<option>' . $affichageTypeVecteur[$i]['type_vecteur_nb_copie'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputVectorTypeButton" onclick="showInput(\'inputAddVectorType\', \'hideInputVectorTypeButton\', \'showInputVectorTypeButton\')">+</button>';

echo '<button type="button" style="visibility: hidden" id="hideInputVectorTypeButton" onclick="hideInput(\'inputAddVectorType\', \'hideInputVectorTypeButton\', \'showInputVectorTypeButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddVectorType" name="type_vecteur_add">';


//Menu déroulant pour les résistances antibiotiques
//On parcourt $affichageResistanceAntibiotique et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Résistance Antibiotique : </p>";
echo "<select name='resistance_antibiotique'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageResistanceAntibiotique); ++$i) {
    echo '<option>' . $affichageResistanceAntibiotique[$i]['resistance_antibiotique'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputResistanceAntibiotiqueButton" onclick="showInput(\'inputAddResistanceAntibiotique\', \'hideInputResistanceAntibiotiqueButton\', \'showInputResistanceAntibiotiqueButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputResistanceAntibiotiqueButton" onclick="hideInput(\'inputAddResistanceAntibiotique\', \'hideInputResistanceAntibiotiqueButton\', \'showInputResistanceAntibiotiqueButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddResistanceAntibiotique" name="resistance_antibiotique_add">';


//Menu déroulant pour Gène synthétique ou PCR
echo "<p> Gène synthétique ou PCR ? </p>";
echo "<select name='gene_synthetique_pcr' required>";
echo '<option> Gène synthétique </option>';
echo '<option> PCR </option>';
echo "</select>";


//Gène optimisé
echo "<p>Gène Optimisé : </p>";
echo "<input type='radio' id='inputAddGeneOptimise' name='gene_optimise' value='Oui' required>Oui";
echo "<input type='radio' id='inputAddGeneOptimise' name='gene_optimise' value='Non'>Non";


//Numéro de Boîte de Stockage
echo "<p>Numéro de Boîte de Stockage : </p>";
echo "<input type='number' step='1' id='inputAddPositionCrytube' name='numero_boite_stockage' required>";


//Position du Cryotube
echo "<p>Position du Cryotube : </p>";
echo "<input type='text' id='inputAddPositionCrytube' name='position_cryotube' pattern='[A-Z]{1}[1-9]{1}' maxlength='2' required>";


//Bouton pour envoyer le formulaire vers le fichier de traitement (./processing/process_plasmitheque.php)
echo "<p><button type='submit' id='submitButton'>Ajouter</button></p>";
echo "</form>";
//Fin du formulaire d'insertion
?>
</body>
</html>
