<?php require_once __DIR__ . "/../../autoload/autoload.php";
$open = "blogs";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = postInput('blog_id');

    $title = trim(postInput('title'));
    $content = trim(postInput('content'));

    $error = [];
    if ($title == '') {
        $error['name'] = "Mời bạn nhập tiêu đề bài viết";
    }

    if ($content == '') {
        $error['content'] = "Mời bạn nhập nội dung bài viết";
    }

    $data = [
        'title' => $title,
        'content' => $content,
        'date' => time()
    ];

    if (empty($error)) {
        if ($blog_id == -1) { //create new one
            $id_ = $db->insert("blogs", $data);
        } else {
            $id_ = $db->update('blogs', $data, ["id" => $blog_id]);
        }
        if ($id_ > 0) {
            $_SESSION['success'] = "Them moi thanh cong";
        } else {
            $_SESSION['error'] = "Them moi that bai";
        }
    }
    redirectAdmin("blogs");
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_REQUEST['id'])) {
        $blog_id = $_REQUEST['id'];
        $blog = $db->findByID('blogs', $blog_id);
        $mode = 'edit';
        $_title = 'Sửa bài viết';
    } else {
        $blog_id = -1;
        $mode = 'new';
        $blog = ['title' => 'Chưa có tiêu đề', 'content' => 'Chưa có nội dung'];
        $_title = 'Thêm bài viết';
    }
}

?>
<?php require_once __DIR__ . "/../../layouts/header.php" ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= modules('blogs') ?>">Quản lý bài viết</a>
                </li>
                <li class="breadcrumb-item active"><?= $_title ?></li>
            </ol>
            <div class="row">
                <div class="col-12">
                    <h1><?= $_title ?></h1>
                    <form action="" method="POST">
                        <input type="hidden" value="<?= $blog_id ?>" name="blog_id">

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="title" value="<?= $blog['title'] ?> ">
                            <?php if (isset($error['name'])): ?>
                                <p class="text-danger"> <?= $error['name']; ?></p>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label>Nội dung bài viết</label>
                            <textarea class="form-control" name="content" id="content_editor"
                                      style="width: 100%;height: 300px;"><?= $blog['content'] ?></textarea>
                            <?php if (isset($error['name'])): ?>
                                <p class="text-danger"> <?= $error['name']; ?></p>
                            <?php endif ?>
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                        <br>
                    </form>

                </div>
            </div>
        </div>
        <script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
        <script>
            $(function () {
                CKEDITOR.replace('content_editor');
            });
        </script>
    </div>
<?php require_once __DIR__ . " /../../layouts/footer.php" ?>