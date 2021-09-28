<?php
session_start();

if (isset($_SESSION['connected'])) {
    $connected = $_SESSION['connected'];

} else {
    $connected = false;
}

if (isset($_SESSION['connectionFailed'])) {
    $connectionFailed = $_SESSION['connectionFailed'];
} else {
    $connectionFailed = false;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
    <div id="connectContainer">

        <form method="post" action="../insert_values/processing/_connexion_processing.php">
            <img src="../../assets/img/userSmall.png" alt="userSmall" class="logoContainer" id="userSmall">
            <input name="inputID" value="" type="text" id="inputID" placeholder="User" required="required">

            <img src="../../assets/img/lock2.png" alt="lock2" class="logoContainer">
            <input name="inputPassword" value="" type="password" id="inputPassword" placeholder="Password" required="required">

            <button type="submit" id="connectButton">Sign in</button>

            <p style="margin: 30px 0 0 0; left: 110px">Don't have an account ?</p>
            <a style="bottom: 20px; left: 285px" href="register.php">Register here</a>

        </form>

        <?php
        if ($connected) {
            header("Location: ./portal.php");
        } else if ($connectionFailed) {
            echo "<p style='color:red'> Invalid Username or Password, please try again.</p>";
            $_SESSION['connectionFailed'] = false;
        }

        ?>
    </div>

</div>


</body>
</html>