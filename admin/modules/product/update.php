<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "category";

$id = intval(getInput('id'));

$Editproduct = $db->fetchID("product", $id);
if (empty($Editproduct)) {
    # code...
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("product");
}


$category = $db->fetchAll("category");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # code...
    $data =
        ["name" => postInput('name'),
            "slug" => to_slug(postInput("name")),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "number" => postInput("number"),
            "content" => postInput("content"),
            "sale" => postInput("sale")


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

        $update = $db->update("product", $data, array("id" => $id));
        if ($update > 0) {
            # code...
            move_uploaded_file($file_tmp, $part . $file_name);
            $_SESSION['success'] = "cap nhat thành công";
            redirectAdmin("product");
        } else {
            $_SESSION['error'] = "cap nhat thất bại";
            redirectAdmin("product");

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
            <li class="breadcrumb-item active">Update</li>
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
                <h1>Sửa sản phẩm</h1>


                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                        <select class="form-control col-md-8" name="category_id">
                            <option>-Mời bạn chọn danh mục sản phẩm-</option>
                            <?php foreach ($category as $item): ?>
                                <option value="<?php echo $item['id'] ?>" <?php
                                echo $Editproduct['category_id'] == $item['id'] ?
                                    "selected = 'selected'" : '' ?>><?php echo
                                    $item['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php if (isset($error['category'])): ?>
                            <p class="text-danger"> <?php echo $error['category']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="sản phẩm" name="name" value="<?php echo $Editproduct['name'] ?>">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger"> <?php echo $error['name']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="giá" name="price" value="<?php echo $Editproduct['price'] ?>">
                        <?php if (isset($error['price'])): ?>
                            <p class="text-danger"> <?php echo $error['price']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="số lượng" name="number" value="<?php echo $Editproduct['number'] ?>">
                        <?php if (isset($error['number'])): ?>
                            <p class="text-danger"> <?php echo $error['number']; ?></p>


                        <?php endif ?>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Giảm giá</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="sale" name="sale" value="<?php echo $Editproduct['sale'] ?>">


                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               name="image">
                        <?php if (isset($error['image'])): ?>
                            <p class="text-danger"> <?php echo $error['image']; ?></p>


                        <?php endif ?>
                        <img src="<?php echo uploads() ?>product/<?php echo $Editproduct['image'] ?>" width="50px"
                             height="50px">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung</label>
                        <textarea class="form-control" name="content"><?php echo $Editproduct['content'] ?></textarea>
                        <?php if (isset($error['content'])): ?>
                            <p class="text-danger"> <?php echo $error['content']; ?></p>


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