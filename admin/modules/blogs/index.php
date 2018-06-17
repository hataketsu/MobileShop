<?php require_once __DIR__ . "/../../autoload/autoload.php";

$open = "blogs";
$blogs = $db->fetchAll("blogs");
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= modules('blogs') ?>">Quản lý bài viết</a>
            </li>
            <li class="breadcrumb-item active">Danh sách bài viết</li>

        </ol>
        <a href="edit.php" class="btn btn-success" style="margin-bottom: 20px">Thêm</a>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                    <tr role="row">
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($blogs as $index => $blog) { ?>
                        <tr role="row">
                            <td><?= $index + 1 ?></td>
                            <td><a href="../../../show_blog.php?id=<?= $blog['id'] ?>"> <?= $blog['title'] ?></a></td>
                            <td><?= date('Y/m/d', $blog['date']) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-info" href="edit.php?id=<?= $blog['id'] ?>">
                                        <i class="fa fa-edit"></i>Sửa</a>
                                    <a class="btn btn-xs btn-danger" href="delete.php?id=<?= $blog['id'] ?>">
                                        <i class="fa fa-times"></i>
                                        Xóa</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php require_once __DIR__ . "/../../layouts/footer.php" ?>