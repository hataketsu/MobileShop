<?php require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$Edit_trans = $db->findByID("transaction", $id);
if (empty($Edit_trans)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("transaction");
}


if ($Edit_trans['status'] == 1) {
    # code...
    $_SESSION['error'] = "Đơn hàng đã được xử lý";
    redirectAdmin("transaction");
}
$status = 1;
$update = $db->update("transaction", array("status" => $status), array("id" => $id));

if ($update > 0) {
    # code...
    $_SESSION['success'] = "Cập nhật thành công";
    logInc('process_transaction');
    logInc('revenue', $Edit_trans['amount']);
    $sql = "select * from  orders where transaction_id=$id";
    $order = $db->fetchsql($sql);
    foreach ($order as $item) {
        # code...
        $idproduct = $item['product_id'];
        $product = $db->findByID("product", $idproduct);

        $nb = $product['number'] - $item['number'];

        $up_pro = $db->update("product", array("number" => $nb, "hot" => $product['hot'] + 1), array("id" => $idproduct));
    }
    redirectAdmin("transaction");
} else {
    $_SESSION['error'] = "Dữ liệu không thay đổi";
    redirectAdmin("transaction");
}


?>