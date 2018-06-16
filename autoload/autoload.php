<?php
session_start();
require_once __DIR__ . "/../libraries/database.php";
require_once __DIR__ . "/../libraries/function.php";
$db = new Database;

define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/v/public/uploads/");
$category = $db->fetchAll("category");
$sqlNew = " select * from product where 1 order by id desc limit 3 ";
$productNew = $db->fetchsql($sqlNew);


$sqlHot = "select * from product where 1 order by hot desc limit 3";
$productHot = $db->fetchsql($sqlHot);
?>
