<?php
require "../../setting.php";

$obj = new Database('blogs_categories');
$isEdit = false;
if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $category = $obj->find($eid);
}
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
                            <h5 class="card-title fw-semibold mb-4">Add New Category</h5>
                            <a href="<?= BASE_URL ?>admin/blogs/category-list.php" class="btn btn-primary">
                                Categories List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_category.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $isEdit ? $category['id'] : '' ?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= $isEdit ? $category['name'] : '' ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="<?= $isEdit ? $category['slug'] : '' ?>">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">

                                    <?php if ($isEdit && !empty($category['image'])): ?>
                                        <div class="mt-2">
                                            <small>Current Image:</small><br>
                                            <img src="<?= BASE_URL . 'uploads/categories/' . $category['image'] ?>" style="width:300px;" class="img-thumbnail">
                                            <input type="hidden" name="old_image" value="<?= $category['image'] ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="">
                                    <?php
                                    if (isset($_GET['error'])) {
                                        echo "<p class='text-danger'>" . $_GET['error'] . "</p>";
                                    }
                                    ?>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Save Category</button>
                        </form>

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