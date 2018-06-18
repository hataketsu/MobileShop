<?php require_once __DIR__ . "/autoload/autoload.php";


$id = intval(getInput('id'));


$product = $db->findByID("product", $id);

$cateid = intval($product['category_id']);

$sql = " select * from product where category_id= $cateid order by id desc limit 4 ";
$spkemtheo = $db->fetchsql($sql);
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <div class="col-md-6 text-center">
            <img src="<?= uploads() ?>product/<?= $product['image'] ?>" class="img-responsive bor"
                 id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">

        </div>
        <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
            <ul id="right">
                <li><h3> <?= $product['name'] ?></h3></li>
                <li><p> Trong kho hàng có (<?= $product['number'] ?>) sản phẩm</p></li>

                <?php if ($product['sale'] > 0): ?>
                    <li><p><strike class="sale"><?= formatPrice($product['price']) ?> đ</strike> <b
                                    class="price"><?= SalePrice($product['price'], $product['sale']) ?> đ</b></li>
                <?php else : ?>
                    <li><b><?= formatPrice($product['price']) ?>đ</b></li>
                <?php endif ?>
                <li><a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-default"> <i
                                class="fa fa-shopping-basket"></i>Thêm vào giỏ hàng </a></li>
            </ul>
        </div>

    </section>

    <div class="col-md-12" id="tabdetail">
        <div class="row">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                <li><a data-toggle="tab" href="#menu1 ">Bình luận</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <p><?= $product['content'] ?></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="fb-comments" data-href="<?=base_url()?>/<?= $product['id'] ?>" data-width="800"
                         data-numposts="5"></div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="showitem">
            <h3>Sản phẩm liên quan</h3>
            <?php foreach ($spkemtheo as $item): ?>
                <div class="col-md-3 item-product bor">
                    <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
                        <img src="<?= uploads() ?>/product/<?= $item['image'] ?>" class="" width="100%"
                             height="180">
                    </a>
                    <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                        <p><strike class="sale"><?= formatPrice($item['price']) ?></strike> <b
                                    class="price"><?= SalePrice($item['price'], $item['sale']) ?>đ</b></p>
                    </div>
                    <div class="hidenitem">
                        <p><a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><i class="fa fa-search"></i></a>
                        </p>
                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                        <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>

</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




