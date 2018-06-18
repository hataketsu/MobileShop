<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pageNumber; $i++) { ?>
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $query = $_GET;
            unset($query['page']);
            $append = http_build_query($query);
            ?>
            <li class="page-item<?= ($i == $page) ? 'active' : '' ?>"><a
                        class="page-link"
                        href="?page=<?= $i; ?>&<?= $append ?>"><?= $i; ?></a></li>
        <?php } ?>
    </ul>
</nav>
