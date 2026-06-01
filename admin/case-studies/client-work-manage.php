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

// Inline AJAX Dynamic Data Handlers (Returns active works for requested category)
if (isset($_GET['fetch_works']) && isset($_GET['cat_id'])) {
    header('Content-Type: application/json');
    $cat_id = intval($_GET['cat_id']);
    $dbWork = new Database('portfolio_work');
    $records = $dbWork->where(['category_id' => $cat_id, 'status' => 'active']);
    echo json_encode($records ? $records : []);
    exit;
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
    $dbClientWorkLook = new Database('portfolio_client_work');
    $editRow = $dbClientWorkLook->find(intval($_GET['edit_id']));
    if ($editRow && intval($editRow['client_id']) === $client_id) {
        $isEdit = true;
    }
}

$dbCategory = new Database('portfolio_work_category');
$categories = $dbCategory->fetchAll();

$dbClientWork = new Database('portfolio_client_work');
$assignedWorks = $dbClientWork->where(['client_id' => $client_id]);

// Collect already assigned category IDs for UI workflow blocking validation controls
$existingCategoryIds = [];
if (!empty($assignedWorks)) {
    foreach ($assignedWorks as $assignedItem) {
        $existingCategoryIds[] = intval($assignedItem['category_id']);
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

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                <?= $isEdit ? 'Modify Allocated Works' : 'Assign Portfolio Works' ?> to: <span class="text-primary"><?= htmlspecialchars($client['company_name']) ?></span>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/client-list.php" class="btn btn-outline-primary">
                                Back to Clients
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_client_work.php" method="POST" class="mt-3">
                            <input type="hidden" name="client_id" value="<?= $client_id ?>" />
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="id" value="<?= $editRow['id'] ?>" />
                                <input type="hidden" name="category_id" value="<?= $editRow['category_id'] ?>" />
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Select Scope Category</label>
                                            <select id="category_dropdown" name="category_id" class="form-select" required <?= ($current_user_role === 'Moderator' || $isEdit) ? 'disabled' : '' ?>>
                                                <option value="">-- Choose Category --</option>
                                                <?php if (!empty($categories)): ?>
                                                    <?php foreach ($categories as $cat):
                                                        // Disable choice option if it exists inside historical records map array, except when active edit targets it
                                                        $shouldDisable = in_array(intval($cat['id']), $existingCategoryIds) && (!$isEdit || $editRow['category_id'] != $cat['id']);
                                                    ?>
                                                        <option value="<?= $cat['id'] ?>" <?= ($isEdit && $editRow['category_id'] == $cat['id']) ? 'selected' : '' ?> <?= $shouldDisable ? 'disabled style="color:#aaa; background:#f4f4f4;"' : '' ?>>
                                                            <?= htmlspecialchars($cat['name']) ?> <?= $shouldDisable ? ' (Already Mapped)' : '' ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if ($isEdit): ?><div class="form-text text-danger">Category cannot be altered during modification.</div><?php endif; ?>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Sort Priority</label>
                                            <input type="text" name="priority" class="form-control" placeholder="e.g. High, Medium, 1, 2" value="<?= $isEdit ? htmlspecialchars($editRow['priority']) : '' ?>" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Status State</label>
                                            <select name="status" class="form-select" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                                <option value="active" <?= ($isEdit && $editRow['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?= ($isEdit && $editRow['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 mb-4">
                                    <label class="form-label fw-bold">Select Works Entities (Hold Ctrl / Cmd to add/remove multiple)</label>
                                    <select id="works_multiselect" name="work_ids[]" class="form-select" style="height: 210px;" multiple required <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                    </select>
                                </div>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mb-3 fs-3 fw-semibold"><?= htmlspecialchars($_GET['error']) ?></div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
                                <div class="alert alert-success p-2 mb-3 fs-3">Mapping parameter configurations allocated successfully!</div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
                                <div class="alert alert-info p-2 mb-3 fs-3">Allocations modified and synced successfully!</div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                                <div class="alert alert-warning p-2 mb-3 fs-3">Mapping configurations dropped successfully.</div>
                            <?php endif; ?>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                    <?= $isEdit ? 'Update Allocations' : 'Save Allocations' ?>
                                </button>
                                <?php if ($isEdit): ?>
                                    <a href="<?= BASE_URL ?>admin/case-studies/client-work-manage.php?client_id=<?= $client_id ?>" class="btn btn-light-danger text-danger btn-lg">Cancel Edit</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-3">Assigned Category Configurations</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Scope</th>
                                        <th class="text-start">Linked Target Items</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($assignedWorks)): ?>
                                        <?php foreach ($assignedWorks as $row):
                                            $catMeta = $dbCategory->find($row['category_id']);
                                            $rawJsonIds = json_decode($row['work_ids'], true);
                                            $workLabels = [];

                                            if (!empty($rawJsonIds)) {
                                                $dbWorkLookup = new Database('portfolio_work');
                                                foreach ($rawJsonIds as $wId) {
                                                    $wMeta = $dbWorkLookup->find($wId);
                                                    if ($wMeta) {
                                                        $workLabels[] = htmlspecialchars($wMeta['name']);
                                                    }
                                                }
                                            }
                                        ?>
                                            <tr class="<?= ($isEdit && $editRow['id'] == $row['id']) ? 'table-info' : '' ?>">
                                                <td><?= $row['id'] ?></td>
                                                <td><span class="badge bg-primary fs-2"><?= $catMeta ? htmlspecialchars($catMeta['name']) : 'Unknown' ?></span></td>
                                                <td class="text-start">
                                                    <?php foreach ($workLabels as $label): ?>
                                                        <span class="badge bg-light text-dark border me-1 my-1 d-inline-block fs-2"><i class="ti ti-check text-success me-1"></i><?= $label ?></span>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><span class="text-dark font-medium"><?= htmlspecialchars($row['priority']) ?></span></td>
                                                <td>
                                                    <span class="badge <?= $row['status'] === 'active' ? 'bg-light-success text-success' : 'bg-light-danger text-danger' ?> border text-capitalize">
                                                        <?= htmlspecialchars($row['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="<?= BASE_URL ?>admin/case-studies/client-work-manage.php?client_id=<?= $client_id ?>&edit_id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>

                                                        <?php if ($current_user_role === 'Super Admin'): ?>
                                                            <a href="<?= BASE_URL ?>admin/classes/process_client_work.php?action=delete&id=<?= $row['id'] ?>&client_id=<?= $client_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to decouple this workspace profile mapping configuration?');">Remove</a>
                                                        <?php else: ?>
                                                            <button class="btn btn-sm btn-secondary" disabled>Remove</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-muted py-3">No mapped allocation records generated for this identity context profile.</td>
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

    <script>
        const savedWorkIds = <?= ($isEdit) ? $editRow['work_ids'] : '[]' ?>;

        function fetchAndPopulateWorks(categoryId) {
            let workDropdown = document.getElementById('works_multiselect');
            workDropdown.innerHTML = '';

            if (!categoryId) return;

            fetch(`client-work-manage.php?fetch_works=1&cat_id=${categoryId}&client_id=<?= $client_id ?>`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        let opt = document.createElement('option');
                        opt.value = "";
                        opt.textContent = "No active work items registered inside this category profile framework.";
                        opt.disabled = true;
                        workDropdown.appendChild(opt);
                    } else {
                        data.forEach(work => {
                            let opt = document.createElement('option');
                            opt.value = work.id;
                            opt.textContent = work.name;

                            if (savedWorkIds.includes(parseInt(work.id))) {
                                opt.selected = true;
                            }
                            workDropdown.appendChild(opt);
                        });
                    }
                })
                .catch(error => console.error('Data pipeline exception triggered during fetch lifecycle:', error));
        }

        document.getElementById('category_dropdown').addEventListener('change', function() {
            fetchAndPopulateWorks(this.value);
        });

        <?php if ($isEdit): ?>
            fetchAndPopulateWorks(<?= intval($editRow['category_id']) ?>);
        <?php endif; ?>
    </script>
</body>

</html>