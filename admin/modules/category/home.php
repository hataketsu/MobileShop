<?php


$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";
$id = intval(getInput('id'));
$EditCategory = $db->fetchID("category", $id);
if (empty($EditCategory)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
}


$home = $EditCategory['home'] == 0 ? 1 : 0;
$update = $db->update("category", array("home" => $home), array("id" => $id));

if ($update > 0) {
    # code...
    $_SESSION['success'] = "Cập nhật thanh cong";
    redirectAdmin("category");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirectAdmin("category");
}
?>