<?php
require_once __DIR__ . "/autoload/autoload.php";
$key = intval(getInput("key"));
$product = $db->fetchOne('product', " id = $key ");
$number = intval(getInput("number"));
if ($number <= $product['number']) {
    if ($number < 1) {
        unset($_SESSION['cart'][$key]);
    } else {
        $_SESSION['cart'][$key]['number'] = $number;
    }
    echo 'done';
} else echo 'over';
?>