<?php
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];

$obj = new Database('portfolio_client');
$clients = $obj->fetchAll();
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

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger p-3 mb-4 fs-3 fw-semibold">
                        <i class="ti ti-alert-triangle me-2"></i><?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
                    <div class="alert alert-success p-3 mb-4 fs-3">Client profile saved successfully!</div>
                <?php endif; ?>

                <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                    <div class="alert alert-warning p-3 mb-4 fs-3"><i class="ti ti-trash me-2"></i>Client master record dropped successfully from storage tracking.</div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">Portfolio Clients List</h5>

                            <?php if ($current_user_role !== 'Moderator'): ?>
                                <a href="<?= BASE_URL ?>admin/case-studies/client-new.php" class="btn btn-primary">
                                    Add New Client
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Company Name</th>
                                        <th>Contact Info</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th style="width: 25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($clients)) {
                                        foreach ($clients as $client) {
                                    ?>
                                            <tr>
                                                <td><?= $client['id'] ?></td>
                                                <td>
                                                    <?php if (!empty($client['logo_url'])): ?>
                                                        <img src="<?= BASE_URL . 'uploads/clients/' . $client['logo_url'] ?>" style="width:50px; height:50px; object-fit:contain;" class="img-thumbnail">
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-dark">No Logo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="fw-semibold d-block"><?= htmlspecialchars($client['company_name']) ?></span>
                                                    <?php if (!empty($client['website_url'])): ?>
                                                        <a href="<?= htmlspecialchars($client['website_url']) ?>" target="_blank" class="fs-2 text-primary">Visit Website</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-start fs-3">
                                                    <strong>E:</strong> <?= htmlspecialchars($client['email']) ?><br>
                                                    <strong>P:</strong> <?= htmlspecialchars($client['phone']) ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info text-white"><?= htmlspecialchars($client['priority']) ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge <?= $client['status'] === 'Active' ? 'bg-light-success text-success' : 'bg-light-danger text-danger' ?> border">
                                                        <?= htmlspecialchars($client['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <!-- Top Line: Primary Actions -->
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="<?= BASE_URL ?>admin/case-studies/client-links-manage.php?client_id=<?= $client['id'] ?>" class="btn btn-sm btn-info">
                                                                Add Links
                                                            </a>
                                                            <a href="<?= BASE_URL ?>admin/case-studies/client-work-manage.php?client_id=<?= $client['id'] ?>" class="btn btn-sm btn-success">
                                                                Add Work
                                                            </a>
                                                            <a href="<?= BASE_URL ?>admin/case-studies/client-image-manage.php?client_id=<?= $client['id'] ?>" class="btn btn-sm btn-warning text-white">
                                                                Add Images
                                                            </a>
                                                        </div>

                                                        <!-- Bottom Line: Management Actions -->
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="<?= BASE_URL ?>admin/case-studies/client-new.php?eid=<?= $client['id'] ?>" class="btn btn-sm btn-info">
                                                                Edit
                                                            </a>

                                                            <?php if ($current_user_role === 'Super Admin'): ?>
                                                                <a href="<?= BASE_URL ?>admin/classes/process_client.php?action=delete&id=<?= $client['id'] ?>"
                                                                    class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Are you sure you want to completely remove this client? This will affect its mapped work and images.');">
                                                                    Delete
                                                                </a>
                                                            <?php else: ?>
                                                                <button class="btn btn-sm btn-secondary" disabled>Delete</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-muted text-center">No Clients Found.</td>
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