<?php require_once __DIR__ . "/autoload/autoload.php";

$category_id = intval($_REQUEST['category']);
if (isset($_REQUEST['page']))
    $page = intval($_REQUEST['page']);
else $page = 1;
$keyword = $_REQUEST['keyword'];
if ($category_id == -1) {
    $sql = " select * from product where name like '%$keyword%' ";
} else {
    $sql = " select * from product  where name like '%$keyword%' and category_id = $category_id ";
}

$products = $db->fetchJone("product", $sql, $page, PRODUCTS_PER_SEARCH, true);

if (isset($products['page'])) {
    $pageNumber = $products['page'];
    unset($products['page']);
}

?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a> Kết quả tim kiếm cho từ khóa "<?= $keyword ?>"</a></h3>
        <div class="showitem row">
            <?php foreach ($products as $item) {
                include 'view/product_card.php';
            } ?>
        </div>
        <div style="text-align: center">
            <?php include 'view/page_index.php'; ?>
        </div>
    </section>

</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>



 
