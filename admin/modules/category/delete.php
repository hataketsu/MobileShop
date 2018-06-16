<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";

$id = intval(getInput('id'));

$EditCategory = $db->fetchID("category", $id);
if (empty($EditCategory)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
}

$is_product = $db->fetchOne("product", " category_id=$id ");
if ($is_product == null) {
    # code...
    $num = $db->delete("category", $id);
    if ($num > 0) {
        # code...
        $_SESSION['success'] = "xoa thanh cong";
        redirectAdmin("category");
    } else {
        # code...
        $_SESSION['error'] = "xoa that bai";
        redirectAdmin("category");
    }
} else {
    # code...
    $_SESSION['error'] = "danh muc co san pham,khong the xoa";
    redirectAdmin("category");
}


?>
       