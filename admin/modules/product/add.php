<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "category";

$categories = $db->fetchAll("category");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...
    $data =
        ["name" => postInput('name'),
            "slug" => to_slug(postInput("name")),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "number" => postInput("number"),
            "content" => postInput("content")
        ];

    $error = [];
    if (postInput('name') == '') {
        # code...
        $error['name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
    }

    if (postInput('category_id') == '') {
        # code...
        $error['category_id'] = "Mời bạn nhập đầy đủ danh mục";
    }


    if (postInput('price') == '') {
        # code...
        $error['price'] = "Mời bạn nhập đầy đủ giá";
    }

    if (postInput('number') == '') {
        # code...
        $error['number'] = "Mời bạn nhập đầy đủ số lượng";
    }


    if (postInput('content') == '') {
        # code...
        $error['content'] = "Mời bạn nhập đầy đủ nội dung";
    }


    if (!isset($_FILES['image'])) {
        # code...
        $error['image'] = "Mời bạn chọn hình ảnh";
    }


    if (empty($error)) {
        # code...
        if (isset($_FILES['image'])) {
            # code...
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_error = $_FILES['image']['error'];

            if ($file_error == 0) {
                # code...
                $part = ROOT . "product/";
                $data['image'] = $file_name;
            }
        }

        $id_insert = $db->insert("product", $data);
        if ($id_insert) {
            # code...
            move_uploaded_file($file_tmp, $part . $file_name);
            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("product");
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
                <a href="">Sản phẩm</a>
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
                <h1>Thêm mới sản phẩm</h1>


                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label >Danh mục sản phẩm</label>
                        <select class="form-control col-md-8" name="category_id">
                            <option value="">-Mời bạn chọn danh mục sản phẩm-</option>
                            <?php foreach ($categories as $item): ?>
                                <option value="<?= $item['id'] ?>"><?php echo
                                    $item['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php if (isset($error['category_id'])): ?>
                            <p class="text-danger"> <?= $error['category_id']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label >Tên sản phẩm</label>
                        <input type="text" class="form-control" 
                               placeholder="sản phẩm" name="name">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?= $error['name']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label >Giá sản phẩm</label>
                        <input type="number" class="form-control" 
                               placeholder="giá" name="price">
                        <?php if (isset($error['price'])): ?>
                            <p class="text-danger"> <?= $error['price']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label >Số lượng</label>
                        <input type="number" class="form-control" 
                               placeholder="số lượng" name="number">
                        <?php if (isset($error['number'])): ?>
                            <p class="text-danger"> <?= $error['number']; ?></p>
                        <?php endif ?>
                    </div>


                    <div class="form-group">
                        <label >Giảm giá</label>
                        <input type="number" class="form-control" 
                               placeholder="sale" name="sale" value="0">
                    </div>

                    <div class="form-group">
                        <label >Hình ảnh</label>
                        <input type="file" class="form-control" 
                               name="image">
                        <?php if (isset($error['image'])): ?>
                            <p class="text-danger"> <?= $error['image']; ?></p>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label >Nội dung</label>
                        <textarea class="form-control" name="content"></textarea>
                        <?php if (isset($error['content'])): ?>
                            <p class="text-danger"> <?= $error['content']; ?></p>
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