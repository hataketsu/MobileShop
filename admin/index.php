<?php require_once __DIR__ . "/autoload/autoload.php";

$category = $db->fetchAll("category");

?>
<?php require_once __DIR__ . "/layouts/header.php"; ?>
    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Blank Page</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Blank</h1>
                <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>
                <?php var_dump($category); ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php require_once __DIR__ . "/layouts/footer.php"; ?>