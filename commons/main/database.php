<?php
session_start();
require '../config.php';
include '../../commons/header.php';
require './tabTable.php';

if (isset($_SESSION['removeDone'])){
    if ($_SESSION['removeDone']){
        echo '<script src="../../assets/javascript/refresh.js" async></script>';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DataBase</title>
    <link rel="stylesheet" href="../../assets/css/header.css"/>
    <link rel="stylesheet" href="../../assets/css/table.css">
    <script src="../../assets/javascript/portal.js" ></script>

</head>
<body>

<?php

// Recherche
//Communication with the table
//$recupération est un entier qui permet de récupérer le bon index dans le tableau
//$table correspond au nom de la table souhaitée dans la base de données
if (isset($_POST['select']) || isset($_POST['table'])) {
    if (isset($_POST['select'])) {
        $recuperation = $_POST['select'];
        $table = $tabTables[$recuperation];
    } else if (isset($_POST['table'])) {
        $table = $_POST['table'];
    }
    $headTab = $dbSeqens->query('SHOW TABLES FROM bdd_seqens ');
    $affichage_label = $headTab->fetchAll(PDO::FETCH_ASSOC);


    //Show table columns
    if (count($affichage_label)) {
        echo '<table><tr><th></th>';

        $reponse = $dbSeqens->query("SHOW COLUMNS FROM " . $table);
        while ($donnees_label = $reponse->fetch()) {
            echo '<th scope="col">' . $donnees_label['Field'] . '</th>';
        }

        //On fait une requête pour récupérer les données sous forme de tableau à index numérique
        //Plus simple pour traiter les données ensuite
        $requete_donnees = $dbSeqens->query("SELECT * FROM " . $table);
        $donnees = $requete_donnees->fetchAll(PDO::FETCH_NUM);


        //On crée une autre version de la première requête en tableau associatif
        $requete_donnees_assoc = $dbSeqens->query("SELECT * FROM " . $table);
        $donnees_assoc = $requete_donnees_assoc->fetchAll(PDO::FETCH_ASSOC);
        //On récupère les clés du premier tableau, qui correspond à la première donnée entrée dans la BDD
        $donnees_cles = array_keys($donnees_assoc[0]);
        //On récupère la première valeur de ce tableau qui correspond à la première colonne, qui est toujours la clé primaire, et on la stocke
        $primary_key = $donnees_cles[0];


        echo '<form action="search.php" method="GET">
               <input type="search" name="q" placeholder="Recherche..." required/>
               <input type="hidden" name="t" value="' . $table . '"/>';
        echo "<select name='sB' required>";
        echo "<option disabled='disabled' selected='selected'>--Search By--</option>";
        for ($i = 0; $i < sizeof($donnees_cles); ++$i) {
            echo '<option>' . $donnees_cles[$i] . '</option>';
        }
        echo "</select>";
        echo "<select name='srt' required>";
        echo "<option disabled='disabled' selected='selected'>--Sort By--</option>";
        for ($i = 0; $i < sizeof($donnees_cles); ++$i) {
            echo '<option>' . $donnees_cles[$i] . '</option>';
        }
        echo "</select>";
        echo "<input type='radio' id='searchType' name='sT' value='contains' required>Contain ";
        echo "<input type='radio' id='searchType' name='sT' value='exact'>Exactly equal ";
        echo '<input type="submit" value="Valider" />';
        echo '</form>';

        echo "<p>" . ucfirst($table) . "</p>";

        echo "<form method='post' action='../insert_values/processing/_remove_processing.php'>";
        //Le premier for crée une boucle qui affiche chaque ligne
        for ($i = 0; $i < sizeof($donnees); $i++) {
            echo '<tr>';
            echo '<td scope="col"><input type="checkbox" name="remove[]" value="DELETE FROM `'
                . $table . '` WHERE `' . $primary_key . '`=\'' . $donnees[$i][0] . '\' ;"></td>';
            //Le second for crée une boucle qui affiche chaque case de la ligne
            for ($j = 0; $j < sizeof($donnees[$i]); $j++) {
                echo '<td scope="col">' . $donnees[$i][$j] . '</td>';
            }
            echo '</tr>';
        }
        echo '</tr></table>';
        echo '<button type="submit" id="connectButton">Remove !</button>';
        echo '</form>';
    }
}

?>
</body>
</html>


