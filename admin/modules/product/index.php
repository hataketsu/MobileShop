<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "product";
// $product=$db -> fetchAll("product");

if (isset($_GET['page'])) {
    # code...
    $p = $_GET['page'];
} else {
    $p = 1;
}

$sql = "select product.*,category.name as namecate from product left join category on category.id=product.category_id";

$product = $db->fetchJone('product', $sql, $p, 4, true);

if (isset($product['page'])) {
    # code...
    $sotrang = $product['page'];
    unset($product['page']);
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
                    <?php echo $_SESSION['success'];
                    unset ($_SESSION['success']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset ($_SESSION['error']) ?>
                </div>
            <?php endif; ?>

        </div>
        <a href="add.php" class="btn btn-success">Thêm</a>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                               role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column descending" style="width: 60px;"
                                    aria-sort="ascending">STT
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">
                                    Category
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Office: activate to sort column ascending" style="width: 60px;">Slug
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Office: activate to sort column ascending" style="width: 60px;">Image
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Office: activate to sort column ascending" style="width: 60px;">Info
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Age: activate to sort column ascending" style="width: 30px;">Action
                                </th>

                            </tr>
                            </thead>
                            <!--            <tfoot>
                                           <tr>
                                               <th rowspan="1" colspan="1">STT</th>
                                               <th rowspan="1" colspan="1">Name</th>
                                                <th rowspan="1" colspan="1">Category</th>
                                               <th rowspan="1" colspan="1">Slug</th>
                                               <th rowspan="1" colspan="1">Image</th>
                                               <th rowspan="1" colspan="1">Info</th>
                                               <th rowspan="1" colspan="1">Action</th>


                                           </tr>
                                       </tfoot> -->
                            <tbody>
                            <?php $stt = 1;
                            foreach ($product as $item): ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['namecate'] ?></td>
                                    <td><?php echo $item['slug'] ?></td>
                                    <td><img src="<?php echo uploads() ?>product/<?php echo $item['image'] ?>"
                                             width="80px" height="80px"></td>
                                    <td>
                                        <ul>
                                            <li>Giá: <?php echo $item['price'] ?></li>
                                            <li>Số lượng <?php echo $item['number'] ?></li>
                                        </ul>
                                    </td>
                                    <td><a class="btn btn-xs btn-info" href="update.php?id=<?php echo $item['id'] ?>">
                                            <i class="fa fa-edit"></i>Sửa</a>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">
                                            <i class="fa fa-times"></i>
                                            Xóa</a>
                                    </td>

                                </tr>
                                <?php $stt++; endforeach ?>


                            </tbody>
                        </table>
                        <div class="pull-right">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <?php for ($i = 1; $i <= $sotrang; $i++) { ?>
                                        <?php
                                        if (isset($_GET['page'])) {
                                            $p = $_GET['page'];
                                            # code...
                                        } else {
                                            $p = 1;
                                        }
                                        ?>
                                        <li class="page-item<?php echo ($i == $p) ? 'active' : '' ?>"><a
                                                    class="page-link"
                                                    href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                                    <?php } ?>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
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