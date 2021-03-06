<?php require_once __DIR__ . "/autoload/autoload.php";

if (isset($_SESSION['name_id'])) {
    echo "<script>location.href='index.php'</script>";
}

$data =
    [
        'name' => postInput("name"),
        'email' => postInput("email"),
        'password' => postInput("password"),
        'address' => postInput("address"),
        'phone' => postInput("phone")
    ];
$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...

    if ($data['name'] == '') {
        $error['name'] = "Bạn vui lòng điền tên";
    }


    if ($data['email'] == '') {
        $error['email'] = "Bạn vui lòng điền email";
    } else {
        $is_check = $db->fetchOne("users", " email='" . $data['email'] . "' ");
        if ($is_check != null) {
            # code...
            $error['email'] = "email đã tồn tại";
        }
    }


    if ($data['password'] == '') {
        $error['password'] = "Bạn vui lòng điền mật khẩu";
    } else {
        $data['password'] = md5(postInput("password"));
    }


    if ($data['phone'] == '') {
        $error['phone'] = "Bạn vui lòng điền số điện thoại";
    }


    if ($data['address'] == '') {
        $error['address'] = "Bạn vui lòng điền địa chỉ";
    }

    if (empty($error)) {

        $insert_id = $db->insert("users", $data);
        if ($insert_id > 0) {
            # code...
            $_SESSION['success'] = "Đăng ký thành công ! Mời bạn đăng nhập";
            logInc('user_reg');
            header("location:dang-nhap.php");
        } else {
            # code...
            echo "Đăng ký thất bại";
        }

    }
}


?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">


    <section class="box-main1">
        <h3 class="title-main"><a href=""> Đăng ký thành viên</a></h3>
        <form action="" method="POST" class="form-horizontal formcustomer" role="form" style="margin-top:20px ">
            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Tên thành viên</label>
                <div class="col-md-8">
                    <input type="text" name="name" placeholder="mai quang tú" class="form-control"
                           value="<?= $data['name'] ?>">
                    <?php if (isset($error['name'])): ?>
                        <p class="text-danger"><?= $error['name'] ?></p>

                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Email</label>
                <div class="col-md-8">
                    <input type="email" name="email" placeholder="maiquangtu1396@gmail.com" class="form-control"
                           value="<?= $data['email'] ?>">
                    <?php if (isset($error['email'])): ?>
                        <p class="text-danger"><?= $error['email'] ?></p>

                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Mật khẩu</label>
                <div class="col-md-8">
                    <input type="password" name="password" placeholder="******" class="form-control"
                           value="<?= $data['password'] ?>">
                    <?php if (isset($error['password'])): ?>
                        <p class="text-danger"><?= $error['password'] ?></p>

                    <?php endif ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Số điện thoại</label>
                <div class="col-md-8">
                    <input type="number" name="phone" placeholder="01654073549" class="form-control"
                           value="<?= $data['phone'] ?>">
                    <?php if (isset($error['phone'])): ?>
                        <p class="text-danger"><?= $error['phone'] ?></p>

                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 col-md-offset-1">Địa chỉ</label>
                <div class="col-md-8">
                    <input type="text" name="address" placeholder="hà nội" class="form-control"
                           value="<?= $data['address'] ?>">
                    <?php if (isset($error['address'])): ?>
                        <p class="text-danger"><?= $error['address'] ?></p>

                    <?php endif ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success col-md-2 col-md-offset-5 " style="margin-bottom: 20px;">Đăng
                ký
            </button>


        </form>


    </section>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




