<?php
require '../../config.php';
$obligation = True;

//Traitement du Numéro Interne de Plasmide
if (!empty($_POST['plasmide']) && isset($_POST['plasmide'])) {
    $plasmide = $_POST['plasmide'];
} else {
    echo "VOUS DEVEZ RENSEIGNER UN PLASMIDE<br>";
    $obligation = False;
}

//Traitement du nombre de tubes crées
if (!empty($_POST['nombre_tubes_crees']) && isset($_POST['nombre_tubes_crees'])) {
    $nombre_tubes_crees = $_POST['nombre_tubes_crees'];
} else {
    echo "VOUS DEVEZ ENTRER LE NOMBRE DE TUBES CREES<br>";
    $obligation = False;
}


//Traitement de la date de création
if (!empty($_POST['date_creation_lot']) && isset($_POST['date_creation_lot'])) {
    $dateCreation = $_POST['date_creation_lot'];
} elseif (!empty($_POST['date_creation_lot']) && isset($_POST['date_creation_lot'])) {
    $dateCreation = $_POST['date_creation_lot'];
} else {
    echo "VOUS DEVEZ ENTRER UNE DATE DE CREATION <br>";
    $obligation = False;
}


//Traitement de l'opérateur
if (!empty($_POST['operateur_add']) && isset($_POST['operateur_add'])) {
    $operateur = $_POST['operateur_add'];
} elseif (!empty($_POST['operateur']) && isset($_POST['operateur'])) {
    $operateur = $_POST['operateur'];
} else {
    $operateur = NULL;
}

//Traitement du protocole
if (!empty($_POST['protocole']) && isset($_POST['protocole'])) {
    $protocole = $_POST['protocole'];
} elseif (!empty($_POST['protocole']) && isset($_POST['protocole'])) {
    $protocole = $_POST['protocole'];
} else {
    echo "VOUS DEVEZ ENTRER LA RESISTANCE ANTIBIOTIQUE <br>";
    $obligation = False;
}

if ($obligation) {
    $insert = $dbSeqens->prepare('INSERT INTO lots_plasmides (plasmide,  nombre_tubes_crees, date_creation_lot, operateur, protocole) VALUES (?,?,?,?,?)');
    $insert->execute(array($plasmide, $nombre_tubes_crees, $dateCreation, $operateur, $protocole));

} else {
    echo "ERREUR : DONNEES NON INSEREES";
}


?>
<br>
<a href="../lots_plasmides.php">Retour !</a>
