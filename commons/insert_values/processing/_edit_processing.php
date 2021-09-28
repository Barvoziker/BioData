<?php
require '../../main/tabTable.php';

$index = $_POST['select'];

$name = lcfirst(str_replace('', '_', $tabTables[$index]));

header("Location: ./../../insert_values/{$name}.php");
?>