<?php
session_start();
require '../config.php';

if (!isset($_SESSION['connected']) || !$_SESSION['connected']) {
    header("Location: ./connexion.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Portal</title>
    <link rel="stylesheet" href="../../assets/css/portal.css"/>
    <link rel="stylesheet" href="../../assets/css/header.css"/>
    <script src="../../assets/javascript/portal.js" ></script>
</head>

<?php include '../header.php' ?>
<body>
<div id="background">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
</div>
<div id="centerNav">
    <div class="navButtons">
        <a href="bdd.php">
        <img src="../../assets/img/database.png" alt="database">
        <p>DATABASE</p>
        </a>
    </div>
    <div class="navButtons">
        <a href="">
        <img src="../../assets/img/history.png" alt="history">
        <p>HISTORY</p>
        </a>
    </div>
</div>
</body>

</html>