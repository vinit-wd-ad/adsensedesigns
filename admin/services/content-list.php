<?php
require "../../setting.php";

$obj = new Database('service_section_content');
$secObj = new Database('service_section');

// Check if filtering by specific section
$section_id = isset($_GET['section_id']) ? intval($_GET['section_id']) : null;
$filteredSection = null;

if ($section_id) {
    $contents = $obj->where(['section_id' => $section_id]);
    $filteredSection = $secObj->find($section_id);
} else {
    $contents = $obj->fetchAll();
}

function getSectionName($sectionId)
{
    if (empty($sectionId)) return '<span class="text-danger">Unassigned</span>';
    global $secObj;
    $section = $secObj->find($sectionId);
    return $section ? htmlspecialchars($section['title']) : '<span class="text-danger">Deleted</span>';
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
                                <?= $filteredSection ? "Contents for Section: " . htmlspecialchars($filteredSection['title']) : "All Section Contents" ?>
                            </h5>

                            <div>
                                <a href="<?= BASE_URL ?>admin/services/section-list.php<?= $filteredSection ? '?service_id=' . $filteredSection['service_id'] : '' ?>" class="btn btn-outline-secondary me-2">
                                    Back to Sections
                                </a>
                                <a href="<?= BASE_URL ?>admin/services/content-new.php<?= $section_id ? '?section_id=' . $section_id : '' ?>" class="btn btn-primary">
                                    Add Content
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th style="width: 80px;">Icon / Image</th>
                                        <th class="text-start">Content Title</th>
                                        <th>Assigned Section</th>
                                        <th style="width: 80px;">Priority</th>
                                        <th style="width: 110px;">Status</th>
                                        <th style="width: 180px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($contents)): ?>
                                        <?php foreach ($contents as $con) { ?>
                                            <tr>
                                                <td><?= $con['id'] ?></td>
                                                <td>
                                                    <?php if (!empty($con['image']) && file_exists(BASE_PATH . "uploads/contents/" . $con['image'])): ?>
                                                        <img src="<?= BASE_URL ?>uploads/contents/<?= $con['image'] ?>" class="rounded border" style="width: 50px; height: 40px; object-fit: cover;">
                                                    <?php elseif (!empty($con['icon'])): ?>
                                                        <i class="<?= htmlspecialchars($con['icon']) ?> fs-5 text-dark"></i>
                                                    <?php else: ?>
                                                        <span class="text-muted small">None</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-start">
                                                    <div class="fw-bold text-dark"><?= htmlspecialchars($con['title']) ?></div>
                                                </td>
                                                <td class="fw-semibold text-primary"><?= getSectionName($con['section_id']) ?></td>
                                                <td><span class="badge bg-secondary font-monospace"><?= intval($con['priority']) ?></span></td>
                                                <td><span class="badge <?= $con['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?= ucfirst($con['status']) ?></span></td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>admin/services/content-new.php?eid=<?= $con['id'] ?><?= $section_id ? '&section_id=' . $section_id : '' ?>"
                                                        class="btn btn-sm btn-info">
                                                        <i class="ti ti-edit"></i> Edit
                                                    </a>
                                                    <a href="<?= BASE_URL ?>admin/classes/process_content.php?action=delete&id=<?= $con['id'] ?>"
                                                        class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center p-4 text-muted bg-light">
                                                No content elements added for this section yet.
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