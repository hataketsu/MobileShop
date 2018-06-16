<?php require_once __DIR__ . "/autoload/autoload.php";

$category_id = intval(getInput('id'));
$category = $db->findByID("category", $category_id);

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 1;
}

$sql = "select * from product where category_id =$category_id";

$total = count($db->fetchsql($sql));
$product = $db->fetchJones("product", $sql, $total, $page, 3, true);
$sotrang = $product['page'];
unset($product['page']);

$path = $_SERVER['SCRIPT_NAME'];
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>

<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a href=""><?= $category['name'] ?></a></h3>
        <div class="showitem clearfix">

            <?php foreach ($product as $item) {
                include 'view/product_card.php';
            }
            ?>

        </div>
        <nav class="text-center">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $sotrang; $i++): ?>

                    <li class="<?= $_GET['p'] == $i ? 'active' : '' ?>">
                        <a href="<?= $path ?>?id=<?= $category_id ?>&p=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>


            </ul>
        </nav>


    </section>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




