<?php
session_start();
require_once __DIR__ . "/../../libraries/database.php";
require_once __DIR__ . "/../../libraries/function.php";
$db = new Database;

if (!isset($_SESSION['admin_id'])) {
    # code...
    header("location:/v/login/");
}

define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/v/public/uploads/");

?>



