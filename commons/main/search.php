<?php
include '../../commons/header.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DataBase</title>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
<?php

$bdd = new PDO('mysql:host=localhost;dbname=bdd_seqens', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_GET['t']) && ((isset($_GET['q']) && !empty($_GET['q'])) || ($_GET['q'] === "0")) && isset($_GET['sB']) && !empty($_GET['sB']) && isset($_GET['sT']) && !empty($_GET['sT'])) {
    $q = htmlspecialchars($_GET['q']);
    $table = $_GET['t'];
    $searchBy = $_GET['sB'];
    $searchType = $_GET['sT'];

    $headTab = $bdd->query('SHOW TABLES FROM bdd_seqens ');
    $affichage_label = $headTab->fetchAll(PDO::FETCH_ASSOC);


//On crée une autre version de la première requête en tableau associatif
    $search_donnees_assoc = $bdd->query("SELECT * FROM " . $table);
    $search_assoc = $search_donnees_assoc->fetchAll(PDO::FETCH_ASSOC);
//On récupère les clés du premier tableau, qui correspond à la première donnée entrée dans la BDD
    $search_cles = array_keys($search_assoc[0]);

//Order By

    if(isset($_GET['srt']) && $_GET['srt'] !== null && !empty($_GET['srt'])) {
        if (true) {
            $sortBy = $_GET['srt'];

            if ($searchType === 'contains') {
                $search_query = $bdd->query('SELECT * FROM ' . $table . ' WHERE ' . $searchBy . ' LIKE \'%' . $q . '%\' ORDER BY ' . $sortBy);
                $search = $search_query->fetchAll(PDO::FETCH_NUM);
            } else if ($searchType === 'exact') {
                $search_query = $bdd->query('SELECT * FROM ' . $table . ' WHERE ' . $searchBy . ' LIKE \'' . $q . '\' ORDER BY ' . $sortBy);
                $search = $search_query->fetchAll(PDO::FETCH_NUM);
            } else {
                $search_query = null;
            }
        }
    } else if ($searchType === 'contains') {
        $search_query = $bdd->query('SELECT * FROM ' . $table . ' WHERE ' . $searchBy . ' LIKE \'%' . $q . '%\'');
        $search = $search_query->fetchAll(PDO::FETCH_NUM);
    } else if ($searchType === 'exact') {
        $search_query = $bdd->query('SELECT * FROM ' . $table . ' WHERE ' . $searchBy . ' LIKE \'' . $q . '\'');
        $search = $search_query->fetchAll(PDO::FETCH_NUM);
    } else {
        $search_query = null;
    }

    //FORMULAIRE DE RECHERCHE

    echo '<form action="search.php" method="GET">
               <input type="search" name="q" placeholder="Recherche..." required/>
               <input type="hidden" name="t" value="' . $table . '"/>';
    echo "<select name='searchBy' required>";
    echo "<option disabled='disabled' selected='selected'>Search By</option>";
    for ($i = 0; $i < sizeof($search_cles); ++$i) {
        echo '<option>' . $search_cles[$i] . '</option>';
    }
    echo "</select>";
    echo "<input type='radio' id='searchType' name='sT' value='contains' required>Contain ";
    echo "<input type='radio' id='searchType' name='sT' value='exact'>Exactly equal ";
    echo '<input type="submit" value="Valider" />';
    echo '</form>';

    //FIN DU FORMULAIRE DE RECHERCHE

} else {
    $search_query = null;
}

echo "<p>" . ucfirst($table) . "</p>";

if ($search_query != null) {
    if ($search_query->rowCount() > 0) {
        if (count($affichage_label)) {
            echo '<table><tr><th></th>';

            $reponse = $bdd->query("SHOW COLUMNS FROM " . $table);
            while ($donnees_label = $reponse->fetch()) {
                echo '<th scope="col">' . $donnees_label['Field'] . '</th>';
            }
            echo "<form method='post' action='../insert_values/processing/_remove_processing.php'>";
            //Le premier for crée une boucle qui affiche chaque ligne
            for ($i = 0; $i < sizeof($search); $i++) {
                echo '<tr>';
                echo '<td scope="col"><input type="checkbox" name="remove[]" value="DELETE FROM `' . $table . '` WHERE `' . $searchBy . '`=\'' . $search[$i][0] . '\' ;"></td>';
                //Le second for crée une boucle qui affiche chaque case de la ligne
                for ($j = 0; $j < sizeof($search[$i]); $j++) {
                    echo '<td scope="col">' . $search[$i][$j] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tr></table>';
            echo '<button type="submit" id="connectButton">Remove !</button>';
            echo '</form>';
        }
    } else {
        echo 'Aucun résultat pour la recherche : ' . $q . ' dans la table ' . $searchBy;
    }
} else {
    if (!isset($_GET['sB'])) {
        echo '<p style="color: red">Error: please select a column</p>';
    } else if (isset($_GET['sB'])) {
        if ($_GET['sB'] == null || empty($_GET['sB'])) {

            echo '<p style="color: red">Error: please select a column</p>';
        }
    }

    if (!isset($_GET['sT'])) {
        echo '<p style="color: red">Error: please select a search method</p>';
    } else if (isset($_GET['sT'])) {
        if ($_GET['sT'] == null || empty($_GET['sT'])) {

            echo '<p style="color: red">Error: please select a search method</p>';
        }
    }


    echo '<button onclick="window.history.go(-1)">Try again</button>';
}

if (isset($table)) {
    echo '<form action="database.php" method="POST">
    <input type="hidden" name="table" value="' . $table . '"/>
    <button type="submit"> Go Back </button>
</form>';
}

?>
</body>
</html>