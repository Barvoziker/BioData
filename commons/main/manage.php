<?php
session_start();
require '../config.php';

$done = false;
$username = null;

if (isset($_SESSION['userID'])) {
    $username = $_SESSION['userID'];
} else if (!isset($_SESSION['userID'])) {
    header("Location: ./portal.php");
}

if (isset($role)) {
    if ($role[0] !== 'administrator') {
        header("Location: ./portal.php");
    }
}

if (isset($_SESSION['doneManage'])) {
    $name = $_SESSION['doneManage'][0];
    $setRole = $_SESSION['doneManage'][1];
$done = true;
}
?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage</title>
    <link rel="stylesheet" href="../../assets/css/header.css"/>
    <link rel="stylesheet" href="../../assets/css/manage.css"/>
    <script src="../../assets/javascript/dropdownSearch.js" async></script>
</head>
<header>
    <?php
    include '../header.php';
    ?>
</header>
<body>
<form method="POST" action="../insert_values/processing/_manage_processing.php">
    <label for="select-account">Choose account : </label>
    <input list="account-list" id="select-account" name="selectedID" required/>

    <datalist id="account-list">
        <?php
        $requeteUsers = $dbAccount->query("SELECT utilisateur FROM comptes");
        $affichageUsers = $requeteUsers->fetchAll(PDO::FETCH_ASSOC);

        $requeteRoles = $dbAccount->query("SELECT role FROM comptes");
        $affichageRoles = $requeteRoles->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($affichageUsers); ++$i) {
            echo "<option value='{$affichageUsers[$i]['utilisateur']}'</option>";
            echo $affichageRoles[$i]['role'];
        }
        ?>
    </datalist>

    <select name='selectedRole'>
        <option disabled='disabled' selected='selected' value="">Choose</option>
        <option value="readonly">Read-only</option>
        <option value="editPlamistheque">Edit Plamistheque</option>
        <option value="editEnzymatheque">Edit Enzymatheque</option>
        <option value="editSouches">Edit Souches</option>
        <option value="administrator">Administrator</option>
    </select>

    <button type="submit" id="confirmButton">Confirm !</button>

</form>

<?php
if ($done){
    echo "<p style='color:green'>$name is now a $setRole !</p>";
}
?>
</body>
</html>

