<?php
require "../../setting.php";
require_once BASE_PATH . 'classes/Database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    header("Location: " . BASE_URL . "admin/login.php");
    exit;
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_client');
$isEdit = false;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $client = $obj->find($eid);

    if (!$client) {
        header("Location: " . BASE_URL . "admin/clients/client-list.php");
        exit;
    }
} else {
    // SECURITY: Moderator naya client add nahi kar sakta
    if ($current_user_role === 'Moderator') {
        header("Location: " . BASE_URL . "admin/clients/client-list.php");
        exit;
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
                                <?= $isEdit ? 'Edit Client Details' : 'Add New Portfolio Client' ?>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/client-list.php" class="btn btn-primary">
                                Clients List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_client.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <?php if ($isEdit) { ?>
                                <input type="hidden" name="id" value="<?= $client['id'] ?>" />
                            <?php } ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Enter company name" value="<?= $isEdit ? htmlspecialchars($client['company_name']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" name="website_url" class="form-control" placeholder="https://example.com" value="<?= $isEdit ? htmlspecialchars($client['website_url']) : '' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="client@company.com" value="<?= $isEdit ? htmlspecialchars($client['email']) : '' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter contact number" value="<?= $isEdit ? htmlspecialchars($client['phone']) : '' ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Industry</label>
                                    <input type="text" name="industry" class="form-control" placeholder="e.g. IT, Finance, Healthcare" value="<?= $isEdit ? htmlspecialchars($client['industry']) : '' ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Priority Order</label>
                                    <input type="number" name="priority" class="form-control" placeholder="e.g. 1, 2, 3" value="<?= $isEdit ? htmlspecialchars($client['priority']) : '1' ?>" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Status</label>
                                    <?php if ($current_user_role !== 'Moderator'): ?>
                                        <select name="status" class="form-select" required>
                                            <option <?= ($isEdit && $client['status'] == 'Active') ? 'selected' : '' ?> value="Active">Active</option>
                                            <option <?= ($isEdit && $client['status'] == 'Inactive') ? 'selected' : '' ?> value="Inactive">Inactive</option>
                                        </select>
                                    <?php else: ?>
                                        <select class="form-select" disabled>
                                            <option selected><?= $isEdit ? htmlspecialchars($client['status']) : 'Active' ?></option>
                                        </select>
                                        <input type="hidden" name="status" value="<?= $isEdit ? htmlspecialchars($client['status']) : 'Active' ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" name="logo" class="form-control">

                                    <?php if ($isEdit && !empty($client['logo_url'])): ?>
                                        <div class="mt-2">
                                            <small class="text-muted d-block mb-1">Current Logo:</small>
                                            <img src="<?= BASE_URL . 'uploads/clients/' . $client['logo_url'] ?>" style="max-width:120px; max-height:120px; object-fit:contain;" class="img-thumbnail">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="4" placeholder="Write a brief about the client..."><?= $isEdit ? htmlspecialchars($client['short_description']) : '' ?></textarea>
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mb-3 fs-3">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <?= $isEdit ? 'Update Client' : 'Save Client' ?>
                                </button>
                                <a href="<?= BASE_URL ?>admin/case-studies/client-list.php" class="btn btn-light-danger text-danger">
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
</body>

</html>