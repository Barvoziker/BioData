<?php
require '../../config.php';
$obligation = True;

//Traitement du Numéro Interne de Plasmide
if (!empty($_POST['numero_interne_plsm']) && isset($_POST['numero_interne_plsm'])){
    $numeroInternePLSM = 'PLSM_' . $_POST['numero_interne_plsm'];
} else {
    echo "VOUS DEVEZ ENTRER UN NUMERO INTERNE DE PLASMIDE<br>";
    $obligation = False;
}



//Traitement du Nom du Clone
if (!empty($_POST['nom_clone']) && isset($_POST['nom_clone'])){
    $nomClone = $_POST['nom_clone'];
} else {
    echo "VOUS DEVEZ ENTRER LE NOM DU CLONE<br>";
    $obligation = False;
}



//Traitement du Vecteur de Clonage
if (!empty($_POST['vecteur_clonage_add']) && isset($_POST['vecteur_clonage_add'])) {
    $vecteurClonage = $_POST['vecteur_clonage_add'];
} elseif (!empty($_POST['vecteur_clonage']) && isset($_POST['vecteur_clonage'])) {
    $vecteurClonage = $_POST['vecteur_clonage'];
} else {
    echo "VOUS DEVEZ ENTRER LE VECTEUR <br>";
    $obligation = False;
}



//Traitement du Type de vecteur
if (!empty($_POST['type_vecteur_add']) && isset($_POST['type_vecteur_add'])) {
    $typeVecteur = $_POST['type_vecteur_add'];
} elseif (!empty($_POST['type_vecteur']) && isset($_POST['type_vecteur'])) {
    $typeVecteur = $_POST['type_vecteur'];
} else {
    $typeVecteur = NULL;
}



//Traitement de la Résistance Antibiotique
if (!empty($_POST['resistance_antibiotique_add']) && isset($_POST['resistance_antibiotique_add'])) {
    $resistanceAntibiotique = $_POST['resistance_antibiotique_add'];
} elseif (!empty($_POST['resistance_antibiotique']) && isset($_POST['resistance_antibiotique'])) {
    $resistanceAntibiotique = $_POST['resistance_antibiotique'];
} else {
    echo "VOUS DEVEZ ENTRER LA RESISTANCE ANTIBIOTIQUE <br>";
    $obligation = False;
}



//Traitement de Gène Synthétique ou PCR
if (!empty($_POST['gene_synthetique_pcr']) && isset($_POST['gene_synthetique_pcr'])){
    $geneSynthetiquePCR = $_POST['gene_synthetique_pcr'];
} else {
    echo "VOUS DEVEZ PRECISER GENE SYNTHETIQUE OU PCR<br>";
    $obligation = False;
}



//Traitement de Gène Optimisé
if (!empty($_POST['gene_optimise']) && isset($_POST['gene_optimise'])) {
    if($_POST['gene_optimise'] == 'Oui') {
        $geneOptimise = True;
    } elseif ($_POST['gene_optimise'] == 'Non'){
        $geneOptimise = False;
    }
} else {
    echo "VOUS DEVEZ RENSEIGNER SI LE GENE EST OPTIMISE <br>";
    $obligation = False;
}



//Traitement de Numéro de Boîte de Stockage
if (!empty($_POST['numero_boite_stockage']) && isset($_POST['numero_boite_stockage'])){
     $numeroBoiteStockage = (int)$_POST['numero_boite_stockage'];
} else {
    echo "VOUS DEVEZ PRECISER LE NUMERO DE BOITE DE STOCKAGE SOUS FORME D'UN ENTIER<br>";
    $obligation = False;
}



//Traitement de Position du Cryotube
if (!empty($_POST['position_cryotube']) && isset($_POST['position_cryotube'])){
    $positionCryotube = $_POST['position_cryotube'];
} else {
    echo "VOUS DEVEZ PRECISER LA POSITION DU CRYOTUBE<br>";
    $obligation = False;
}



if ($obligation) {
    $insert = $dbSeqens->prepare('INSERT INTO plasmitheque (numero_interne_plsm , nom_clone, vecteur_clonage, type_vecteur_nb_copie, resistance_antibiotique, gene_synthetique_pcr, gene_optimise, numero_boite_stockage, position_cryotube) VALUES (?,?,?,?,?,?,?,?,?)');
    $insert->execute(array($numeroInternePLSM, $nomClone, $vecteurClonage, $typeVecteur, $resistanceAntibiotique, $geneSynthetiquePCR, $geneOptimise, $numeroBoiteStockage, $positionCryotube));

} else {
    echo "ERREUR : DONNEES NON INSEREES";
}


?>
<br>
<a href="../plasmitheque.php">Retour !</a>
