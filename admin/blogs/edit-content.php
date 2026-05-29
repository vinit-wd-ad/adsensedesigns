<?php
require "../../setting.php";

$obj = new Database('blogs');
$isEdit = false;
if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $blog = $obj->find($eid);
}
$blog_id = $_GET['blog_id'];
$objContent = new Database('blogs_content');
$contentRows = $objContent->where(['blog_id' => $blog_id]);
$old_content = !empty($contentRows) ? $contentRows[0]['content'] : '';
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>

    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
        data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar -->
        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <!-- Main Wrapper -->
        <div class="body-wrapper">

            <!-- Header -->
            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">

                <!-- Add Admin Form -->
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-4">Content</h5>
                            <a href="<?= BASE_URL ?>admin/blogs/blog-list.php" class="btn btn-primary">
                                Back
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_content.php" method="POST">
                            <input type="hidden" name="blog_id" value="<?= $blog_id ?>">

                            <div class="mb-3">
                                <label class="form-label">Blog Content</label>
                                <textarea id="editor" name="content" class="form-control"><?= $old_content ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Update Content</button>
                        </form>

                        <script>
                            const editorElement = document.querySelector('#editor');
                            if (editorElement) {
                                ClassicEditor.create(editorElement);
                            } else {
                                console.error("Editor element nahi mila!");
                            }
                        </script>

                    </div>
                </div>

                <!-- Footer -->
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">
                        Design and Developed by
                        <a href=""
                            target="_blank"
                            class="pe-1 text-primary text-decoration-underline">
                            Adsensedesigns
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.querySelector('input[name="slug"]');

        nameInput.addEventListener('input', function() {
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');

            slugInput.value = slug;
        });
    </script>

    <?php include BASE_PATH . "admin/includes/script.php" ?>

</body>

</html>