<?php
require "../../setting.php";

$obj = new Database('blogs');
$isEdit = false;
if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $blog = $obj->find($eid);
}
$objCat = new Database('blogs_categories');
$categories = $objCat->fetchAll('id, name, slug');
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
        data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">

            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Blog' : 'Add New Blog' ?></h5>
                            <a href="<?= BASE_URL ?>admin/blogs/blog-list.php" class="btn btn-primary">
                                Blogs List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_blog.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $isEdit ? $blog['id'] : '' ?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" id="blog_title" name="title" class="form-control" value="<?= $isEdit ? htmlspecialchars($blog['title']) : '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" id="blog_slug" name="slug" class="form-control" value="<?= $isEdit ? htmlspecialchars($blog['slug']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <?php foreach ($categories as $cat) { ?>
                                            <option value="<?= $cat['id'] ?>" <?= ($isEdit && $blog['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="draft" <?= ($isEdit && $blog['status'] === 'draft') ? 'selected' : '' ?>>draft</option>
                                        <option value="published" <?= ($isEdit && $blog['status'] === 'published') ? 'selected' : '' ?>>published</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <?php if ($isEdit && !empty($blog['image'])): ?>
                                    <div class="col-md-12 mb-3">
                                        <small class="text-muted d-block mb-1">Current Image:</small>
                                        <img src="<?= BASE_URL . 'uploads/blogs/' . $blog['image'] ?>" style="max-width:300px; height:auto;" class="img-thumbnail">
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="4"><?= $isEdit ? htmlspecialchars($blog['short_description']) : '' ?></textarea>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Save Blog</button>
                        </form>

                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">
                        Design and Developed by
                        <a href="https://adsensedesigns.com"
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
        const nameInput = document.getElementById('blog_title');
        const slugInput = document.getElementById('blog_slug');

        // PHP dynamic variable injection control state track karne ke liye
        const isEditMode = <?= $isEdit ? 'true' : 'false' ?>;

        nameInput.addEventListener('input', function() {
            // Edit mode me user ka likha hua purana slug overwrite hone se rokta hai
            if (isEditMode && slugInput.value.trim() !== "") {
                return;
            }

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