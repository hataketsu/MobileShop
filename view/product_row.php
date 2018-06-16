<li class="clearfix">
    <a href="chi-tiet-san-pham.php?id=<?= $item['id'] ?>">
        <img src="<?php echo uploads() ?>product/<?php echo $item['image'] ?>"
             class="img-responsive pull-left" width="80" height="80">
        <div class="info pull-right">
            <p class="name"><?php echo $item['name'] ?></p>
            <b class="price">Giảm giá: 6.090.000 đ</b><br>
            <b class="sale">Giá gốc: 7.000.000 đ</b><br>
            <span class="view"><i class="fa fa-eye"></i> 100000 : <i
                    class="fa fa-heart-o"></i> 10</span>
        </div>
    </a>
</li>