<?php
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

if ($client_id === 0) {
    redirect("admin/case-studies/client-list.php");
}

// Fetch main client details context
$dbClient = new Database('portfolio_client');
$client = $dbClient->find($client_id);
if (!$client) {
    redirect("admin/case-studies/client-list.php");
}

// Check if Edit Mode is requested via URL parameter mappings
$isEdit = false;
$editRow = null;
if (isset($_GET['edit_id'])) {
    $dbClientLinkLook = new Database('portfolio_social');
    $editRow = $dbClientLinkLook->find(intval($_GET['edit_id']));
    if ($editRow && intval($editRow['client_id']) === $client_id) {
        $isEdit = true;
    }
}

$dbClientLink = new Database('portfolio_social');
$assignedLinks = $dbClientLink->where(['client_id' => $client_id]);

// Icon Mappings array
$socialPlatforms = [
    'Website'   => 'fa-solid fa-globe',
    'Instagram' => 'fa-brands fa-instagram',
    'Facebook'  => 'fa-brands fa-facebook',
    'YouTube'   => 'fa-brands fa-youtube',
    'Twitter'   => 'fa-brands fa-x-twitter',
    'LinkedIn'  => 'fa-brands fa-linkedin'
];
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
                                <?= $isEdit ? 'Modify Client Link' : 'Add Client Link' ?> to: <span class="text-primary"><?= htmlspecialchars($client['company_name']) ?></span>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/client-list.php" class="btn btn-outline-primary">
                                Back to Clients
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_client_links.php" method="POST" class="mt-3">
                            <input type="hidden" name="client_id" value="<?= $client_id ?>" />
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="id" value="<?= $editRow['id'] ?>" />
                            <?php endif; ?>

                            <!-- Hidden field to auto pass icon class to backend -->
                            <input type="hidden" id="icon_input" name="icon" value="<?= $isEdit ? htmlspecialchars($editRow['icon']) : '' ?>" />

                            <div class="row">
                                <!-- Platform Select Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Select Platform Name</label>
                                    <select id="platform_select" name="name" class="form-select" required <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        <option value="">-- Choose Platform --</option>
                                        <?php foreach ($socialPlatforms as $platform => $iconClass): ?>
                                            <option value="<?= $platform ?>" data-icon="<?= $iconClass ?>" <?= ($isEdit && $editRow['name'] === $platform) ? 'selected' : '' ?>>
                                                <?= $platform ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Target Link URL -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Link URL</label>
                                    <input type="url" name="link" class="form-control" placeholder="https://..." value="<?= $isEdit ? htmlspecialchars($editRow['link']) : '' ?>" required <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                </div>

                                <!-- Sort Order -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" placeholder="0" value="<?= $isEdit ? htmlspecialchars($editRow['sort_order']) : '0' ?>" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                </div>

                                <!-- Status State (Table database uses enum('1', '0')) -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status State</label>
                                    <select name="status" class="form-select" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        <option value="1" <?= ($isEdit && $editRow['status'] == '1') ? 'selected' : '' ?>>Active (1)</option>
                                        <option value="0" <?= ($isEdit && $editRow['status'] == '0') ? 'selected' : '' ?>>Inactive (0)</option>
                                    </select>
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mb-3 fs-3 fw-semibold"><?= htmlspecialchars($_GET['error']) ?></div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
                                <div class="alert alert-success p-2 mb-3 fs-3">Link allocated successfully!</div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
                                <div class="alert alert-info p-2 mb-3 fs-3">Link configuration updated successfully!</div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                                <div class="alert alert-warning p-2 mb-3 fs-3">Link record deleted successfully.</div>
                            <?php endif; ?>

                            <div class="d-flex gap-2 mt-2">
                                <button type="submit" class="btn btn-primary btn-lg" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                    <?= $isEdit ? 'Update Link' : 'Save Link' ?>
                                </button>
                                <?php if ($isEdit): ?>
                                    <a href="<?= BASE_URL ?>admin/case-studies/client-links-manage.php?client_id=<?= $client_id ?>" class="btn btn-light-danger text-danger btn-lg">Cancel Edit</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assigned Social Links Table -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">Assigned Client Social Links</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Platform</th>
                                        <th>Icon</th>
                                        <th class="text-start">Target URL</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($assignedLinks)): ?>
                                        <?php foreach ($assignedLinks as $row): ?>
                                            <tr class="<?= ($isEdit && $editRow['id'] == $row['id']) ? 'table-info' : '' ?>">
                                                <td><?= $row['id'] ?></td>
                                                <td><span class="badge bg-primary fs-2"><?= htmlspecialchars($row['name']) ?></span></td>
                                                <td><i class="<?= htmlspecialchars($row['icon']) ?> fs-5 text-primary"></i></td>
                                                <td class="text-start">
                                                    <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="text-decoration-underline text-truncate d-inline-block" style="max-width: 250px;">
                                                        <?= htmlspecialchars($row['link']) ?>
                                                    </a>
                                                </td>
                                                <td><span class="text-dark font-medium"><?= htmlspecialchars($row['sort_order']) ?></span></td>
                                                <td>
                                                    <span class="badge <?= $row['status'] == '1' ? 'bg-light-success text-success' : 'bg-light-danger text-danger' ?> border">
                                                        <?= $row['status'] == '1' ? 'Active' : 'Inactive' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="<?= BASE_URL ?>admin/case-studies/client-links-manage.php?client_id=<?= $client_id ?>&edit_id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>

                                                        <?php if ($current_user_role === 'Super Admin'): ?>
                                                            <a href="<?= BASE_URL ?>admin/classes/process_client_links.php?action=delete&id=<?= $row['id'] ?>&client_id=<?= $client_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this social link?');">Remove</a>
                                                        <?php else: ?>
                                                            <button class="btn btn-sm btn-secondary" disabled>Remove</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-muted py-3">No mapped social links found for this client.</td>
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

    <!-- Auto-Fill Icon Hidden Field JS Script -->
    <script>
        const platformSelect = document.getElementById('platform_select');
        const iconInput = document.getElementById('icon_input');

        platformSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const iconClass = selectedOption.getAttribute('data-icon') || '';
            iconInput.value = iconClass;
        });
    </script>
</body>

</html>