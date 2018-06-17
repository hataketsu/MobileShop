<?php
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$product = $db->findByID("product", $id);

if (empty($product)) {
    echo "<script>alert('Dữ liệu không tồn tại');location.href='" . base_url() . "admin/modules/product'</script>";
}

$num = $db->delete("product", $id);
if ($num > 0) {
    echo "<script>alert('Xóa thành công!');location.href='" . base_url() . "admin/modules/product'</script>";
} else {
    echo "<script>alert('Xóa thất bại!');location.href='" . base_url() . "admin/modules/product'</script>";
}


?>
       