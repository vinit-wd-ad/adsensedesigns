<?php
// Auto-loads centralized context and dynamic application handlers
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];

// Extract complete category mapping records from database context
$obj = new Database('portfolio_work_category');
$categories = $obj->fetchAll();
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
        data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">
            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">Portfolio Categories List</h5>

                            <?php if ($current_user_role !== 'Moderator'): ?>
                                <a href="<?= BASE_URL ?>admin/case-studies/category-work-new.php" class="btn btn-primary">
                                    Add New Category
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger p-3 mb-4 fs-3 fw-semibold">
                                <i class="ti ti-alert-triangle me-2"></i><?= htmlspecialchars($_GET['error']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                            <div class="alert alert-warning p-3 mb-4 fs-3">
                                <i class="ti ti-trash me-2"></i>Work Category master configuration and localized file logs dropped successfully.
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 8%;">#</th>
                                        <th style="width: 12%;">Icon</th>
                                        <th style="width: 15%;">Image</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                    ?>
                                            <tr>
                                                <td><?= $category['id'] ?></td>

                                                <td>
                                                    <?php if (!empty($category['icon'])): ?>
                                                        <?php if (strpos($category['icon'], '<i') !== false): ?>
                                                            <div class="fs-6 text-primary"><?= $category['icon'] ?></div>
                                                        <?php else: ?>
                                                            <div class="fs-6 text-primary"><i class="<?= htmlspecialchars($category['icon']) ?>"></i></div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted fs-2">-</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php if (!empty($category['image'])): ?>
                                                        <img src="<?= BASE_URL . 'uploads/categories/' . $category['image'] ?>" style="width:50px; height:50px; object-fit:contain;" class="img-thumbnail">
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-dark">No Image</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <span class="fw-semibold"><?= htmlspecialchars($category['name']) ?></span>
                                                </td>
                                                <td>
                                                    <code class="text-dark"><?= htmlspecialchars($category['slug']) ?></code>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="<?= BASE_URL ?>admin/case-studies/work-new.php?cid=<?= $category['id'] ?>" class="btn btn-sm btn-success d-inline-flex align-items-center">
                                                            Add Work
                                                        </a>

                                                        <a href="<?= BASE_URL ?>admin/case-studies/category-work-new.php?eid=<?= $category['id'] ?>" class="btn btn-sm btn-info">
                                                            Edit
                                                        </a>

                                                        <?php if ($current_user_role === 'Super Admin'): ?>
                                                            <a href="<?= BASE_URL ?>admin/classes/process_category_work.php?action=delete&id=<?= $category['id'] ?>"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to completely remove this work category? This action will permanently drop the mapped database record and clear its asset files.');">
                                                                Delete
                                                            </a>
                                                        <?php else: ?>
                                                            <button class="btn btn-sm btn-secondary" disabled title="Only Super Admins hold delete operations permissions">Delete</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-muted text-center">No Categories Found.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adsensedesigns.com" target="_blank" class="pe-1 text-primary text-decoration-underline">Adsensedesigns</a></p>
                </div>

            </div>
        </div>
    </div>

    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>