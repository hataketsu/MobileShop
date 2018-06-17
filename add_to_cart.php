<?php
require_once __DIR__ . "/autoload/autoload.php";

if (!isset($_SESSION['name_id'])) {
    echo "<script>alert('Bạn chưa đăng nhập');location.href='index.php'</script>";
}

$id = intval(getInput('id'));
$product = $db->findByID("product", $id);
if ($product['number'] < 1) {
    echo "<script>alert('Sản phẩm đã hết hàng!');location.href='gio-hang.php'</script>";
} else {
    if (!isset($_SESSION['cart'][$id])) {
        # code...
        $_SESSION['cart'][$id]['name'] = $product['name'];
        $_SESSION['cart'][$id]['image'] = $product['image'];
        $_SESSION['cart'][$id]['max'] = $product['number'];
        $_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
        $_SESSION['cart'][$id]['number'] = 1;
    } else {
        # code...
        $_SESSION['cart'][$id]['number'] += 1;
    }

    echo "<script>alert('Thêm giỏ hàng thành công');location.href='gio-hang.php'</script>";
}
?>