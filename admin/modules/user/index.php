<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "user";
// $product=$db -> fetchAll("product");

if (isset($_GET['page'])) {
    # code...
    $p = $_GET['page'];
} else {
    $p = 1;
}

$sql = "select users.* from users order by id desc ";

$user = $db->fetchJone('users', $sql, $p, 4, true);

if (isset($user['page'])) {
    # code...
    $sotrang = $user['page'];
    unset($user['page']);
}


?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Danh sách thành viên</a>
            </li>
            <li class="breadcrumb-item active">Thành viên</li>

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
                                    aria-label="Name: activate to sort column descending" style="width: 60px;"
                                    aria-sort="ascending">STT
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">Phone
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
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">Action</th>


                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $stt = 1;
                            foreach ($user as $item): ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?= $stt ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['phone'] ?></td>

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
                                    <?php for ($i = 1; $i <= $sotrang; $i++) ?>
                                        <?php
                                    if (isset($_GET['page'])) {
                                        $p = $_GET['page'];
                                        # code...
                                    } else {
                                        $p = 1;
                                    }
                                    ?>
                                    <li class="page-item<?= ($i == $p) ? 'active' : '' ?>"><a class="page-link"
                                                                                              href="?page=<?= $i; ?>"><?= $i; ?></a>
                                    </li>

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