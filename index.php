<?php require_once __DIR__ . "/autoload/autoload.php";

//unset($_SESSION['cart']);
$sqlHomecate = "select name,id from category where home =1 order by updated_at ";
$categoryHome = $db->fetchsql($sqlHomecate);

$data = [];
foreach ($categoryHome as $item) {
    # code...
    $cateId = intval($item['id']);
    $sql = "select * from product where category_id=$cateId";
    $productHome = $db->fetchsql($sql);
    $data[$item['name']] = $productHome;
}

?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section id="slide" class="text-center">
        <img src="<?php echo base_url() ?>public/frontend/images/banner.jpg" class="" width="100%">
    </section>

    <section class="box-main1">

        <?php foreach ($data as $key => $value): ?>
            <h3 class="title-main"><a href=""> <?php echo $key ?></a></h3>
            <div class="showitem row">
                <?php foreach ($value as $item): ?>
                    <div class="col-md-3 item-product bor">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                            <img src="<?php echo uploads() ?>/product/<?php echo $item['image'] ?>" class=""
                                 width="100%" height="180">
                        </a>
                        <div class="info-item">
                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                            <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike> <b
                                        class="price"><?php echo SalePrice($item['price'], $item['sale']) ?>đ</b></p>
                        </div>
                        <div class="hidenitem">
                            <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a>
                            </p>
                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                            <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a>
                            </p>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        <?php endforeach ?>

    </section>

</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>



 
