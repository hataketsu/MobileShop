<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "category";
$category = $db->fetchAll("category");
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Danh sách danh mục</a>
            </li>
            <li class="breadcrumb-item active">Danh mục</li>

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
                                    aria-label="Name: activate to sort column descending" style="width: 84px;"
                                    aria-sort="ascending">STT
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 135px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 135px;">Home
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Office: activate to sort column ascending" style="width: 60px;">Slug
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Office: activate to sort column ascending" style="width: 60px;">
                                    Created_date
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Age: activate to sort column ascending" style="width: 30px;">Action
                                </th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">STT</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Home</th>
                                <th rowspan="1" colspan="1">Slug</th>
                                <th rowspan="1" colspan="1">Created_date</th>
                                <th rowspan="1" colspan="1">Action</th>


                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $stt = 1;
                            foreach ($category as $item): ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?= $stt ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td>
                                        <a href="home.php?id=<?= $item['id'] ?>" class="btn btn-xs
                        <?= $item['home'] == 1 ? 'btn-info' : ' btn-default ' ?>    ">
                                            <?= $item['home'] == 1 ? ' Hiển thị' : ' Không ' ?></a>
                                    </td>
                                    <td><?= $item['slug'] ?></td>
                                    <td><?= $item['created_at'] ?></td>
                                    <td><a class="btn btn-xs btn-info" href="update.php?id=<?= $item['id'] ?>">
                                            <i class="fa fa-edit"></i>Sửa</a>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?= $item['id'] ?>">
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
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
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