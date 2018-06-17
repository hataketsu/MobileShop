<?php require_once __DIR__ . "/autoload/autoload.php";

$blog_id = $_REQUEST['id'];
$blog = $db->findByID('blogs', $blog_id);
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a><?= $blog['title'] ?></a></h3>
        <p style="margin: 20px"><?= $blog['content'] ?><br></p>
    </section>
    <div class="fb-comments" data-href="<?= base_url() ?>/blog/<?= $blog['id'] ?>" data-width="800"
         data-numposts="5"></div>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




