<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "product";
// $product=$db -> fetchAll("product");

if (isset($_GET['page'])) {
    # code...
    $page = $_GET['page'];
} else {
    $page = 1;
}

$sql = "select product.*,category.name as namecate from product left join category on category.id=product.category_id";

$products = $db->fetchJone('product', $sql, $page, 4, true);

if (isset($products['page'])) {
    $sotrang = $products['page'];
    unset($products['page']);
}


?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Danh sách sản phẩm</a>
            </li>
            <li class="breadcrumb-item active">Sản phẩm</li>

        </ol>
        <div class="clearfix">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'];
                    unset ($_SESSION['success']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];
                    unset ($_SESSION['error']) ?>
                </div>
            <?php endif; ?>

        </div>
        <a href="add.php" class="btn btn-success" style="margin-bottom: 20px">Thêm</a>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                               role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Danh mục</th>
                                <th>Hình ảnh</th>
                                <th>Thông tin</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1;
                            foreach ($products as $index => $item) { ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?= $index+1 ?></td>
                                    <td>
                                        <a href="../../../chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                                    </td>
                                    <td><?= $item['namecate'] ?></td>
                                    <td><img src="<?= uploads() ?>product/<?= $item['image'] ?>"
                                             width="80px" height="80px"></td>
                                    <td>
                                        <ul>
                                            <li>Giá: <?= $item['price'] ?></li>
                                            <li>Số lượng <?= $item['number'] ?></li>
                                        </ul>
                                    </td>
                                    <td><a class="btn btn-xs btn-info" href="update.php?id=<?= $item['id'] ?>">
                                            <i class="fa fa-edit"></i>Sửa</a>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?= $item['id'] ?>">
                                            <i class="fa fa-times"></i>
                                            Xóa</a>
                                    </td>

                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                        <div class="pull-right">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                                    <?php for ($i = 1; $i <= $sotrang; $i++) { ?>
                                        <?php
                                        if (isset($_GET['page'])) {
                                            $page = $_GET['page'];
                                        } else {
                                            $page = 1;
                                        }
                                        ?>
                                        <li class="page-item<?= ($i == $page) ? 'active' : '' ?>"><a
                                                    class="page-link"
                                                    href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php } ?>
                                    <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php require_once __DIR__ . "/../../layouts/footer.php" ?>