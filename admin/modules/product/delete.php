<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";

$id = intval(getInput('id'));

$Editproduct = $db->findByID("product", $id);
if (empty($Editproduct)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("product");
}

$num = $db->delete("product", $id);
if ($num > 0) {
    # code...
    $_SESSION['success'] = "xoa thanh cong";
    redirectAdmin("product");
} else {
    # code...
    $_SESSION['error'] = "xoa that bai";
    redirectAdmin("product");
}


?>
       