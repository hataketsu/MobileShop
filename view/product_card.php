<div class="col-md-3 item-product bor">
    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
        <img src="<?php echo uploads() ?>/product/<?php echo $item['image'] ?>" width="100%"
             height="180">
    </a>
    <div class="info-item">
        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
        <?php if ($item['sale'] > 0) { ?>
            <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike> <b
                        class="price"><?php echo SalePrice($item['price'], $item['sale']) ?> đ</b></p>
        <?php } else { ?>
            <p><b class="price"><?php echo formatPrice($item['price']) ?> đ</b></p>
        <?php } ?>
    </div>
    <div class="hidenitem">
        <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a>
        </p>
        <p><a href=""><i class="fa fa-heart"></i></a></p>
        <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
    </div>
</div>