<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "transaction";
// $product=$db -> fetchAll("product");

if (isset($_GET['page'])) {
    # code...
    $p = $_GET['page'];
} else {
    $p = 1;
}

$sql = "select transaction.*,users.name as name_user,users.phone as phone_user from transaction left join users on users.id= transaction.users_id order by id desc ";

$transactions = $db->fetchJone('transaction', $sql, $p, 4, true);

if (isset($transactions['page'])) {
    # code...
    $sotrang = $transactions['page'];
    unset($transactions['page']);
}


?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Danh sách đơn hàng</a>
            </li>
            <li class="breadcrumb-item active">Đơn hàng</li>

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
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">Phone
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                    aria-label="Position: activate to sort column ascending" style="width: 130px;">
                                    Status
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
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th rowspan="1" colspan="1">Action</th>


                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $stt = 1;
                            foreach ($transactions as $item): ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><a href="show.php?id=<?= $item['id'] ?>"><?= $stt ?></a></td>
                                    <td><?= $item['name_user'] ?></td>
                                    <td><?= $item['phone_user'] ?></td>
                                    <td>
                                        <a href="status.php?id=<?= $item['id'] ?>"
                                           class="btn btn-xs <?= $item['status'] == 0 ? 'btn-danger' : 'btn-info' ?>"><?= $item['status'] == 0 ? 'chưa xử lý ' : 'đã xử lý' ?></a>
                                    </td>


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