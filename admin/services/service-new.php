<?php
require "../../setting.php";

$obj = new Database('services');
$isEdit = false;

if (isset($_GET['eid'])) {
    $isEdit = true;
    $eid = $_GET['eid'];
    $serviceData = $obj->find($eid);
}

// Fetch all services where parent_id = 0 for dropdown tree mapping
$parentServices = $obj->where(['parent_id' => 0]);
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
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= htmlspecialchars($_GET['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-4"><?= $isEdit ? 'Edit Service' : 'Add New Service' ?></h5>
                            <a href="<?= BASE_URL ?>admin/services/service-list.php" class="btn btn-primary">
                                Services List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_service.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?= $isEdit ? $serviceData['id'] : '' ?>">
                            <?php if ($isEdit): ?>
                                <input type="hidden" name="old_image" value="<?= htmlspecialchars($serviceData['image'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Service Name <span class="text-danger">*</span></label>
                                    <input type="text" id="service_name" name="name" class="form-control" value="<?= $isEdit ? htmlspecialchars($serviceData['name']) : '' ?>" required placeholder="e.g. Web Development">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" id="service_slug" name="slug" class="form-control" value="<?= $isEdit ? htmlspecialchars($serviceData['slug']) : '' ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Parent Service Relation</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="">-- None (Treat as Main Primary Service) --</option>
                                        <?php if (!empty($parentServices)): ?>
                                            <?php foreach ($parentServices as $ps): ?>
                                                <?php if ($isEdit && $ps['id'] == $serviceData['id']) continue; ?>
                                                <option value="<?= $ps['id'] ?>" <?= ($isEdit && $serviceData['parent_id'] == $ps['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($ps['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vector Icon Class Name</label>
                                    <input type="text" name="icon" class="form-control" value="<?= $isEdit ? htmlspecialchars($serviceData['icon']) : '' ?>" placeholder="e.g. fa-solid fa-gears">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Priority Order Level</label>
                                    <input type="number" name="priority" class="form-control" min="0" value="<?= $isEdit ? intval($serviceData['priority']) : '0' ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">System Distribution Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" <?= ($isEdit && $serviceData['status'] === 'active') ? 'selected' : '' ?>>active</option>
                                        <option value="inactive" <?= ($isEdit && $serviceData['status'] === 'inactive') ? 'selected' : '' ?>>inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Featured Showcase Graphic/Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <?php if ($isEdit && !empty($serviceData['image']) && file_exists(BASE_PATH . "uploads/services/" . $serviceData['image'])): ?>
                                    <div class="col-md-12 mb-3">
                                        <small class="text-muted d-block mb-1">Current Image Asset File:</small>
                                        <img src="<?= BASE_URL . 'uploads/services/' . $serviceData['image'] ?>" style="max-width:260px; height:auto;" class="img-thumbnail">
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Insight Description Summary</label>
                                    <textarea name="short_description" class="form-control" rows="4" placeholder="Draft brief summary details profile..."><?= $isEdit ? htmlspecialchars($serviceData['short_description']) : '' ?></textarea>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Save Service</button>
                        </form>

                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">
                        Design and Developed by
                        <a href="https://adsensedesigns.com"
                            target="_blank"
                            class="pe-1 text-primary text-decoration-underline">
                            Adsensedesigns
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('service_name');
        const slugInput = document.getElementById('service_slug');
        const isEditMode = <?= $isEdit ? 'true' : 'false' ?>;

        nameInput.addEventListener('input', function() {
            if (isEditMode && slugInput.value.trim() !== "") {
                return;
            }

            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');

            slugInput.value = slug;
        });
    </script>

    <?php include BASE_PATH . "admin/includes/script.php" ?>

</body>

</html>