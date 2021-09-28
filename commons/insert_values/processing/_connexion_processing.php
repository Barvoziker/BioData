<?php
session_start();
require '../../config.php';
$_SESSION['connected'] = false;
$_SESSION['connectionFailed'] = false;

$hash = $dbAccount->query('SELECT mot_de_passe FROM comptes');
$hashPassword = $hash->fetchAll(PDO::FETCH_ASSOC);
$test = password_hash($_POST['inputPassword'],PASSWORD_DEFAULT);

//check if is okay
if (isset($_POST["inputID"], $_POST['inputPassword'])) {

    $searchUser = $dbAccount->query('SELECT utilisateur FROM comptes ');
    $connectedUser = $searchUser->fetchAll(PDO::FETCH_ASSOC);

    $usernameCheck = false;
    $passwordCheck = false;
    $username = null;
    $password = null;

    for ($i = 0; $i < sizeof($connectedUser); $i++) {

        foreach ($connectedUser[$i] as $key => $item) {

            if ($_POST["inputID"] === $item){
                $usernameCheck = true;
                $username = $item;
                //Vérificaiton des droits
                $_SESSION['userID'] = $item;
            } else {
                $_SESSION['connectionFailed'] = true;
                header("Location: ../../main/connexion.php");
            }

        }
    }

    $searchPassword = $dbAccount->prepare('SELECT mot_de_passe FROM comptes WHERE utilisateur = ?');
    $searchPassword->execute(array($username));

    $connectedPassword = $searchPassword->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($connectedPassword); $i++) {

        foreach ($connectedPassword[$i] as $key => $item) {

            if (password_verify($_POST['inputPassword'], $item)){
                $verifyPassword = password_verify($_POST['inputPassword'], $item);
                $passwordCheck = true;
                $password = $item;
            } else {
                $_SESSION['connectionFailed'] = true;
                header("Location: ../../main/connexion.php");
            }

        }
    }

if ($usernameCheck === true && $passwordCheck === true){
    $_SESSION['connected'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header("Location: ../../main/connexion.php");
}

}