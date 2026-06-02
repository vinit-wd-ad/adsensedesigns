<?php
require "../../setting.php";

// Database initialization for 'service_wrapper'
$obj = new Database('service_wrapper');
$isEdit = false;

// Priority logic for tracking redirection context
$passed_service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : null;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $wrapperData = $obj->find($eid);
    // If editing, use existing mapped service_id if url context is missing
    if (!$passed_service_id && $wrapperData) {
        $passed_service_id = $wrapperData['service_id'];
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
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Service Wrapper' : 'Add New Service Wrapper' ?> : <b class="text-primary"><?= isset($service['name']) ? htmlspecialchars($service['name']) : 'Unassigned' ?></b></h5>
                            <a href="<?= BASE_URL ?>admin/services/wrapper-list.php<?= $passed_service_id ? '?service_id=' . $passed_service_id : '' ?>" class="btn btn-primary">
                                Back to Wrappers
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_wrapper.php" method="POST">
                            <input type="hidden" name="id" value="<?= $isEdit ? $wrapperData['id'] : '' ?>">

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
                                    <label class="form-label">Wrapper Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="<?= $isEdit ? htmlspecialchars($wrapperData['name']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Priority Order Level</label>
                                    <input type="number" name="priority" class="form-control" min="0" value="<?= $isEdit ? intval($wrapperData['priority']) : '0' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">System Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" <?= ($isEdit && $wrapperData['status'] === 'active') ? 'selected' : '' ?>>active</option>
                                        <option value="inactive" <?= ($isEdit && $wrapperData['status'] === 'inactive') ? 'selected' : '' ?>>inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Section Layout Design <span class="text-danger">*</span></label>
                                    <select name="section_design_type" class="form-select" required>
                                        <option value="default_heading" <?= ($isEdit && $wrapperData['section_design_type'] === 'default_heading') ? 'selected' : '' ?>>Heading & Description Only (Default)</option>
                                        <option value="card_2col" <?= ($isEdit && $wrapperData['section_design_type'] === 'card_2col') ? 'selected' : '' ?>>Card Grid (1X2 Layout)</option>
                                        <option value="card_3col" <?= ($isEdit && $wrapperData['section_design_type'] === 'card_3col') ? 'selected' : '' ?>>Card Grid (1X3 Layout)</option>
                                        <option value="card_4col" <?= ($isEdit && $wrapperData['section_design_type'] === 'card_4col') ? 'selected' : '' ?>>Card Grid (1X4 Layout)</option>
                                        <option value="slider_3col" <?= ($isEdit && $wrapperData['section_design_type'] === 'slider_3col') ? 'selected' : '' ?>>Card Slider (1X3 Layout)</option>
                                        <option value="slider_4col" <?= ($isEdit && $wrapperData['section_design_type'] === 'slider_4col') ? 'selected' : '' ?>>Card Slider (1X4 Layout)</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Wrapper Description Context</label>
                                    <textarea name="description" class="form-control" rows="5"><?= $isEdit ? htmlspecialchars($wrapperData['description']) : '' ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Wrapper</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>