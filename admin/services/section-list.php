<?php
require "../../setting.php";

$obj = new Database('service_section');
$wrapObj = new Database('service_wrapper');

// Check if filtering by specific wrapper
$wrapper_id = isset($_GET['wrapper_id']) ? intval($_GET['wrapper_id']) : null;
$filteredWrapper = null;

if ($wrapper_id) {
    $sections = $obj->where(['wrapper_id' => $wrapper_id]);
    $filteredWrapper = $wrapObj->find($wrapper_id);
} else {
    $sections = $obj->fetchAll();
}

function getWrapperName($wrapperId)
{
    if (empty($wrapperId)) return '<span class="text-danger">Unassigned</span>';
    global $wrapObj;
    $wrapper = $wrapObj->find($wrapperId);
    return $wrapper ? htmlspecialchars($wrapper['name']) : '<span class="text-danger">Deleted</span>';
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

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">
                                <?= $filteredWrapper ? "Sections for Wrapper: " . htmlspecialchars($filteredWrapper['name']) : "All Service Sections" ?>
                            </h5>

                            <div>
                                <a href="<?= BASE_URL ?>admin/services/wrapper-list.php<?= $filteredWrapper ? '?service_id=' . $filteredWrapper['service_id'] : '' ?>" class="btn btn-outline-secondary me-2">
                                    Back to Wrappers
                                </a>
                                <a href="<?= BASE_URL ?>admin/services/section-new.php<?= $wrapper_id ? '?wrapper_id=' . $wrapper_id : '' ?>" class="btn btn-primary">
                                    Add Section
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th style="width: 110px;">Image / Icon</th> 
                                        <th class="text-start">Section Title</th>
                                        <th>Assigned Wrapper</th>
                                        <th style="width: 80px;">Priority</th>
                                        <th style="width: 110px;">Status</th>
                                        <th style="width: 220px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($sections)): ?>
                                        <?php foreach ($sections as $sec) { ?>
                                            <tr>
                                                <td><?= $sec['id'] ?></td>
                                                
                                                <td>
                                                    <?php if (!empty($sec['image'])): ?>
                                                        <a href="<?= BASE_URL ?>uploads/sections/<?= $sec['image'] ?>" target="_blank">
                                                            <img src="<?= BASE_URL ?>uploads/sections/<?= $sec['image'] ?>" 
                                                                 alt="Section Image" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 60px; max-height: 45px; object-fit: cover;">
                                                        </a>
                                                    <?php elseif (!empty($sec['icon'])): ?>
                                                        <div class="p-2 border rounded bg-light d-inline-block" title="<?= htmlspecialchars($sec['icon']) ?>">
                                                            <?= $sec['icon'] ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-muted border font-monospace small">No Media</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-start">
                                                    <div class="fw-bold text-dark"><?= htmlspecialchars($sec['title']) ?></div>
                                                </td>
                                                <td class="fw-semibold text-primary"><?= getWrapperName($sec['wrapper_id']) ?></td>
                                                <td><span class="badge bg-secondary font-monospace"><?= intval($sec['priority']) ?></span></td>
                                                <td><span class="badge <?= $sec['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($sec['status']) ?></span></td>

                                                <td>
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <a href="<?= BASE_URL ?>admin/services/content-list.php?section_id=<?= $sec['id'] ?>"
                                                            class="btn btn-sm btn-warning text-white">
                                                            <i class="ti ti-components"></i> Content
                                                        </a>
                                                        <a href="<?= BASE_URL ?>admin/services/section-new.php?eid=<?= $sec['id'] ?><?= $wrapper_id ? '&wrapper_id=' . $wrapper_id : '' ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="ti ti-edit"></i> Edit
                                                        </a>
                                                        <a href="<?= BASE_URL ?>admin/classes/process_section.php?action=delete&id=<?= $sec['id'] ?>&wrapper_id=<?= $sec['wrapper_id'] ?>"
                                                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="ti ti-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center p-4 text-muted bg-light">
                                                No sections added for this wrapper yet.
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