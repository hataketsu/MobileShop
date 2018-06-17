<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang Admin</title>
    <!-- Bootstrap core CSS-->
    <link href="<?= base_url() ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>public/admin/css/sb-admin.css" rel="stylesheet">
    <script src="<?= base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Xin chào <?= $_SESSION['admin_name'] ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="<?= base_url() ?>admin">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item <?= isset($open) && $open == 'category' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= modules("category") ?>">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Danh mục sản phẩm</span>
                </a>
            </li>
            <li class="nav-item <?= isset($open) && $open == 'product' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= modules("product") ?>">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Sản phẩm </span>
                </a>
            </li>

            <li class="nav-item <?= isset($open) && $open == 'admin' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= modules("admin") ?>">
                    <i class="fa fa-fw fa-user-secret"></i>
                    <span class="nav-link-text">Admin </span>
                </a>
            </li>

            <li class="nav-item <?= isset($open) && $open == 'user' ? 'active ' : '' ?>">
                <a class="nav-link" href="<?= modules("user") ?>">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">Thành viên </span>
                </a>
            </li>

            <li class="nav-item <?= isset($open) && $open == 'transaction' ? 'active ' : '' ?>">
                <a class="nav-link" href="<?= modules("transaction") ?>">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">Quản lý đơn hàng </span>
                </a>
            </li>

            <li class="nav-item <?= isset($open) && $open == 'blogs' ? 'active ' : '' ?>">
                <a class="nav-link" href="<?= modules("blogs") ?>">
                    <i class="fa fa-fw fa-file-text"></i>
                    <span class="nav-link-text">Quản lý bài viết</span>
                </a>
            </li>


        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>admin/logout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Đăng xuất</a>
            </li>
        </ul>
    </div>
</nav>