<?php
require_once __DIR__ . "/../../autoload/autoload.php";
$transaction_id = trim($_REQUEST['id']);
//$transaction = $db->findByID('transaction', $transaction_id);
$orders = $db->fetchsql("select * from orders where transaction_id = $transaction_id");
$rows = [];
foreach ($orders as $index => $order) {
    $product = $db->findByID("product", $order["product_id"]);
    $row = ['product' => $product, 'order' => $order];
    $rows[$index] = $row;
}
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Đơn hàng</a>
            </li>
            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>

        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr role="row">
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1;
                            foreach ($rows as $index => $row) { ?>
                                <tr>
                                    <td><?= $index ?></td>
                                    <td style="text-align: center">
                                        <a href="../../../chi-tiet-san-pham.php?id=<?= $row['product']['id'] ?>">
                                            <img src="<?= uploads() ?>/product/<?= $row['product']['image'] ?>"
                                                 height="180">
                                            <p><?= $row['product']['name'] ?></p></a></td>
                                    <td><?= $row['order']['number'] ?></td>
                                    <td><?= formatPrice($row['order']['price']) ?> đ</td>
                                    <td><?= formatPrice($row['order']['price'] * $row['order']['number']) ?> đ</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php require_once __DIR__ . "/../../layouts/footer.php" ?>