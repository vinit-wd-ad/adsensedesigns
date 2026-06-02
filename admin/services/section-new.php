<?php
require "../../setting.php";

$obj = new Database('service_section');
$isEdit = false;

// Wrapper logic for tracking redirection context
$passed_wrapper_id = isset($_GET['wrapper_id']) ? intval($_GET['wrapper_id']) : null;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $sectionData = $obj->find($eid);
    // If editing, use existing mapped wrapper_id if url context is missing
    if (!$passed_wrapper_id && $sectionData) {
        $passed_wrapper_id = $sectionData['wrapper_id'];
    }
}

// Fetch all wrappers to show in dropdown
$wrapperObj = new Database('service_wrapper');
$allWrappers = $wrapperObj->fetchAll('id, name');
$currentWrapper = $wrapperObj->find($passed_wrapper_id);
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

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="ti ti-alert-circle fs-5 me-2"></i> <?= htmlspecialchars($_GET['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Service Section' : 'Add New Service Section' ?> : <b class="text-primary"><?= isset($currentWrapper['name']) ? htmlspecialchars($currentWrapper['name']) : 'Unassigned' ?></b></h5>
                            <a href="<?= BASE_URL ?>admin/services/section-list.php<?= $passed_wrapper_id ? '?wrapper_id=' . $passed_wrapper_id : '' ?>" class="btn btn-primary">
                                Back to Sections
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_section.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $isEdit ? $sectionData['id'] : '' ?>">
                            <input type="hidden" name="old_image" value="<?= ($isEdit && !is_null($sectionData['image'])) ? htmlspecialchars($sectionData['image']) : '' ?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Assign to Wrapper <span class="text-danger">*</span></label>
                                    <select name="wrapper_id" class="form-select" required>
                                        <option value="">-- Select Service Wrapper --</option>
                                        <?php if (!empty($allWrappers)): ?>
                                            <?php foreach ($allWrappers as $wrap): ?>
                                                <option value="<?= $wrap['id'] ?>" <?= ($passed_wrapper_id == $wrap['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($wrap['name']) ?>
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
                                    <label class="form-label">Section Image Feature</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">

                                    <?php if ($isEdit && !empty($sectionData['image'])): ?>
                                        <div class="mt-3 p-2 border rounded bg-light d-flex align-items-center gap-3">
                                            <div>
                                                <p class="mb-1 small text-muted">Current Image:</p>
                                                <img src="<?= BASE_URL ?>uploads/sections/<?= $sectionData['image'] ?>" alt="Preview" class="img-thumbnail" style="max-height: 70px;">
                                            </div>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input border-danger" type="checkbox" name="remove_image" value="1" id="removeImgCheck">
                                                <label class="form-check-label text-danger fw-semibold" Jaksa for="removeImgCheck">
                                                    Remove Current Image
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Inner Content Layout Design <span class="text-danger">*</span></label>
                                    <select name="content_design_type" class="form-select" required>
                                        <option value="default_card_3col" <?= ($isEdit && $sectionData['content_design_type'] === 'default_card_3col') ? 'selected' : '' ?>>Card Grid (1X3 Layout - Default)</option>
                                        <option value="card_2col" <?= ($isEdit && $sectionData['content_design_type'] === 'card_2col') ? 'selected' : '' ?>>Card Grid (1X2 Layout)</option>
                                        <option value="card_4col" <?= ($isEdit && $sectionData['content_design_type'] === 'card_4col') ? 'selected' : '' ?>>Card Grid (1X4 Layout)</option>
                                        <option value="slider_3col" <?= ($isEdit && $sectionData['content_design_type'] === 'slider_3col') ? 'selected' : '' ?>>Card Slider (1X3 Layout)</option>
                                        <option value="slider_4col" <?= ($isEdit && $sectionData['content_design_type'] === 'slider_4col') ? 'selected' : '' ?>>Card Slider (1X4 Layout)</option>
                                    </select>
                                </div>

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