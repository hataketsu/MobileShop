<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";

$id = intval(getInput('id'));

$deleteadmin = $db->findByID("users", $id);
if (empty($deleteadmin)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("user");
}

$num = $db->delete("users", $id);
if ($num > 0) {
    # code...
    $_SESSION['success'] = "xoa thanh cong";
    redirectAdmin("user");
} else {
    # code...
    $_SESSION['error'] = "xoa that bai";
    redirectAdmin("user");
}


?>
       