<?php require_once __DIR__ . "/autoload/autoload.php";

$user = $db->fetchID("users", intval($_SESSION['name_id']));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...
    $data =
        [
            'amount' => $_SESSION['total'],
            'users_id' => $_SESSION['name_id'],
            'note' => postInput("note")

        ];

    $id_tran = $db->insert("transaction", $data);
    if ($id_tran > 0) {
        # code...
        foreach ($_SESSION['cart'] as $key => $value) {
            # code...
            $data2 =
                [
                    'transaction_id' => $id_tran,
                    'product_id' => $key,
                    'number' => $value['number'],
                    'price' => $value['price']
                ];

            $id_insert = $db->insert("orders", $data2);
        }

        $_SESSION['success'] = "Lưu thông tin đơn hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất";
        header("location:thong-bao.php");
    }
}
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">


    <section class="box-main1">
        <h3 class="title-main"><a href=""> Thanh toán đơn hàng</a></h3>
        <form action="" method="POST" class="form-horizontal formcustomer" role="form" style="margin-top:20px ">
            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Tên thành viên</label>
                <div class="col-md-8">
                    <input type="text" readonly="" name="name" placeholder="mai quang tú" class="form-control"
                           value="<?php echo $user['name'] ?>">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Email</label>
                <div class="col-md-8">
                    <input type="email" readonly="" name="email" placeholder="maiquangtu1396@gmail.com"
                           class="form-control" value="<?php echo $user['email'] ?>">

                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Số điện thoại</label>
                <div class="col-md-8">
                    <input type="number" readonly="" name="phone" placeholder="01654073549" class="form-control"
                           value="<?php echo $user['phone'] ?>">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Địa chỉ</label>
                <div class="col-md-8">
                    <input type="text" readonly="" name="address" placeholder="hà nội" class="form-control"
                           value="<?php echo $user['address'] ?>">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Số tiền</label>
                <div class="col-md-8">
                    <input type="text" readonly="" name="address" placeholder="" class="form-control"
                           value="<?php echo formatPrice($_SESSION['total']) ?>">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Ghi chú</label>
                <div class="col-md-8">
                    <input type="text" name="note" placeholder="" class="form-control" value="">

                </div>
            </div>

            <button type="submit" class="btn btn-success col-md-2 col-md-offset-5 " style="margin-bottom: 20px;">Xác
                nhận
            </button>


        </form>


    </section>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




