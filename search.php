<?php require_once __DIR__ . "/autoload/autoload.php";

$sqlHomecate = "select name,id from category where home = 1 order by updated_at ";
$categoryHome = $db->fetchsql($sqlHomecate);

$data = [];
foreach ($categoryHome as $item) {
    $cateId = intval($item['id']);
    $sql = "select * from product where category_id=$cateId";
    $productHome = $db->fetchsql($sql);
    $data[$item['name']] = $productHome;
}
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section id="slide" class="text-center">
        <img src="<?= base_url() ?>public/frontend/images/banner.jpg" width="100%">
    </section>

    <section class="box-main1">
        <?php foreach ($data as $key => $value): ?>
            <h3 class="title-main"><a href=""> <?= $key ?></a></h3>
            <div class="showitem row">
                <?php foreach ($value as $item) {
                    include 'view/product_card.php';
                } ?>
            </div>
        <?php endforeach ?>
    </section>

</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>



 
