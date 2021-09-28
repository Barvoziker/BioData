<?php
session_start();
require '../../config.php';

$username = null;
$role = null;
$_SESSION['doneManage'] = null;

if (isset($_POST['selectedID']) && isset($_POST['selectedRole'])){
    $username = $_POST['selectedID'];
    $role = $_POST['selectedRole'];
}

if (isset($username) && isset($role)){

    $insert = $dbAccount->prepare('UPDATE comptes SET role=? WHERE utilisateur=?');
    $insert->execute([$role, $username]);

    $_SESSION['doneManage'] = [$username, $role];

    header("Location: ../../main/manage.php");
}