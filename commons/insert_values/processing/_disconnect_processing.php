<?php
session_start();

if (isset($_SESSION['connected'])) {
    session_destroy();
    unset($_SESSION['connected']);
    header("Location: ../../main/connexion.php");
} else {
    header("Location: ../../main/connexion.php");
}
