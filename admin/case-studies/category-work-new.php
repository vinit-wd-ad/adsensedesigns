<?php
// Include central configurations to auto-load session, database, and helper functions
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_work_category');
$isEdit = false;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = intval($_GET['eid']);
    $category = $obj->find($eid);

    if (!$category) {
        redirect("admin/case-studies/category-work-list.php");
    }
} else {
    // SECURITY: Moderators are strictly restricted from adding new categories
    if ($current_user_role === 'Moderator') {
        redirect("admin/case-studies/category-work-list.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">
            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                <?= $isEdit ? 'Edit Category Details' : 'Add New Work Category' ?>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/category-work-list.php" class="btn btn-primary">
                                Categories List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_category_work.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <?php if ($isEdit) { ?>
                                <input type="hidden" name="id" value="<?= $category['id'] ?>" />
                            <?php } ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" id="category_name" name="name" class="form-control" placeholder="e.g. Web Development" value="<?= $isEdit ? htmlspecialchars($category['name']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" id="category_slug" name="slug" class="form-control" placeholder="e.g. web-development" value="<?= $isEdit ? htmlspecialchars($category['slug']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon Code / Class (Optional)</label>
                                    <input type="text" name="icon" class="form-control" placeholder='e.g. <i class="fa-solid fa-house"></i> or fa-solid fa-house' value="<?= $isEdit ? htmlspecialchars($category['icon']) : '' ?>">
                                    <div class="form-text">You can paste full icon HTML code or just the class name.</div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Category Image (Optional)</label>
                                    <input type="file" name="image" class="form-control">

                                    <?php if ($isEdit && !empty($category['image'])): ?>
                                        <div class="mt-2">
                                            <small class="text-muted d-block mb-1">Current Image Asset:</small>
                                            <img src="<?= BASE_URL . 'uploads/categories/' . $category['image'] ?>" style="max-width:80px; max-height:80px; object-fit:contain;" class="img-thumbnail">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mb-3 fs-3">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <?= $isEdit ? 'Update Category' : 'Save Category' ?>
                                </button>
                                <a href="<?= BASE_URL ?>admin/case-studies/category-work-list.php" class="btn btn-light-danger text-danger">
                                    Cancel
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adsensedesigns.com" target="_blank" class="pe-1 text-primary text-decoration-underline">Adsensedesigns</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php include BASE_PATH . "admin/includes/script.php" ?>

    <script>
        document.getElementById('category_name').addEventListener('input', function() {
            if (document.getElementById('category_slug').dataset.edited !== "true") {
                let text = this.value.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                document.getElementById('category_slug').value = text;
            }
        });
        document.getElementById('category_slug').addEventListener('change', function() {
            this.dataset.edited = "true";
        });
    </script>
</body>

</html>