<?php
session_start();
require '../../config.php';

if (isset($_POST['inputID'], $_POST['inputPassword'], $_POST['inputMail'])) {

    $_SESSION['mailDuplicate'] = false;
    $_SESSION['userDuplicate'] = false;

    $email = $_POST['inputMail'];
    $username = $_POST['inputID'];
    $password = password_hash($_POST['inputPassword'], PASSWORD_DEFAULT);

    $verif_mail = $dbAccount->prepare('SELECT * FROM comptes WHERE adresse_mail=?');
    $verif_mail->execute([$email]);
    $mail = $verif_mail->fetch();

    $verif_id = $dbAccount->prepare('SELECT * FROM comptes WHERE utilisateur=?');
    $verif_id->execute([$username]);
    $user = $verif_id->fetch();

    if ($mail) {
        $_SESSION['mailDuplicate'] = true;
        header("Location: ../../main/register.php");

    } else if ($user) {
        $_SESSION['userDuplicate'] = true;
        header("Location: ../../main/register.php");
    } else {

        $insert = $dbAccount->prepare('INSERT INTO comptes (utilisateur, mot_de_passe, adresse_mail, role) VALUES (?,?,?,?)');
        $insert->execute(array($username, $password, $email, 'readonly'));
        header("Location: ../../main/connexion.php");
    }
}