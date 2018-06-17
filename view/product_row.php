<li class="clearfix">
    <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
        <img src="<?= uploads() ?>product/<?= $item['image'] ?>"
             class="img-responsive pull-left" width="80" height="80">
        <div class="info pull-right">
            <p class="name"><?= $item['name'] ?></p>
            <?php if ($item['sale'] > 0) { ?>
                <b class="price">Giảm giá: <?= SalePrice($item['price'], $item['sale']) ?> đ</b><br>
                <b class="sale">Giá gốc: <?= formatPrice($item['price']) ?> đ</b><br>
            <?php } else { ?>
                <b class="price">Giá: <?= formatPrice($item['price']) ?> đ</b><br>
            <?php } ?>
        </div>
    </a>
</li>