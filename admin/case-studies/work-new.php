<?php
// Include configuration setup context
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];

// Extract the targeted Category ID context from URL query parameters
$category_id = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

if ($category_id === 0) {
    redirect("admin/case-studies/category-work-list.php");
}

// Fetch current category metadata details for descriptive UI headers
$categoryObj = new Database('portfolio_work_category');
$currentCategory = $categoryObj->find($category_id);

if (!$currentCategory) {
    redirect("admin/case-studies/category-work-list.php");
}

// Fetch all registered work records linked explicitly to this category context
$workObj = new Database('portfolio_work');
$works = $workObj->where(['category_id' => $category_id]);
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

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                Manage Works for: <span class="text-primary"><?= htmlspecialchars($currentCategory['name']) ?></span>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/category-work-list.php" class="btn btn-outline-primary">
                                Back to Categories
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_portfolio_work.php" method="POST" class="mt-2">
                            <input type="hidden" name="category_id" value="<?= $category_id ?>" />

                            <div class="row align-items-center">
                                <div class="col-md-9 mb-3 mb-md-0">
                                    <label class="form-label fw-bold">Enter Work Title / Item Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Type work title and press Enter key..." required autofocus <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                    <div class="form-text">Pressing the <strong>Enter</strong> key automatically registers the new work item entry.</div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        Add Work Item
                                    </button>
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mt-3 mb-0 fs-3">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
                                <div class="alert alert-success p-2 mt-3 mb-0 fs-3">
                                    New work item added successfully!
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                                <div class="alert alert-warning p-2 mt-3 mb-0 fs-3">
                                    Work entry was successfully deleted.
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">Existing Registered Works List</h6>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 10%;">Work ID</th>
                                        <th class="text-start">Work Title / Item Name</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($works)): ?>
                                        <?php foreach ($works as $item): ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td class="text-start fw-semibold">
                                                    <?= htmlspecialchars($item['name']) ?>
                                                </td>
                                                <td>
                                                    <span class="badge <?= ($item['status'] === 'active' || $item['status'] === 'Active') ? 'bg-light-success text-success' : 'bg-light-danger text-danger' ?> border text-capitalize">
                                                        <?= htmlspecialchars($item['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($current_user_role === 'Super Admin'): ?>
                                                        <a href="<?= BASE_URL ?>admin/classes/process_portfolio_work.php?action=delete&id=<?= $item['id'] ?>&cid=<?= $category_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to permanently delete this item?');">
                                                            Remove
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-secondary" disabled title="Only Super Admins can delete entries">
                                                            Remove
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-muted py-3">No work records attached to this category context yet.</td>
                                        </tr>
                                    <?php endif; ?>
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