<?php
logInc("page_view");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web bán hàng</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/frontend/css/bootstrap.min.css">

    <script src="<?= base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>public/frontend/js/bootstrap.min.js"></script>
    <!---->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/frontend/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/frontend/css/slick-theme.css"/>
    <!--slide-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/frontend/css/style.css">

</head>
<body>
<?php if (ENABLE_FACEBOOK_CHAT) { ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>
<div id="wrapper">
    <!---->
    <!--HEADER-->
    <div id="header">
        <div id="header-top">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-6" id="header-text">
                        <a>Mai Quang Tu</a>
                    </div>
                    <div class="col-md-6">
                        <nav id="header-nav-top">
                            <ul class="list-inline pull-right" id="headermenu">
                                <?php if (isset($_SESSION['name_user'])): ?>
                                    <li>Xin chào : <?= $_SESSION['name_user'] ?></li>
                                    <li>
                                        <a href=""><i class="fa fa-user"></i> Tài khoản <i class="fa fa-caret-down"></i></a>
                                        <ul id="header-submenu">
                                            <li><a href="">Thông tin</a></li>
                                            <li><a href="gio-hang.php">Giỏ hàng</a></li>
                                            <li><a href="thoat.php"><i class="fa fa-share-square-o"></i>Thoát</a></li>
                                        </ul>
                                    </li>

                                <?php else: ?>
                                    <li>
                                        <a href="dang-nhap.php"><i class="fa fa-unlock"></i> Đăng nhập</a></li>
                                    <li>
                                        <a href="dang-ky.php"><i class="fa fa-unlock"></i> Đăng ký</a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="header-main">
                <div class="col-md-5">
                    <form class="form-inline" action="../search.php" method="get">
                        <div class="form-group">
                            <label>
                                <select name="category" class="form-control" id="query_cat">
                                    <option value="-1"> Tất cả danh mục</option>
                                    <?php foreach ($categories as $item): ?>
                                        <option value="<?= $item['id'] ?>">
                                            <?= $item['name'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </label>
                            <input type="text" name="keyword" placeholder=" input keywork" class="form-control"
                                   value="<?= isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '' ?>">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                    <script>
                        $(function () {
                                <?php
                                if( isset($_REQUEST['category'])){ ?>
                                $("#query_cat").val(<?=$_REQUEST['category']?>);
                                <?php } ?>
                            }
                        );
                    </script>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>public/frontend/images/logo-default.png">
                    </a>
                </div>
                <div class="col-md-3" id="header-right">
                    <div class="pull-right">
                        <div class="pull-left">
                            <i class="glyphicon glyphicon-phone-alt"></i>
                        </div>
                        <div class="pull-right">
                            <p id="hotline">HOTLINE</p>
                            <p>0986420994</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END HEADER-->

    <!--MENUNAV-->
    <div id="menunav">
        <div class="container">
            <nav>
                <div class="home pull-left">
                    <a href="<?= base_url() ?>">Trang chủ</a>
                </div>
                <!--menu main-->
                <ul id="menu-main">
                    <li>
                        <a href="">Shop</a>
                    </li>
                    <li>
                        <a href="">Mobile</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>
                    <li>
                        <a href="../list_blog.php">Blog</a>
                    </li>
                    <li>
                        <a href="">About us</a>
                    </li>
                </ul>
                <!-- end menu main-->

                <!--Shopping-->
                <ul class="pull-right" id="main-shopping">
                    <li>
                        <a href="<?php
                        echo base_url()
                        ?>gio-hang.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                    </li>
                </ul>
                <!--end Shopping-->
            </nav>
        </div>
    </div>
    <!--ENDMENUNAV-->

    <div id="maincontent">
        <div class="container">
            <div class="col-md-3  fixside">
                <div class="box-left box-menu">
                    <h3 class="box-title"><i class="fa fa-list"></i> Danh mục</h3>
                    <ul>
                        <?php foreach ($categories as $item): ?>
                            <li>
                                <a href="danh-muc-san-pham.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                            </li>
                        <?php endforeach ?>


                    </ul>
                </div>

                <div class="box-left box-menu">
                    <h3 class="box-title"><i class="fa fa-warning"></i> Sản phẩm mới </h3>

                    <ul>
                        <?php foreach ($productNew as $item) {
                            include './view/product_row.php';
                        } ?>
                    </ul>
                    <!-- </marquee> -->
                </div>

                <div class="box-left box-menu">
                    <h3 class="box-title"><i class="fa fa-warning"></i> Sản phẩm HOT </h3>
                    <ul>
                        <?php foreach ($productHot as $item) {
                            include './view/product_row.php';
                        } ?>
                    </ul>
                    <!-- </marquee> -->
                </div>
            </div>