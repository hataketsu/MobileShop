<?php require_once __DIR__ . "/autoload/autoload.php";
//_debug($_SESSION['cart']);
$sum = 0;


if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    # code...
    echo "<script >alert('Không có sản phẩm trong giỏ hàng');location.href='index.php'</script>";
}
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a href=""> Giỏ hàng của bạn</a></h3>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <strong>Success!</strong><?= $_SESSION['success'];
                unset($_SESSION['success']) ?>
            </div>
        <?php endif ?>
        <table class="table table-hover" id="sc">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1;
            foreach ($_SESSION['cart'] as $key => $value): ?>

                <tr>
                    <td><?= $stt ?></td>
                    <td><a href="chi-tiet-san-pham.php?id=<?= $key ?>"><?= $value['name'] ?></a></td>
                    <td><a href="chi-tiet-san-pham.php?id=<?= $key ?>"><img
                                    src="<?= uploads() ?>product/<?= $value['image'] ?>" width="80px"
                                    height="80px"></a></td>
                    <td><p><input type="number" name="number" value="<?= $value['number'] ?>"
                                  class="form-control nb" id="number<?= $key ?>" min=0></p>
                        <p>Tối đa <?= $value['max'] ?> sản phẩm</p></td>
                    <td><?= formatPrice($value['price']) ?></td>
                    <td><?= formatPrice($value['number'] * $value['price']) ?></td>
                    <td>
                        <a href="" class="btn btn-xs btn-info updatecart" data-key=<?= $key ?>><i
                                    class="fa fa-refresh"></i>Sửa </a>
                        <a href="remove.php?key=<?= $key ?>" class="btn btn-xs btn-danger"><i
                                    class="fa fa-remove"></i>Xóa</a>
                    </td>
                </tr>
                <?php $sum += $value['price'] * $value['number'];
                $_SESSION['tongtien'] = $sum; ?>
                <?php $stt++; endforeach ?>

            </tbody>
        </table>


        <div class="col-md-5 pull-right">
            <ul class="list-group">
                <li class="list-group-item"><h3>Thông tin đơn hàng</h3></li>
                <li class="list-group-item">
                    <span class="badge"><?= formatPrice($_SESSION['tongtien']) ?> đ </span>Tổng tiền thanh toán
                </li>
                <li class="list-group-item">
                    <a href="index.php" class="btn btn-success">Tiếp tục mua hàng</a>
                    <a href="thanh-toan.php" class="btn btn-success">Thanh toán</a>
                </li>
            </ul>

        </div>


    </section>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




