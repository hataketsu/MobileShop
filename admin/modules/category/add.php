<?php require_once __DIR__ . "/../../autoload/autoload.php";
$open = "category";
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
        $isset = $db->fetchOne("category", "name='" . $data['name'] . "' ");
        if (count($isset) > 0) {
            # code...
            $_SESSION['error'] = "Ten danh muc da ton tai";
        } else {
            # code...
            $id_insert = $db->insert("category", $data);
            if ($id_insert > 0) {
                # code...
                $_SESSION['success'] = "Them moi thanh cong";
                redirectAdmin("category");
            } else {
                $_SESSION['error'] = "Them moi that bai";
            }

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
                <h1>Thêm mới danh mục</h1>


                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="danh mục" name="name">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name']; ?></p>


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