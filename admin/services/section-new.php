<?php
require "../../setting.php";

$obj = new Database('service_section');
$isEdit = false;

// Priority logic for tracking redirection context
$passed_service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : null;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $sectionData = $obj->find($eid);
    // If editing, use existing mapped service_id if url context is missing
    if (!$passed_service_id && $sectionData) {
        $passed_service_id = $sectionData['service_id'];
    }
}

$servicesObj = new Database('services');
$allServices = $servicesObj->fetchAll('id, name');
$service = $servicesObj->find($passed_service_id);
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
        data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">
            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Service Section' : 'Add New Service Section' ?> : <b class="text-primary"><?= isset($service['name']) ? htmlspecialchars($service['name']) : 'Unassigned' ?></b></h5>
                            <a href="<?= BASE_URL ?>admin/services/section-list.php<?= $passed_service_id ? '?service_id=' . $passed_service_id : '' ?>" class="btn btn-primary">
                                Back to Sections
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_section.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $isEdit ? $sectionData['id'] : '' ?>">
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="old_image" value="<?= htmlspecialchars($sectionData['image'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Assign to Service <span class="text-danger">*</span></label>
                                    <select name="service_id" class="form-select" required>
                                        <option value="">-- Select Corporate Service --</option>
                                        <?php if (!empty($allServices)): ?>
                                            <?php foreach ($allServices as $svc): ?>
                                                <option value="<?= $svc['id'] ?>" <?= ($passed_service_id == $svc['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($svc['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Section Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="<?= $isEdit ? htmlspecialchars($sectionData['title']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Priority Order Level</label>
                                    <input type="number" name="priority" class="form-control" min="0" value="<?= $isEdit ? intval($sectionData['priority']) : '0' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">System Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" <?= ($isEdit && $sectionData['status'] === 'active') ? 'selected' : '' ?>>active</option>
                                        <option value="inactive" <?= ($isEdit && $sectionData['status'] === 'inactive') ? 'selected' : '' ?>>inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Section Graphic/Image <span class="text-muted small">(Optional)</span></label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <?php if ($isEdit && !empty($sectionData['image']) && file_exists(BASE_PATH . "uploads/sections/" . $sectionData['image'])): ?>
                                    <div class="col-md-12 mb-3">
                                        <div class="d-inline-block position-relative border p-2 rounded bg-light">
                                            <img src="<?= BASE_URL . 'uploads/sections/' . $sectionData['image'] ?>" style="max-width:220px; height:auto;" class="img-thumbnail mb-2 d-block">
                                            <div class="form-check form-switch card-text">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImageCheck" value="1">
                                                <label class="form-check-label text-danger fw-semibold" for="removeImageCheck">
                                                    ❌ Remove current image from server
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Section Description Context</label>
                                    <textarea name="description" class="form-control" rows="5"><?= $isEdit ? htmlspecialchars($sectionData['description']) : '' ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Section</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>