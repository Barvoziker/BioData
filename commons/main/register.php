<?php
session_start();


//Verify if email or username are already taken
if (isset($_SESSION['mailDuplicate'])) {
    $mailDuplicate = $_SESSION['mailDuplicate'];
} else {
    $mailDuplicate = false;
}

if (isset($_SESSION['userDuplicate'])) {
    $userDuplicate = $_SESSION['userDuplicate'];
} else {
    $userDuplicate = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../../assets/css/connexion.css"/>
    <script src="../../assets/javascript/connexion.js" async></script>
</head>

<body>

<!-- background div -->
<div id="blur">

    <!-- div of profile pic -->
    <div id="userDiv">
        <img src="../../assets/img/user.png" alt="user" id="userLogo">
    </div>

    <!-- connexion container -->
    <div id="connectTriangle"></div>
    <div style="height: 410px" id="connectContainer">

        <form method="post" action="../insert_values/processing/_register_processing.php">
            <img src="../../assets/img/userSmall.png" alt="userSmall" class="logoContainer" id="userSmall">
            <input name="inputID" value="" type="text" id="inputID" placeholder="User" required="required">

            <img src="../../assets/img/mail.png" alt="mail" class="logoContainer">
            <input name="inputMail" value="" type="email" id="inputEmail" placeholder="Email" required="required">

            <img src="../../assets/img/lock2.png" alt="lock2" class="logoContainer">
            <input name="inputPassword" value="" type="password" id="inputPassword" placeholder="Password"
                   required="required">

            <button type="submit" id="connectButton">Register</button>

            <p style="margin: 30px 0 0 0; left: 110px">Already have an account ?</p>
            <a style="bottom: 20px; left: 305px" href="connexion.php">Login here</a>

            <?php
            if ($mailDuplicate) {
                echo '<p style="color: red">Email already taken, Please choose another one</p>';
            }

            if ($userDuplicate) {
                echo '<p style="color: red">Username already taken, Please choose another one</p>';
            }
            ?>
        </form>
