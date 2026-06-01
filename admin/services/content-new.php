<?php
require "../../setting.php";

$obj = new Database('service_section_content');
$isEdit = false;

// Priority logic for tracking redirection context (linked to section_id)
$passed_section_id = isset($_GET['section_id']) ? intval($_GET['section_id']) : null;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $contentData = $obj->find($eid);
    // If editing, use existing mapped section_id if url context is missing
    if (!$passed_section_id && $contentData) {
        $passed_section_id = $contentData['section_id'];
    }
}

$sectionsObj = new Database('service_section');
$allSections = $sectionsObj->fetchAll('id, title');
$section = $sectionsObj->find($passed_section_id);
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
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Section Content' : 'Add New Section Content' ?> : <b class="text-primary"><?= $section ? htmlspecialchars($section['title']) : 'General' ?></b></h5>
                            <a href="<?= BASE_URL ?>admin/services/content-list.php<?= $passed_section_id ? '?section_id=' . $passed_section_id : '' ?>" class="btn btn-primary">
                                Back to Contents
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_section_content.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $isEdit ? $contentData['id'] : '' ?>">
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="old_image" value="<?= htmlspecialchars($contentData['image'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Assign to Section <span class="text-danger">*</span></label>
                                    <select name="section_id" class="form-select" required>
                                        <option value="">-- Select Service Section --</option>
                                        <?php if (!empty($allSections)): ?>
                                            <?php foreach ($allSections as $sec): ?>
                                                <option value="<?= $sec['id'] ?>" <?= ($passed_section_id == $sec['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($sec['title']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Content Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="<?= $isEdit ? htmlspecialchars($contentData['title']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon Class (e.g., ti ti-star, fa fa-cog)</label>
                                    <input type="text" name="icon" class="form-control" value="<?= $isEdit ? htmlspecialchars($contentData['icon'] ?? '') : '' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Priority Order Level</label>
                                    <input type="number" name="priority" class="form-control" min="0" value="<?= $isEdit ? intval($contentData['priority']) : '0' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">System Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" <?= ($isEdit && $contentData['status'] === 'active') ? 'selected' : '' ?>>active</option>
                                        <option value="inactive" <?= ($isEdit && $contentData['status'] === 'inactive') ? 'selected' : '' ?>>inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Content Graphic/Image <span class="text-muted small">(Optional)</span></label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <?php if ($isEdit && !empty($contentData['image']) && file_exists(BASE_PATH . "uploads/contents/" . $contentData['image'])): ?>
                                    <div class="col-md-12 mb-3">
                                        <div class="d-inline-block position-relative border p-2 rounded bg-light">
                                            <img src="<?= BASE_URL . 'uploads/contents/' . $contentData['image'] ?>" style="max-width:180px; height:auto;" class="img-thumbnail mb-2 d-block">
                                            <div class="form-check form-switch card-text">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeContentImgCheck" value="1">
                                                <label class="form-check-label text-danger fw-semibold" for="removeContentImgCheck">
                                                    ❌ Remove current image from server
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Content Description Context</label>
                                    <textarea name="description" class="form-control" rows="5"><?= $isEdit ? htmlspecialchars($contentData['description']) : '' ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Content</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>