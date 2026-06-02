<?php
require "../../setting.php";

// Database initializations for service_wrapper and services
$obj = new Database('service_wrapper');
$svcObj = new Database('services');

// Check if filtering by specific service
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : null;
$filteredService = null;

if ($service_id) {
    $wrappers = $obj->where(['service_id' => $service_id]);
    $filteredService = $svcObj->find($service_id);
} else {
    $wrappers = $obj->fetchAll();
}

// Helper function to get Service Name
function getServiceName($serviceId)
{
    if (empty($serviceId)) return '<span class="text-danger">Unassigned</span>';
    global $svcObj;
    $service = $svcObj->find($serviceId);
    return $service ? htmlspecialchars($service['name']) : '<span class="text-danger">Deleted</span>';
}
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
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="ti ti-circle-check fs-5 me-2"></i> <?= htmlspecialchars($_GET['success']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="ti ti-alert-circle fs-5 me-2"></i> <?= htmlspecialchars($_GET['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                <?= $filteredService ? "Wrappers for: " . htmlspecialchars($filteredService['name']) : "All Service Wrappers" ?>
                            </h5>

                            <div>
                                <a href="<?= BASE_URL ?>admin/services/service-list.php" class="btn btn-outline-secondary me-2">
                                    Back to Services
                                </a>
                                <a href="<?= BASE_URL ?>admin/services/wrapper-new.php<?= $service_id ? '?service_id=' . $service_id : '' ?>" class="btn btn-primary">
                                    Add Wrapper
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th class="text-start">Wrapper Name</th>
                                        <th>Assigned Service</th>
                                        <th style="width: 80px;">Priority</th>
                                        <th style="width: 110px;">Status</th>
                                        <th style="width: 280px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($wrappers)): ?>
                                        <?php foreach ($wrappers as $wrap) { ?>
                                            <tr>
                                                <td><?= $wrap['id'] ?></td>
                                                <td class="text-start">
                                                    <div class="fw-bold text-dark"><?= htmlspecialchars($wrap['name']) ?></div>
                                                    <?php if (!empty($wrap['description'])): ?>
                                                        <small class="text-muted d-block text-truncate" style="max-width: 300px;"><?= htmlspecialchars($wrap['description']) ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fw-semibold text-primary"><?= getServiceName($wrap['service_id']) ?></td>
                                                <td><span class="badge bg-secondary font-monospace"><?= intval($wrap['priority']) ?></span></td>
                                                <td><span class="badge <?= $wrap['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($wrap['status']) ?></span></td>

                                                <td>
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <a href="<?= BASE_URL ?>admin/services/section-list.php?wrapper_id=<?= $wrap['id'] ?>"
                                                            class="btn btn-sm btn-warning text-white">
                                                            <i class="ti ti-folder"></i> Sections
                                                        </a>

                                                        <a href="<?= BASE_URL ?>admin/services/wrapper-new.php?eid=<?= $wrap['id'] ?><?= $service_id ? '&service_id=' . $service_id : '' ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="ti ti-edit"></i> Edit
                                                        </a>

                                                        <a href="<?= BASE_URL ?>admin/classes/process_wrapper.php?action=delete&id=<?= $wrap['id'] ?>"
                                                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this wrapper?')">
                                                            <i class="ti ti-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center p-4 text-muted bg-light">
                                                No wrappers added for this service yet.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>