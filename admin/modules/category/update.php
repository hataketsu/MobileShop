<?php require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";

$id = intval(getInput('id'));

$EditCategory = $db->findByID("category", $id);
if (empty($EditCategory)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...
    $data =
        ["name" => postInput('name'),
            "slug" => to_slug(postInput("name"))

        ];

    $error = [];
    if (postInput('name') == '') {
        # code...
        $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
    }

    if (empty($error)) {
        # code...

        $id_update = $db->update("category", $data, array("id" => $id));
        if ($id_update > 0) {
            # code...
            $_SESSION['success'] = "Cập nhật thanh cong";
            redirectAdmin("category");
        } else {
            $_SESSION['error'] = "cập nhật that bai";
            redirectAdmin("category");
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
                <a href="">Danh mục</a>
            </li>
            <li class="breadcrumb-item active">Cập nhật</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Sửa danh mục</h1>


                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="danh mục" name="name" value="<?= $EditCategory['name'] ?>">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?= $error['name']; ?></p>


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