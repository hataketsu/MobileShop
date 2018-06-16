<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";

$id = intval(getInput('id'));

$deleteadmin = $db->findByID("admin", $id);
if (empty($deleteadmin)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("admin");
}

$num = $db->delete("admin", $id);
if ($num > 0) {
    # code...
    $_SESSION['success'] = "xoa thanh cong";
    redirectAdmin("admin");
} else {
    # code...
    $_SESSION['error'] = "xoa that bai";
    redirectAdmin("admin");
}


?>
       