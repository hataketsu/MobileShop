<?php
require_once __DIR__ . "/autoload/autoload.php";
$key = intval(getInput("key"));
$number = intval(getInput("number"));

$_SESSION['cart'][$key]['number'] = $number;
echo 1;


?>