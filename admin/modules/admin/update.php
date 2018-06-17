<?php require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$Editadmin = $db->findByID("admin", $id);
if (empty($Editadmin)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("admin");
}


$open = "admin";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...
    $data =
        ["name" => postInput('name'),
            "email" => postInput("email"),
            "phone" => postInput("phone"),

            "address" => postInput("address"),
            "level" => postInput("level")


        ];


    $error = [];
    if (postInput('name') == '') {
        # code...
        $error['name'] = "Mời bạn nhập đầy đủ họ tên ";
    }

    if (postInput('email') == '') {
        # code...
        $error['email'] = "Mời bạn nhập đầy đủ email";
    } else {
        if (postInput("email") != $Editadmin['email']) {
            # code...


            $is_check = $db->fetchOne("admin", " email='" . $data['email'] . "' ");
            if ($is_check != null) {
                # code...
                $error['email'] = "email đã tồn tại";
            }

        }
    }


    if (postInput('phone') == '') {
        # code...
        $error['phone'] = "Mời bạn nhập đầy đủ số điện thoại";
    }


    if (postInput('address') == '') {
        # code...
        $error['address'] = "Mời bạn nhập đầy đủ địa chỉ";
    }


    // if ($data['password'] != md5(postInput("re_password"))) {
    //     # code...
    //  $error['password']="Mật khẩu không khớp";
    // }

    if (postInput('password') != null && postInput("re_password") != null) {
        if (postInput('password') != postInput('re_password')) {
            # code...
            $error['password'] = "Mật khẩu không khớp";
        } else {
            $data['password'] = md5(postInput("password"));
        }
        # code...
    }


    if (empty($error)) {
        # code...


        $id_update = $db->update("admin", $data, array("id" => $id));
        if ($id_update > 0) {
            # code...

            $_SESSION['success'] = "Cập nhật thành công";
            redirectAdmin("admin");
        } else {
            $_SESSION['error'] = "Dữ liệu không thay đổi";
            redirectAdmin("admin");
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
                    <?= $_SESSION['error'];
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
                               placeholder="họ tên" name="name" value="<?= $Editadmin['name'] ?>">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?= $error['name']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="maiquangtu1396@gmail.com" name="email"
                               value="<?= $Editadmin['email'] ?>">
                        <?php if (isset($error['email'])): ?>
                            <p class="text-danger"> <?= $error['email']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="phone" value="<?= $Editadmin['phone'] ?>">
                        <?php if (isset($error['phone'])): ?>
                            <p class="text-danger"> <?= $error['phone']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="password">
                        <?php if (isset($error['password'])): ?>
                            <p class="text-danger"> <?= $error['password']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="re_password">
                        <?php if (isset($error['re_password'])): ?>
                            <p class="text-danger"> <?= $error['re_password']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="" name="address" value="<?= $Editadmin['address'] ?>">
                        <?php if (isset($error['address'])): ?>
                            <p class="text-danger"> <?= $error['address']; ?></p>


                        <?php endif ?>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Level</label>
                        <select class="form-control" name="level">
                            <option value="1" <?= isset($Editadmin['level']) && $Editadmin['level'] == 1 ? "selected='selected'" : '' ?>>
                                CTV
                            </option>
                            <option value="2" <?= isset($Editadmin['level']) && $Editadmin['level'] == 2 ? "selected='selected'" : '' ?>>
                                Admin
                            </option>
                        </select>
                        <?php if (isset($error['level'])): ?>
                            <p class="text-danger"> <?= $error['level']; ?></p>


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