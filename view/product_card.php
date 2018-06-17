<div class="col-md-3 item-product bor">
    <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
        <img src="<?= uploads() ?>/product/<?= $item['image'] ?>" width="100%"
             height="180">
    </a>
    <div class="info-item">
        <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
        <?php if ($item['sale'] > 0) { ?>
            <p><strike class="sale"><?= formatPrice($item['price']) ?></strike> <b
                        class="price"><?= SalePrice($item['price'], $item['sale']) ?> đ</b></p>
        <?php } else { ?>
            <p><b class="price"><?= formatPrice($item['price']) ?> đ</b></p>
        <?php } ?>
    </div>
    <div class="hidenitem">
        <p><a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>"><i class="fa fa-search"></i></a>
        </p>
        <p><a href=""><i class="fa fa-heart"></i></a></p>
        <p><a href="http://banhang.test/add_to_cart.php?id=<?= $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a>
        </p>
    </div>
</div>