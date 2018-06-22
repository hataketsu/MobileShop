<?php

session_start();
require_once __DIR__ . "/../../libraries/database.php";
require_once __DIR__ . "/../../libraries/function.php";

$db = new Database;
if (!isset($_SESSION['admin_id'])) {
    header("location:" . base_url() . "login/");
}

define("ROOT", base_url() . "/public/uploads/");



