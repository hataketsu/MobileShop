<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "admin";

$data =
    ["name" => postInput('name'),
        "email" => postInput("email"),
        "phone" => postInput("phone"),
        "password" => md5(postInput("password")),
        "address" => postInput("address"),
        "level" => postInput("level")


    ];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...


    $error = [];
    if (postInput('name') == '') {
        # code...
        $error['name'] = "Mời bạn nhập đầy đủ họ tên ";
    }

    if (postInput('email') == '') {
        # code...
        $error['email'] = "Mời bạn nhập đầy đủ email";
    } else {
        $is_check = $db->fetchOne("admin", " email='" . $data['email'] . "' ");
        if ($is_check != null) {
            # code...
            $error['email'] = "email đã tồn tại";
        }
    }


    if (postInput('phone') == '') {
        # code...
        $error['phone'] = "Mời bạn nhập đầy đủ số điện thoại";
    }

    if (postInput('password') == '') {
        # code...
        $error['password'] = "Mời bạn nhập mật khẩu";
    }


    if (postInput('address') == '') {
        # code...
        $error['address'] = "Mời bạn nhập đầy đủ địa chỉ";
    }


    if ($data['password'] != md5(postInput("re_password"))) {
        # code...
        $error['password'] = "Mật khẩu không khớp";
    }


    if (empty($error)) {
        # code...


        $id_insert = $db->insert("admin", $data);
        if ($id_insert) {
            # code...

            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("admin");
        } else {
            $_SESSION['error'] = "Thêm mới thất bại";
        }


    }
}

?>
<?php require_once __DIR__ . "/../../layouts/header.php" ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Admin</a>
            </li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
        <div class="clearfix">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset ($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Thêm mới admin</h1>


                <form action="" method="POST" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="họ tên" name="name" value="<?php echo $data['name'] ?>">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="maiquangtu1396@gmail.com" name="email" value="<?php echo $data['email'] ?>">
                        <?php if (isset($error['email'])): ?>
                            <p class="text-danger"> <?php echo $error['email']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="phone" value="<?php echo $data['phone'] ?>">
                        <?php if (isset($error['phone'])): ?>
                            <p class="text-danger"> <?php echo $error['phone']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="password">
                        <?php if (isset($error['password'])): ?>
                            <p class="text-danger"> <?php echo $error['password']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="re_password" required="">
                        <?php if (isset($error['re_password'])): ?>
                            <p class="text-danger"> <?php echo $error['re_password']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="address" value="<?php echo $data['address'] ?>">
                        <?php if (isset($error['address'])): ?>
                            <p class="text-danger"> <?php echo $error['address']; ?></p>


                        <?php endif ?>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Level</label>
                        <select class="form-control" name="level">
                            <option value="1" <?php echo isset($data['level']) && $data['level'] == 1 ? "selected='selected'" : '' ?>>
                                CTV
                            </option>
                            <option value="2" <?php echo isset($data['level']) && $data['level'] == 2 ? "selected='selected'" : '' ?>>
                                Admin
                            </option>
                        </select>
                        <?php if (isset($error['level'])): ?>
                            <p class="text-danger"> <?php echo $error['level']; ?></p>


                        <?php endif ?>

                    </div>


                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php require_once __DIR__ . "/../../layouts/footer.php" ?>