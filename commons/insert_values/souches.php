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
    <title>Insertion Souchothèque</title>
    <script src="../../assets/javascript/toggleInput.js" async></script>
</head>
<body>

<h1>SOUCHOTHEQUE</h1>
<h2>Généralités</h2>

<?php

//MENU DEROULANT POUR LE PREFIXE DU NUMERO PROTEUS
try {
    $requetePNumberPrefix = $dbSeqens->query('SELECT DISTINCT souchotheque_prefix FROM misc');
    $affichagePNumberPrefix = $requetePNumberPrefix->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e0) {
    echo "Erreur : préfixes du numéro proteus introuvable dans le BDD, récupération des données impossible";
}
//On parcourt $affichageName et pour chaque item unique qu'il contient on ajoute une option au menu déroulant
echo "<p> Préfixe Numero Proteus  :</p>";
echo "<select name='prefix_numero_proteus' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez un préfixe</option>";
for ($i = 0; $i < sizeof($affichagePNumberPrefix); ++$i) {
    echo '<option>' . $affichagePNumberPrefix[$i]['souchotheque_prefix'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
////Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<button type="button" id="showInputPrefixProteusNumberButton" onclick="showInput(\'inputAddPrefixProteusNumberButton\',\'hideInputPrefixProteusNumberButton\',\'showInputPrefixProteusNumberButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputPrefixProteusNumberButton" onclick="hideInput(\'inputAddPrefixProteusNumberButton\',\'hideInputPrefixProteusNumberButton\',\'showInputPrefixProteusNumberButton\')">Annuler</button>';
echo '<input type="text" style="visibility: hidden" id="inputAddPrefixProteusNumberButton" name="prefix_proteus_number_add" size="3" maxlength="3">';


//CHAMP POUR LA SUITE DU NUMERO PROTEUS
try {
    $requetePNumber = $dbSeqens->query('SELECT numero_proteus FROM souches ORDER BY numero_proteus DESC LIMIT 1');
    $affichagePNumber = $requetePNumber->fetchAll(PDO::FETCH_NUM);
} catch (Exception $e1) {
    echo "Erreur : numéro proteus introuvable dans la BDD, récupération des données impossible";
}

if (isset($affichagePNumber) && !empty($affichagePNumber)) {

    echo "<p>Numéro interne de la souche (Dernier numéro =". $affichagePNumber[0][0].") <i>(obligatoire)</i> : </p>";
    echo "    <input name='numero_interne_plsm' type='text' id='pnumber' pattern='[1-9]{5}' maxlength='5' size='5' step='1' placeholder='XXXXX' required>";
} else {
    echo "<p>Numéro interne de la souche (Aucun numéro dans le base de données) <i>(obligatoire)</i> : </p>";
    echo "    <input name='numero_interne_plsm' type='text' id='pnumber' pattern='[1-9]{5}' maxlength='5' size ='5' step='1' placeholder='1' required>";
}


echo "<p>Nom de la souche :</p>";
echo "<input type='text' name='nom_souche' maxlength='50' size='50'>";


echo "<p>Numéro interne :</p>";
echo "<input type='text' name='numero_interne' maxlength='30' size='30'>";


//MENU DEROULANT POUR LE CREATEUR DE LA FICHE
try {
    $requeteCreateurF = $dbSeqens->query('SELECT DISTINCT createur_fiche FROM souches ');
    $affichageCreateurF = $requeteCreateurF->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e2) {
    echo "Erreur : créateur de la fiche introuvable dans la BDD, récupération des données impossible";
}
//On parcourt $affichageCreateurF et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Créateur de la fiche <i>(obligatoire)</i> : </p>";
echo "<select name='createur_fiche' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageCreateurF); ++$i) {
    echo '<option>' . $affichageCreateurF[$i]['createur_fiche'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputCreateurFButton" onclick="showInput(\'inputAddCreateurF\', \'hideInputCreateurFButton\', \'showInputCreateurFButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputCreateurFButton" onclick="hideInput(\'inputAddCreateurF\', \'hideInputCreateurFButton\', \'showInputCreateurFButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddCreateurF" name="createur_fiche_add" maxlength="50" size="50">';


//DATE DE CREATION
echo "<p>Date de création de la fiche :</p>";
echo "<input type='date' name='date_creation_fiche' value='' required>";


//MENU DEROULANT POUR LE PROPRIETAIRE DE LA SOUCHE
try {
    $requeteProprioS = $dbSeqens->query('SELECT DISTINCT createur_fiche FROM souches ');
    $affichageProprioS = $requeteProprioS->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e3) {
    echo "Erreur : propriétaire de la souche introuvable dans la BDD, récupération des données impossible";
}
//On parcourt $affichageProprioS et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Propriétaire de la souche <i>(obligatoire)</i> : </p>";
echo "<select name='proprietaire_souche' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageProprioS); ++$i) {
    echo '<option>' . $affichageProprioS[$i]['proprietaire_souche'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputProprioSButton" onclick="showInput(\'inputAddProprioS\', \'hideInputProprioSButton\', \'showInputProprioSButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputProprioSButton" onclick="hideInput(\'inputAddProprioS\', \'hideInputProprioSButton\', \'showInputProprioSButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddProprioS" name="proprietaire_souche_add" maxlength="50" size="50">';


//MENU DEROULANT POUR LE LABO D'ORIGINE
try {
    $requeteLaboOrigine = $dbSeqens->query('SELECT DISTINCT labo_origine FROM souches ');
    $affichageLaboOrigine = $requeteLaboOrigine->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e3) {
    echo "Erreur : Labo d'origine introuvable dans la BDD, récupération des données impossible";
}
//On parcourt $affichageProprioS et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Labo d'origine <i>(obligatoire)</i> : </p>";
echo "<select name='labo_origine'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageLaboOrigine); ++$i) {
    echo '<option>' . $affichageLaboOrigine[$i]['labo_origine'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputLaboOrigineButton" onclick="showInput(\'inputAddLaboOrigine\', \'hideInputLaboOrigineButton\', \'showInputLaboOrigineButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputLaboOrigineButton" onclick="hideInput(\'inputAddLaboOrigine\', \'hideInputLaboOrigineButton\', \'showInputLaboOrigineButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo '<input type="text" style="visibility: hidden" id="inputAddLaboOrigine" name="labo_origine_add" maxlength="50" size="50">';


//CHAMP POUR ISOLE PAR
echo "<p>Isolé par : </p>";
echo "    <input name='isole_par' type='text' id='isole_par' maxlength='30' size='30'>";


//BOUTONS POUR SOUCHE PUBLIQUE (BOOLEAN)
echo "<p>Souche publique :</p>";
echo "<input name='souche_publique' type='radio' value='oui'>OUI";
echo "<input name='souche_publique' type='radio' value='non'>NON";


//MENU DEROULANT POUR LE NOM DE LA COLLECTION DE LA SOUCHE PUBLIQUE
try {
    $requeteNomCollecSouchePublique = $dbSeqens->query('SELECT DISTINCT createur_fiche FROM souches ');
    $affichageNomCollecSouchePublique = $requeteNomCollecSouchePublique->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e4) {
    echo "Erreur : propriétaire de la souche introuvable dans la BDD, récupération des données impossible";
}
//On parcourt $affichageNomCollecSouchePublique et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Nom de la collection de la souche publique <i>(obligatoire si Souche Publique = Oui)</i>: </p>";
echo "<select name='nom_collection_souche_publique' required>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageNomCollecSouchePublique); ++$i) {
    echo '<option>' . $affichageNomCollecSouchePublique[$i]['nom_collection_souche_publique'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputNomCollecSouchePubliqueButton" onclick="showInput(\'inputAddNomCollecSouchePublique\', \'hideInputNomCollecSouchePubliqueButton\', \'showInputNomCollecSouchePubliqueButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputNomCollecSouchePubliqueButton" onclick="hideInput(\'inputAddNomCollecSouchePublique\', \'hideInputNomCollecSouchePubliqueButton\', \'showInputNomCollecSouchePubliqueButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo "<input type='text' style='visibility: hidden' id='inputAddNomCollecSouchePublique' name='nom_collection_souche_publique_add' maxlength='50' size='50'>";


//CHAMP POUR NUMERO SOUCHE PUBLIQUE
echo "<p>Numéro de la souche publique <i>(obligatoire si Souche Publique = Oui)</i> : </p>";
echo "<input name='numero_souche_publique' type='text' id='numero_souche_publique' maxlength='20' size='20'>";


//CHAMP POUR AUTRE NUMERO COLLECTION PUBLIQUE
echo "<p>Autre numéros de collections publiques : </p>";
echo "<textarea rows = '5' cols = '50' name='autre_numero_collection_publique' id='autre_numero_collection_publique' maxlength='250' placeholder='entrez les informations ici...'></textarea>";


//BOUTONS POUR MTA (BOOLEAN)
echo "<p>MTA :</p>";
echo "<input name='mta' type='radio' value='oui'>OUI";
echo "<input name='mta' type='radio' value='non'>NON";


//CHAMP POUR NUMERO MTA
echo "<p>Numéro MTA <i>(obligatoire si MTA = Oui)</i> : </p>";
echo "<input name='numero_mta' type='text' id='numero_souche_publique' maxlength='30' size='30'>";


//BOUTONS POUR CONTRAT ACTIF (BOOLEAN)
echo "<p>MTA :</p>";
echo "<input name='contrat_actif' type='radio' value='oui'>OUI";
echo "<input name='contrat_actif' type='radio' value='non'>NON";


//CHAMP POUR NUMERO CONTRAT
echo "<p>Contrat : </p>";
echo "<textarea rows = '3' cols = '50' name='contrat_numero' id='contrat_numero' maxlength='150' placeholder='entrez les informations ici...'></textarea>";


//CHAMP POUR DOMAINES D'APPLICATION
echo "<p>Domaines d'application : </p>";
echo "<textarea rows = '10' cols = '50' name='domaines_application' id='domaines_application' maxlength='500' placeholder='entrez les informations ici...'></textarea>";


//CHAMP POUR DOMAINES EXCLUS
echo "<p>Domaines exclus : </p>";
echo "<textarea rows = '10' cols = '50' name='domaines_exclus' id='domaines_exclus' maxlength='500' placeholder='entrez les informations ici...'></textarea>";


//DATE DE DESTRUCTION
echo "<p>Date de destruction :</p>";
echo "<input type='date' name='destruction' value=''>";


//CHAMP POUR MOTIF DESTRUCTION
echo "<p>Motif de destruction <i>(obligatoire si \"Date de destruction\" remplie)</i> : </p>";
echo "<textarea rows = '10' cols = '50' name='motif_destruction' id='motif_destruction' maxlength='500' placeholder='entrez les informations ici...'></textarea>";


echo "<p><u> Nagoya </u></p>";

//NAGOYA : DATE DE PRELEVEMENT
echo "<p>Nagoya - Date de prélèvement :</p>";
echo "<input type='date' name='nagoya_date_prelevement' value=''>";


//CHAMP POUR NAGOYA : PAYS D'ORIGINE
echo "<p>Nagoya - Pays d'origine : </p>";
echo "<textarea rows = '2' cols = '50' name='nagoya_pays_origine' id='nagoya_pays_origine' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


//CHAMP POUR NAGOYA : CONFORMITE
echo "<p>Nagoya - Conformite :</p>";
echo "<input name='nagoya_confirmite' type='radio' value='oui'>OUI";
echo "<input name='nagoya_confirmite' type='radio' value='non'>NON";


//CHAMP POUR NAGOYA : REMARQUES
echo "<p>Nagoya - Remarques : </p>";
echo "<textarea rows = '10' cols = '50' name='nagoya_remarques' id='nagoya_remarques' maxlength='500' placeholder='entrez les informations ici...'></textarea>";


//CHAMP POUR GENERALITE : REMARQUES
echo "<p>Remarques : </p>";
echo "<textarea rows = '10' cols = '50' name='generalites_remarques' id='generalites_remarques' maxlength='500' placeholder='entrez les informations ici...'></textarea>";


//MENU DEROULANT POUR LA PATHOGENECITE
try {
    $requetePathogenecite = $dbSeqens->query('SELECT DISTINCT safety_information_pathogenecity_risk_class FROM souches ');
    $affichagePathogenecite = $requetePathogenecite->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e4) {
    echo "Erreur : Pathogenecite introuvable dans la BDD, récupération des données impossible";
}

//On parcourt $affichagePathogenecite et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Safety Information - Pathogenecity (Risk Class) : </p>";
echo "<select name='safety_information_pathogenecity_risk_class'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichagePathogenecite); ++$i) {
    echo '<option>' . $affichagePathogenecite[$i]['safety_information_pathogenecity_risk_class'] . '</option>';
}
echo "</select>";


//Bouton pour ajouter une valeur qui n'est pas présente dans le menu déroulant
echo '<button type="button" id="showInputPathogeneciteButton" 
onclick="showInput(\'inputAddPathogenecite\', 
\'hideInputPathogeneciteButton\', 
\'showInputPathogeneciteButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputPathogeneciteButton" 
onclick="hideInput(\'inputAddPathogenecite\', 
\'hideInputPathogeneciteButton\', 
\'showInputPathogeneciteButton\')">Annuler</button>';


//Champ de texte qui ne s'affiche que quand on clique sur le bouton
echo "<input type='text' style='visibility: hidden' id='inputAddPathogenecite' name='safety_information_pathogenecity_risk_class_add' maxlength='50' size='50'>";


//CHAMP POUR SAFETY INFORMATION : REFERENCE RISK CLASS
echo "<p>Safety Information - Reference Risk Class : </p>";
echo "<textarea rows = '2' cols = '50' name='safety_information_reference_risk_class' id='safety_information_reference_risk_class' maxlength='100' placeholder='entrez les informations ici...'></textarea>";

?>
<br>
<br>
<h2>Taxonomie</h2>
<?php


//CHAMP POUR TAXO : SOUCHE TYPE
echo "<p>Souche type :</p>";
echo "<input name='taxo_souche_type' type='radio' value='oui'>OUI";
echo "<input name='taxo_souche_type' type='radio' value='non'>NON";


//CHAMP POUR TAXO : MICROALGUE
echo "<p>Microalgue :</p>";
echo "<input name='taxo_microalgues' type='radio' value='oui'>OUI";
echo "<input name='taxo_microalgues' type='radio' value='non'>NON";

echo "<p><u>Mode d'identification phylogénétique</u></p>";


//CHAMP POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - SEQUENCE MARQUEUR PHYLOGENETIQUE
echo "<p>Mode d'identification phylogénétique - Séquence de marqueurs phylogénétiques : </p>";
echo "<textarea rows = '10' cols = '50' name='taxo_id_phylogenetique_sequence_marqueur_phylogenetique' id='taxo_id_phylogenetique_sequence_marqueur_phylogenetique' placeholder='entrez les informations ici...'></textarea>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - DOMAINE
try {
    $requeteDomaineGNT = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenetique_domaine FROM souches ');
    $affichageDomaineGNT = $requeteDomaineGNT->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e5) {
    echo "Erreur : Domaine introuvable dans la BDD, récupération des données impossible";
}


//On parcourt $affichageDomaine et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Domaine : </p>";
echo "<select name='taxo_id_phylogenetique_domaine'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageDomaineGNT); ++$i) {
    echo '<option>' . $affichageDomaineGNT[$i]['taxo_id_phylogenetique_domaine'] . '</option>';
}
echo "</select>";

echo '<button type="button" id="showInputDomaineButton" onclick="showInput(\'inputAddDomaine\', \'hideInputDomaineButton\', \'showInputDomaineButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputDomaineButton" onclick="hideInput(\'inputAddDomaine\', \'hideInputDomaineButton\', \'showInputDomaineButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddDomaine' name='taxo_id_phylogenomique_domaine_add' maxlength='50' size='50'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENETIQUE - CLASSE]
try {
    $requeteClasseGNT = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenetique_classe_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_classe_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_classe_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_classe_d FROM souches');
    $affichageClasseGNT = $requeteClasseGNT->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e6) {
    echo "Erreur : Classe introuvable dans la BDD, récupération des données impossible";
}


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - CLASSE 1
//On parcourt $affichageClasseGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Classe 1 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNT); ++$i) {
    if (isset($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a']) && !empty($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'])) {
        echo '<option>' . $affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNTAButton" onclick="showInput(\'inputAddClasseGNTA\', \'hideInputClasseGNTAButton\', \'showInputClasseGNTAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNTAButton" onclick="hideInput(\'inputAddClasseGNTA\', \'hideInputClasseGNTAButton\', \'showInputClasseGNTAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNTA' name='taxo_id_phylogenomique_classe_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - CLASSE 2
//On parcourt $affichageClasseGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Classe 2 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNT); ++$i) {
    if (isset($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a']) && !empty($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'])) {
        echo '<option>' . $affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNTBButton" onclick="showInput(\'inputAddClasseGNTB\', \'hideInputClasseGNTBButton\', \'showInputClasseGNTBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNTBButton" onclick="hideInput(\'inputAddClasseGNTB\', \'hideInputClasseGNTBButton\', \'showInputClasseGNTBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNTB' name='taxo_id_phylogenomique_classe_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - CLASSE 3
//On parcourt $affichageClasseGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Classe 3 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNT); ++$i) {
    if (isset($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a']) && !empty($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'])) {
        echo '<option>' . $affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNTCButton" onclick="showInput(\'inputAddClasseGNTC\', \'hideInputClasseGNTCButton\', \'showInputClasseGNTCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNTCButton" onclick="hideInput(\'inputAddClasseGNTC\', \'hideInputClasseGNTCButton\', \'showInputClasseGNTCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNTC' name='taxo_id_phylogenomique_classe_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - CLASSE 4
//On parcourt $affichageClasseGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Classe 4 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNT); ++$i) {
    if (isset($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a']) && !empty($affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'])) {
        echo '<option>' . $affichageClasseGNT[$i]['taxo_id_phylogenetique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNTButton" onclick="showInput(\'inputAddClasseGNTD\', \'hideInputClasseGNTDButton\', \'showInputClasseGNTButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNTDButton" onclick="hideInput(\'inputAddClasseGNTD\', \'hideInputClasseGNTDButton\', \'showInputClasseGNTButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNTD' name='taxo_id_phylogenomique_classe_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENETIQUE - ORDRE]
try {
    $requeteOrdreGNT = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenetique_ordre_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_ordre_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_ordre_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_ordre_d FROM souches');
    $affichageOrdreGNT = $requeteOrdreGNT->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e7) {
    echo "Erreur : Ordre introuvable dans la BDD, récupération des données impossible";
}

//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ORDRE 1
//On parcourt $affichageOrdreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Ordre 1 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNT); ++$i) {
    if (isset($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a']) && !empty($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNTAButton" onclick="showInput(\'inputAddOrdreGNTA\', \'hideInputOrdreGNTAButton\', \'showInputOrdreGNTAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNTAButton" onclick="hideInput(\'inputAddOrdreGNTA\', \'hideInputOrdreGNTAButton\', \'showInputOrdreGNTAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNTA' name='taxo_id_phylogenomique_ordre_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ORDRE 2
//On parcourt $affichageOrdreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Ordre 2 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNT); ++$i) {
    if (isset($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a']) && !empty($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNTBButton" onclick="showInput(\'inputAddOrdreGNTB\', \'hideInputOrdreGNTBButton\', \'showInputOrdreGNTBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNTBButton" onclick="hideInput(\'inputAddOrdreGNTB\', \'hideInputOrdreGNTBButton\', \'showInputOrdreGNTBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNTB' name='taxo_id_phylogenomique_ordre_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ORDRE 3
//On parcourt $affichageOrdreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Ordre 3 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNT); ++$i) {
    if (isset($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a']) && !empty($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNTCButton" onclick="showInput(\'inputAddOrdreGNTC\', \'hideInputOrdreGNTCButton\', \'showInputOrdreGNTCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNTCButton" onclick="hideInput(\'inputAddOrdreGNTC\', \'hideInputOrdreGNTCButton\', \'showInputOrdreGNTCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNTC' name='taxo_id_phylogenomique_ordre_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ORDRE 4
//On parcourt $affichageOrdreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Ordre 4 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNT); ++$i) {
    if (isset($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a']) && !empty($affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNT[$i]['taxo_id_phylogenetique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNTDButton" onclick="showInput(\'inputAddOrdreGNTD\', \'hideInputOrdreGNTDButton\', \'showInputOrdreGNTDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNTDButton" onclick="hideInput(\'inputAddOrdreGNTD\', \'hideInputOrdreGNTDButton\', \'showInputOrdreGNTDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNTD' name='taxo_id_phylogenomique_ordre_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENETIQUE - GENRE]
try {
    $requeteGenreGNT = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenetique_genre_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_genre_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_genre_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_genre_d FROM souches');
    $affichageGenreGNT = $requeteGenreGNT->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e7) {
    echo "Erreur : Genre introuvable dans la BDD, récupération des données impossible";
}


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - GENRE 1
//On parcourt $affichageGenreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Genre 1 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNT); ++$i) {
    if (isset($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a']) && !empty($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'])) {
        echo '<option>' . $affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNTAButton" onclick="showInput(\'inputAddGenreGNTA\', \'hideInputGenreGNTAButton\', \'showInputGenreGNTAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNTAButton" onclick="hideInput(\'inputAddGenreGNTA\', \'hideInputGenreGNTAButton\', \'showInputGenreGNTAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNTA' name='taxo_id_phylogenomique_genre_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - GENRE 2
//On parcourt $affichageGenreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Genre 2 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNT); ++$i) {
    if (isset($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a']) && !empty($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'])) {
        echo '<option>' . $affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNTBButton" onclick="showInput(\'inputAddGenreGNTB\', \'hideInputGenreGNTBButton\', \'showInputGenreGNTBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNTBButton" onclick="hideInput(\'inputAddGenreGNTB\', \'hideInputGenreGNTBButton\', \'showInputGenreGNTBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNTB' name='taxo_id_phylogenomique_genre_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - GENRE 3
//On parcourt $affichageGenreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Genre 3 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNT); ++$i) {
    if (isset($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a']) && !empty($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'])) {
        echo '<option>' . $affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNTCButton" onclick="showInput(\'inputAddGenreGNTC\', \'hideInputGenreGNTCButton\', \'showInputGenreGNTCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNTCButton" onclick="hideInput(\'inputAddGenreGNTC\', \'hideInputGenreGNTCButton\', \'showInputGenreGNTCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNTC' name='taxo_id_phylogenomique_genre_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - GENRE 4
//On parcourt $affichageGenreGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Genre 4 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNT); ++$i) {
    if (isset($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a']) && !empty($affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'])) {
        echo '<option>' . $affichageGenreGNT[$i]['taxo_id_phylogenetique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNTDButton" onclick="showInput(\'inputAddGenreGNTD\', \'hideInputGenreGNTDButton\', \'showInputGenreGNTDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNTDButton" onclick="hideInput(\'inputAddGenreGNTD\', \'hideInputGenreGNTDButton\', \'showInputGenreGNTDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNTD' name='taxo_id_phylogenomique_genre_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENETIQUE - ESPECE]
try {
    $requeteEspeceGNT = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenetique_espece_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_espece_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_espece_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenetique_espece_d FROM souches');
    $affichageEspeceGNT = $requeteEspeceGNT->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e7) {
    echo "Erreur : Espece introuvable dans la BDD, récupération des données impossible";
}

//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ESPECE 1
//On parcourt $affichageEspeceGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Espece 1 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNT); ++$i) {
    if (isset($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a']) && !empty($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNTAButton" onclick="showInput(\'inputAddEspeceGNTA\', \'hideInputEspeceGNTAButton\', \'showInputEspeceGNTAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNTAButton" onclick="hideInput(\'inputAddEspeceGNTA\', \'hideInputEspeceGNTAButton\', \'showInputEspeceGNTAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNTA' name='taxo_id_phylogenomique_espece_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ESPECE 2
//On parcourt $affichageEspeceGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Espece 2 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNT); ++$i) {
    if (isset($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a']) && !empty($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNTBButton" onclick="showInput(\'inputAddEspeceGNTB\', \'hideInputEspeceGNTBButton\', \'showInputEspeceGNTBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNTBButton" onclick="hideInput(\'inputAddEspeceGNTB\', \'hideInputEspeceGNTBButton\', \'showInputEspeceGNTBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNTB' name='taxo_id_phylogenomique_espece_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ESPECE 3
//On parcourt $affichageEspeceGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Espece 3 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNT); ++$i) {
    if (isset($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a']) && !empty($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNTCButton" onclick="showInput(\'inputAddEspeceGNTC\', \'hideInputEspeceGNTCButton\', \'showInputEspeceGNTCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNTCButton" onclick="hideInput(\'inputAddEspeceGNTC\', \'hideInputEspeceGNTCButton\', \'showInputEspeceGNTCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNTC' name='taxo_id_phylogenomique_espece_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENETIQUE - ESPECE 4
//On parcourt $affichageEspeceGNT et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénétique - Espece 4 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNT); ++$i) {
    if (isset($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a']) && !empty($affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNT[$i]['taxo_id_phylogenetique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNTDButton" onclick="showInput(\'inputAddEspeceGNTD\', \'hideInputEspeceGNTDButton\', \'showInputEspeceGNTDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNTDButton" onclick="hideInput(\'inputAddEspeceGNTD\', \'hideInputEspeceGNTDButton\', \'showInputEspeceGNTDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNTD' name='taxo_id_phylogenomique_espece_d_add' maxlength='30' size='30'>";


//CHAMP POUR POURCENT ID
echo "<p>Mode d'identification phylogénétique - %ID : </p>";
echo "<input name='taxo_id_phylogenetique_pourcent_id' type='number' id='taxo_id_phylogenetique_pourcent_id' max='100' step='0,01' size='6'>";


//CHAMP POUR POURCENT COVER
echo "<p>Mode d'identification phylogénétique - %COVER : </p>";
echo "<input name='taxo_id_phylogenetique_pourcent_cover' type='number' id='taxo_id_phylogenetique_pourcent_cover' max='100' step='0,01' size='6'>";


//CHAMP POUR DATE BLAST
echo "<p>Mode d'identification phylogénétique - Date blast :</p>";
echo "<input type='date' name='taxo_id_phylogenetique_date_blast' value=''>";


//CHAMP POUR SOURCE
echo "<p>Mode d'identification phylogénétique - Source : </p>";
echo "<textarea rows = '2' cols = '50' name='taxo_id_phylogenetique_source' id='taxo_id_phylogenetique_source' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


//CHAMP PROJET
echo "<p>Mode d'identification phylogénétique - Projet : </p>";
echo "<textarea rows = '2' cols = '50' name='taxo_id_phylogenetique_projet' id='taxo_id_phylogenetique_projet' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


//BOUTONS POUR GENOME DISPONIBLE (BOOLEAN)
echo "<p>Génome disponible :</p>";
echo "<input name='genome_disponible' type='radio' value='oui'>OUI";
echo "<input name='genome_disponible' type='radio' value='non'>NON";


//CHAMP POUR REFERENCE GENOME
echo "<p>Référence génome <i>(Obligatoire si génome disponible = oui)</i> :</p>";
echo "<textarea rows = '4' cols = '50' name='reference_genome' id='reference_genome' placeholder='entrez les informations ici...'></textarea>";


//BOUTONS POUR SEQUENCE GENOMIQUE COMPLETE (BOOLEAN)
echo "<p>Séquence génomique compléte :</p>";
echo "<input name='sequence_genomique_complete' type='radio' value='oui'>OUI";
echo "<input name='sequence_genomique_complete' type='radio' value='non'>NON";


//CHAMP POUR INFORMATION GENOMIQUE
echo "<p>Informations génomiques :</p>";
echo "<textarea rows = '4' cols = '50' name='informations_genomiques' id='informations_genomiques' placeholder='entrez les informations ici...'></textarea>";


//GC %
echo "<p>GC% : </p>";
echo "<textarea rows = '2' cols = '50' name='gc_pourcent' id='gc_pourcent' maxlength='100' placeholder='entrez les informations ici...'></textarea>";



echo "<p><u>Mode d'identification phylogénétique</u></p>";


//CHAMP POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - SEQUENCE MARQUEUR PHYLOGENETIQUE
echo "<p>Mode d'identification phylogénomique - Séquence de marqueurs phylogénétiques : </p>";
echo "<textarea rows = '10' cols = '50' name='taxo_id_phylogenomique_sequence_marqueur_phylogenetique' id='taxo_id_phylogenomique_sequence_marqueur_phylogenetique' placeholder='entrez les informations ici...'></textarea>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - DOMAINE
try {
    $requeteDomaineGNM = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenomique_domaine FROM souches ');
    $affichageDomaineGNM = $requeteDomaineGNM->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e8) {
    echo "Erreur : Domaine introuvable dans la BDD, récupération des données impossible";
}


//On parcourt $affichageDomaine et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Domaine : </p>";
echo "<select name='taxo_id_phylogenomique_domaine'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageDomaineGNM); ++$i) {
    echo '<option>' . $affichageDomaineGNM[$i]['taxo_id_phylogenomique_domaine'] . '</option>';
}
echo "</select>";

echo '<button type="button" id="showInputDomaineGNMButton" onclick="showInput(\'inputAddDomaineGNM\', \'hideInputDomaineGNMButton\', \'showInputDomaineGNMButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputDomaineGNMButton" onclick="hideInput(\'inputAddDomaineGNM\', \'hideInputDomaineGNMButton\', \'showInputDomaineGNMButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddDomaineGNM' name='taxo_id_phylogenomique_domaine_add' maxlength='50' size='50'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENOMIQUE - CLASSE]
try {
    $requeteClasseGNM = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenomique_classe_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_classe_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_classe_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_classe_d FROM souches');
    $affichageClasseGNM = $requeteClasseGNM->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e9) {
    echo "Erreur : Classe introuvable dans la BDD, récupération des données impossible";
}


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - CLASSE 1
//On parcourt $affichageClasseGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Classe 1 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNM); ++$i) {
    if (isset($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a']) && !empty($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'])) {
        echo '<option>' . $affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNMAButton" onclick="showInput(\'inputAddClasseGNMA\', \'hideInputClasseGNMAButton\', \'showInputClasseGNMAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNMAButton" onclick="hideInput(\'inputAddClasseGNMA\', \'hideInputClasseGNMAButton\', \'showInputClasseGNMAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNMA' name='taxo_id_phylogenomique_classe_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - CLASSE 2
//On parcourt $affichageClasseGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Classe 2 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNM); ++$i) {
    if (isset($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a']) && !empty($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'])) {
        echo '<option>' . $affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNMBButton" onclick="showInput(\'inputAddClasseGNMB\', \'hideInputClasseGNMBButton\', \'showInputClasseGNMBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNMBButton" onclick="hideInput(\'inputAddClasseGNMB\', \'hideInputClasseGNMBButton\', \'showInputClasseGNMBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNMB' name='taxo_id_phylogenomique_classe_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - CLASSE 3
//On parcourt $affichageClasseGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Classe 3 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNM); ++$i) {
    if (isset($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a']) && !empty($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'])) {
        echo '<option>' . $affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNMCButton" onclick="showInput(\'inputAddClasseGNMC\', \'hideInputClasseGNMCButton\', \'showInputClasseGNMCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNMCButton" onclick="hideInput(\'inputAddClasseGNMC\', \'hideInputClasseGNMCButton\', \'showInputClasseGNMCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNMC' name='taxo_id_phylogenomique_classe_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - CLASSE 4
//On parcourt $affichageClasseGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Classe 4 : </p>";
echo "<select name='taxo_id_phylogenomique_classe_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageClasseGNM); ++$i) {
    if (isset($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a']) && !empty($affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'])) {
        echo '<option>' . $affichageClasseGNM[$i]['taxo_id_phylogenomique_classe_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputClasseGNMButton" onclick="showInput(\'inputAddClasseGNMD\', \'hideInputClasseGNMDButton\', \'showInputClasseGNMButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputClasseGNMDButton" onclick="hideInput(\'inputAddClasseGNMD\', \'hideInputClasseGNMDButton\', \'showInputClasseGNMButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddClasseGNMD' name='taxo_id_phylogenomique_classe_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENOMIQUE - ORDRE]
try {
    $requeteOrdreGNM = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenomique_ordre_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_ordre_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_ordre_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_ordre_d FROM souches');
    $affichageOrdreGNM = $requeteOrdreGNM->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e11) {
    echo "Erreur : Ordre introuvable dans la BDD, récupération des données impossible";
}

//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ORDRE 1
//On parcourt $affichageOrdreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Ordre 1 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNM); ++$i) {
    if (isset($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a']) && !empty($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNMAButton" onclick="showInput(\'inputAddOrdreGNMA\', \'hideInputOrdreGNMAButton\', \'showInputOrdreGNMAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNMAButton" onclick="hideInput(\'inputAddOrdreGNMA\', \'hideInputOrdreGNMAButton\', \'showInputOrdreGNMAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNMA' name='taxo_id_phylogenomique_ordre_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ORDRE 2
//On parcourt $affichageOrdreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Ordre 2 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNM); ++$i) {
    if (isset($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a']) && !empty($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNMBButton" onclick="showInput(\'inputAddOrdreGNMB\', \'hideInputOrdreGNMBButton\', \'showInputOrdreGNMBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNMBButton" onclick="hideInput(\'inputAddOrdreGNMB\', \'hideInputOrdreGNMBButton\', \'showInputOrdreGNMBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNMB' name='taxo_id_phylogenomique_ordre_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ORDRE 3
//On parcourt $affichageOrdreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Ordre 3 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNM); ++$i) {
    if (isset($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a']) && !empty($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNMCButton" onclick="showInput(\'inputAddOrdreGNMC\', \'hideInputOrdreGNMCButton\', \'showInputOrdreGNMCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNMCButton" onclick="hideInput(\'inputAddOrdreGNMC\', \'hideInputOrdreGNMCButton\', \'showInputOrdreGNMCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNMC' name='taxo_id_phylogenomique_ordre_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ORDRE 4
//On parcourt $affichageOrdreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Ordre 4 : </p>";
echo "<select name='taxo_id_phylogenomique_ordre_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageOrdreGNM); ++$i) {
    if (isset($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a']) && !empty($affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'])) {
        echo '<option>' . $affichageOrdreGNM[$i]['taxo_id_phylogenomique_ordre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputOrdreGNMDButton" onclick="showInput(\'inputAddOrdreGNMD\', \'hideInputOrdreGNMDButton\', \'showInputOrdreGNMDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputOrdreGNMDButton" onclick="hideInput(\'inputAddOrdreGNMD\', \'hideInputOrdreGNMDButton\', \'showInputOrdreGNMDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddOrdreGNMD' name='taxo_id_phylogenomique_ordre_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENOMIQUE - GENRE]
try {
    $requeteGenreGNM = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenomique_genre_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_genre_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_genre_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_genre_d FROM souches');
    $affichageGenreGNM = $requeteGenreGNM->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e12) {
    echo "Erreur : Genre introuvable dans la BDD, récupération des données impossible";
}


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - GENRE 1
//On parcourt $affichageGenreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Genre 1 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNM); ++$i) {
    if (isset($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a']) && !empty($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'])) {
        echo '<option>' . $affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNMAButton" onclick="showInput(\'inputAddGenreGNMA\', \'hideInputGenreGNMAButton\', \'showInputGenreGNMAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNMAButton" onclick="hideInput(\'inputAddGenreGNMA\', \'hideInputGenreGNMAButton\', \'showInputGenreGNMAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNMA' name='taxo_id_phylogenomique_genre_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - GENRE 2
//On parcourt $affichageGenreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Genre 2 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNM); ++$i) {
    if (isset($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a']) && !empty($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'])) {
        echo '<option>' . $affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNMBButton" onclick="showInput(\'inputAddGenreGNMB\', \'hideInputGenreGNMBButton\', \'showInputGenreGNMBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNMBButton" onclick="hideInput(\'inputAddGenreGNMB\', \'hideInputGenreGNMBButton\', \'showInputGenreGNMBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNMB' name='taxo_id_phylogenomique_genre_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - GENRE 3
//On parcourt $affichageGenreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Genre 3 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNM); ++$i) {
    if (isset($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a']) && !empty($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'])) {
        echo '<option>' . $affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNMCButton" onclick="showInput(\'inputAddGenreGNMC\', \'hideInputGenreGNMCButton\', \'showInputGenreGNMCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNMCButton" onclick="hideInput(\'inputAddGenreGNMC\', \'hideInputGenreGNMCButton\', \'showInputGenreGNMCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNMC' name='taxo_id_phylogenomique_genre_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - GENRE 4
//On parcourt $affichageGenreGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Genre 4 : </p>";
echo "<select name='taxo_id_phylogenomique_genre_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageGenreGNM); ++$i) {
    if (isset($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a']) && !empty($affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'])) {
        echo '<option>' . $affichageGenreGNM[$i]['taxo_id_phylogenomique_genre_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputGenreGNMDButton" onclick="showInput(\'inputAddGenreGNMD\', \'hideInputGenreGNMDButton\', \'showInputGenreGNMDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputGenreGNMDButton" onclick="hideInput(\'inputAddGenreGNMD\', \'hideInputGenreGNMDButton\', \'showInputGenreGNMDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddGenreGNMD' name='taxo_id_phylogenomique_genre_d_add' maxlength='30' size='30'>";



//REQUÊTE POUR LES [MODE D'INDENTIFICATION PHYLOGENOMIQUE - ESPECE]
try {
    $requeteEspeceGNM = $dbSeqens->query('SELECT DISTINCT taxo_id_phylogenomique_espece_a FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_espece_b FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_espece_c FROM souches UNION SELECT DISTINCT taxo_id_phylogenomique_espece_d FROM souches');
    $affichageEspeceGNM = $requeteEspeceGNM->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e13) {
    echo "Erreur : Espece introuvable dans la BDD, récupération des données impossible";
}

//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ESPECE 1
//On parcourt $affichageEspeceGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Espece 1 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_a'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNM); ++$i) {
    if (isset($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a']) && !empty($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNMAButton" onclick="showInput(\'inputAddEspeceGNMA\', \'hideInputEspeceGNMAButton\', \'showInputEspeceGNMAButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNMAButton" onclick="hideInput(\'inputAddEspeceGNMA\', \'hideInputEspeceGNMAButton\', \'showInputEspeceGNMAButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNMA' name='taxo_id_phylogenomique_espece_a_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ESPECE 2
//On parcourt $affichageEspeceGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Espece 2 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_b'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNM); ++$i) {
    if (isset($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a']) && !empty($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNMBButton" onclick="showInput(\'inputAddEspeceGNMB\', \'hideInputEspeceGNMBButton\', \'showInputEspeceGNMBButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNMBButton" onclick="hideInput(\'inputAddEspeceGNMB\', \'hideInputEspeceGNMBButton\', \'showInputEspeceGNMBButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNMB' name='taxo_id_phylogenomique_espece_b_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ESPECE 3
//On parcourt $affichageEspeceGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Espece 3 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_c'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNM); ++$i) {
    if (isset($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a']) && !empty($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNMCButton" onclick="showInput(\'inputAddEspeceGNMC\', \'hideInputEspeceGNMCButton\', \'showInputEspeceGNMCButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNMCButton" onclick="hideInput(\'inputAddEspeceGNMC\', \'hideInputEspeceGNMCButton\', \'showInputEspeceGNMCButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNMC' name='taxo_id_phylogenomique_espece_c_add' maxlength='30' size='30'>";


//MENU DEROULANT POUR MODE D'INDENTIFICATION PHYLOGENOMIQUE - ESPECE 4
//On parcourt $affichageEspeceGNM et pour chaque item qu'il contient on ajoute une option au menu déroulant
echo "<p>Mode d'identification phylogénomique - Espece 4 : </p>";
echo "<select name='taxo_id_phylogenomique_espece_d'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichageEspeceGNM); ++$i) {
    if (isset($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a']) && !empty($affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'])) {
        echo '<option>' . $affichageEspeceGNM[$i]['taxo_id_phylogenomique_espece_a'] . '</option>';
    }
}
echo "</select>";

echo '<button type="button" id="showInputEspeceGNMDButton" onclick="showInput(\'inputAddEspeceGNMD\', \'hideInputEspeceGNMDButton\', \'showInputEspeceGNMDButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputEspeceGNMDButton" onclick="hideInput(\'inputAddEspeceGNMD\', \'hideInputEspeceGNMDButton\', \'showInputEspeceGNMDButton\')">Annuler</button>';

echo "<input type='text' style='visibility: hidden' id='inputAddEspeceGNMD' name='taxo_id_phylogenomique_espece_d_add' maxlength='30' size='30'>";


//CHAMP POUR POURCENT ID
echo "<p>Mode d'identification phylogénomique - %ID : </p>";
echo "<input name='taxo_id_phylogenomique_pourcent_id' type='number' id='taxo_id_phylogenomique_pourcent_id' max='100' step='0,01' size='6'>";


//CHAMP POUR POURCENT COVER
echo "<p>Mode d'identification phylogénomique - %COVER : </p>";
echo "<input name='taxo_id_phylogenomique_pourcent_cover' type='number' id='taxo_id_phylogenomique_pourcent_cover' max='100' step='0,01' size='6'>";


//CHAMP POUR DATE BLAST
echo "<p>Mode d'identification phylogénomique - Date blast :</p>";
echo "<input type='date' name='taxo_id_phylogenomique_date_blast' value=''>";


//CHAMP POUR SOURCE
echo "<p>Mode d'identification phylogénomique - Source : </p>";
echo "<textarea rows = '2' cols = '50' name='taxo_id_phylogenomique_source' id='taxo_id_phylogenomique_source' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


//CHAMP PROJET
echo "<p>Mode d'identification phylogénomique - Projet : </p>";
echo "<textarea rows = '2' cols = '50' name='taxo_id_phylogenomique_projet' id='taxo_id_phylogenomique_projet' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


//CHAMP REMARQUES
echo "<p>Remarques : </p>";
echo "<textarea rows = '10' cols = '50' name='taxo_remarques' id='taxo_remarques' maxlength='500' placeholder='entrez les informations ici...'></textarea>";
?>

<h2>Phénotype - Génotype</h2>

<?php
//BOUTONS POUR SOUCHE BM (BOOLEAN)
echo "<p>Souche BM :</p>";
echo "<input name='pheno_genotype_souche_bm' type='radio' value='oui'>OUI";
echo "<input name='pheno_genotype_souche_bm' type='radio' value='non'>NON";


//MENU DEROULANT POUR LA PURETE
try {
    $requetePurete = $dbSeqens->query('SELECT DISTINCT pheno_genotype_purete FROM souches ');
    $affichagePurete = $requetePurete->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e15) {
    echo "Erreur : Pureté introuvable dans la BDD, récupération des données impossible";
}

//ON PARCOURT $AFFICHAGEPATHOGENECITE ET POUR CHAQUE ITEM QU'IL CONTIENT ON AJOUTE UNE OPTION AU MENU DÉROULANT
echo "<p>Pureté : </p>";
echo "<select name='pheno_genotype_purete'>";
echo "<option disabled='disabled' selected='selected'>Sélectionnez</option>";
for ($i = 0; $i < sizeof($affichagePurete); ++$i) {
    echo '<option>' . $affichagePurete[$i]['pheno_genotype_purete'] . '</option>';
}
echo "</select>";


//BOUTON POUR AJOUTER UNE VALEUR QUI N'EST PAS PRÉSENTE DANS LE MENU DÉROULANT
echo '<button type="button" id="showInputPureteButton" onclick="showInput(\'inputAddPurete\', \'hideInputPureteButton\', \'showInputPureteButton\')">+</button>';
echo '<button type="button" style="visibility: hidden" id="hideInputPureteButton" onclick="hideInput(\'inputAddPurete\', \'hideInputPureteButton\', \'showInputPureteButton\')">Annuler</button>';


//CHAMP DE TEXTE QUI NE S'AFFICHE QUE QUAND ON CLIQUE SUR LE BOUTON
echo "<input type='text' style='visibility: hidden' id='inputAddPurete' name='pheno_genotype_purete_add' maxlength='20' size='20'>";


//BOUTONS POUR PURIFIEE (BOOLEAN)
echo "<p>Purifiée :</p>";
echo "<input name='pheno_genotype_purifiee' type='radio' value='oui'>OUI";
echo "<input name='pheno_genotype_purifiee' type='radio' value='non'>NON";


//NUMERO SOUCHE PURIFIE
echo "<p> Numéro souche(s) purifié(s) :</p>";
echo "<input type='text' name='pheno_genotype_numero_souche_purifiee' maxlength='20' size='20'>";


//CHAMP REILSOLE PAR
echo "<p>Réisolé par : </p>";
echo "<textarea rows = '2' cols = '50' name='pheno_genotype_reisole_par' id='pheno_genotype_reisole_par' maxlength='100' placeholder='entrez les informations ici...'></textarea>";


MenuDeroulant("Flagellum Arrangement","phenotype_flagellum_arrangement","souches","FlagellumArrangement",10000,50, $dbSeqens)














?>
</br></br></br>
</body >
</html>

