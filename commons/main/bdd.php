<?php
session_start();
require '../config.php';
include '../../commons/header.php';

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choice</title>
    <link rel="stylesheet" href="../../assets/css/header.css"/>
</head>
<body>

<h1>Choose your table</h1>

<form method="post">

    <?php
    require './tabTable.php';

    for ($i = 0; $i < sizeOf($tabTables); $i++) {

        echo "<input type='radio' name='select' value = '$i' id='table$i'>" . ucfirst(str_replace('_', ' ', $tabTables[$i])) . "<br>";

    }
    ?>

    <button type="submit" formaction="../../commons/insert_values/processing/_edit_processing.php" id="Edit">Insert</button>
    <button type="submit" formaction="database.php" id="Read">Read</button>
</form>

</body>
