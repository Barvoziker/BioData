<?php
session_start();
require '../../config.php';

$_SESSION['removeDone'] = false;

if (isset($_POST['remove'])) {
    $checked_arr = $_POST['remove'];
    for ($i = 0; $i < sizeof($checked_arr); ++$i) {
        $req = $dbSeqens->query($checked_arr[$i]);
        $remove_values = $req->fetchAll(PDO::FETCH_NUM);
    }

    $_SESSION['removeDone'] = true;
    echo "<script>
    window.history.go(-1);
    </script>";
}
