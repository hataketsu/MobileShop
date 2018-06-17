<?php
require_once __DIR__ . "/../../autoload/autoload.php";

$blog_id = intval(getInput('id'));
$db->delete('blogs', $blog_id);
redirectAdmin("blogs");
