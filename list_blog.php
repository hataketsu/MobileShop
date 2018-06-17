<?php require_once __DIR__ . "/autoload/autoload.php";

if (isset($_REQUEST['page'])) {
    $page = intval($_REQUEST['page']);
} else $page = 1;

$blogs = $db->fetchJone('blogs', 'select * from blogs', $page, BLOGS_PER_PAGE, true);

$page_number = $blogs['page'];
unset($blogs['page']);
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a>Danh sách bài viết</a></h3>

        <?php foreach ($blogs as $blog) {
            ?>
            <div style="margin-top: 10px;margin-bottom: 10px">
                <p><a style="font-size: 24px" href="show_blog.php?id=<?= $blog['id'] ?>"><?= $blog['title'] ?></a>
                </p>
                <p><?= date('d/m/Y', $blog['date']) ?></p>
            </div>
            <?php
        } ?>

    </section>
    <div class="row" style="text-align: center">
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $page_number; $i++) { ?>
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        ?>
                        <li class="page-item<?= ($i == $page) ? 'active' : '' ?>"><a
                                    class="page-link"
                                    href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
    </div>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>




