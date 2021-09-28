<?php
$usernameSession = null;
$verifyHeader = false;

if (isset($_SESSION['userID'])){
    $usernameSession = $_SESSION['userID'];
}

try {
    $checkUserHeader = $dbAccount->prepare('SELECT role FROM comptes WHERE utilisateur = ?');
    $checkUserHeader->execute([$usernameSession]);
    $roleUserHeader = $checkUserHeader->fetch();
} catch (Exception $e){
    echo $e;
}

if (isset($roleUserHeader)){
    if ($roleUserHeader[0] === "administrator"){
        $verifyHeader = true;
    }
}
?>
<!--link all css files and javascript files-->
<link rel="stylesheet" href="../../assets/css/header.css"/>
<link rel="stylesheet" href="../../assets/css/dropdownMenu.css"/>
<link rel="stylesheet" href="../../assets/css/switchDarkMode.css"/>
<script src="../../assets/javascript/switchDarkMode.js" async></script>

<!--header-->
<header>
    <div id="headerContainer">

        <div id="headerLogo">
            <a href="../../commons/main/portal.php"><img src="../../assets/img/proteusDark.png" alt="logoProteus" id="logoProteus"></a>
        </div>

        <div id="menu1" class="menuElements">
            <a href="http://localhost/exo/Site_BioD/commons/main/bdd.php" class="menuText">DATABASE</a>
        </div>

        <div id="menu2" class="menuElements">
            <a href="" class="menuText">HISTORY</a>
        </div>

        <!--button for switch between day and night-->
        <label class="switch">
            <div>
                <input type="checkbox" id="checkbox"/>
                <span class="slider round"></span>
            </div>
        </label>

        <!--user icon-->
        <div id="userIcon">
            <img src="../../assets/img/profilePic.png" alt="profilePicture" id="profilePic">
        </div>

        <!--creation of dropdown menu-->
        <div class="dropdown toggle">
            <input id="t1" type="checkbox">
            <label for="t1" id="label"><img src="../../assets/img/menuDark.png" alt="menuButton" id="menuButton"></label>
            <ul>
                <li><a href="#">Account</a></li>
                <li><a href="#">Preference</a></li>
                <?php
                    if($verifyHeader) {
                        echo '<li ><a href = "./manage.php">Manage</a ></li>';
                    }
                ?>
                <li><a href="../../commons/insert_values/processing/_disconnect_processing.php" id="disconnect">Disconnect</a></li>
            </ul>
        </div>
    </div>
</header>


