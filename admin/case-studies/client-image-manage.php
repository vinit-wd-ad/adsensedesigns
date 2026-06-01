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

// Fetch main identity contexts
$dbClient = new Database('portfolio_client');
$client = $dbClient->find($client_id);
if (!$client) {
    redirect("admin/case-studies/client-list.php");
}

$dbCategory = new Database('portfolio_work_category');
$categories = $dbCategory->fetchAll();

// Fetch tracking images mapped explicitly to this current profile container
$dbClientImage = new Database('portfolio_client_image');
$assignedImages = $dbClientImage->where(['client_id' => $client_id]);
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
                                Manage Portfolio Images for: <span class="text-primary"><?= htmlspecialchars($client['company_name']) ?></span>
                            </h5>
                            <a href="<?= BASE_URL ?>admin/case-studies/client-list.php" class="btn btn-outline-primary">
                                Back to Clients
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_client_image.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <input type="hidden" name="client_id" value="<?= $client_id ?>" />

                            <div class="row align-items-end">
                                <div class="col-md-5 mb-3">
                                    <label class="form-label fw-bold">Target Scope Category</label>
                                    <select name="category_id" class="form-select" required <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        <option value="">-- Choose Category Context --</option>
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label class="form-label fw-bold">Select Upload Image Asset File</label>
                                    <input type="file" name="portfolio_image" class="form-control" accept="image/*" required <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <button type="submit" class="btn btn-warning text-white w-100 fw-semibold" <?= ($current_user_role === 'Moderator') ? 'disabled' : '' ?>>
                                        Upload Asset
                                    </button>
                                </div>
                            </div>

                            <div class="form-text mt-1 text-muted">Supported asset formats: <strong>PNG, JPG, JPEG, WEBP, GIF</strong>. Large media uploads auto-hash configuration keys automatically.</div>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger p-2 mt-3 mb-0 fs-3 fw-semibold"><?= htmlspecialchars($_GET['error']) ?></div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
                                <div class="alert alert-success p-2 mt-3 mb-0 fs-3">Image binary compiled and linked successfully!</div>
                            <?php endif; ?>
                            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                                <div class="alert alert-warning p-2 mt-3 mb-0 fs-3">Image allocation asset file deleted successfully from local storage environments.</div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-semibold mb-4">Uploaded Portfolio Showcase Catalog Gallery</h6>

                        <?php if (!empty($assignedImages)): ?>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                                <?php foreach ($assignedImages as $img):
                                    $catMeta = $dbCategory->find($img['category_id']);
                                ?>
                                    <div class="col">
                                        <div class="card h-100 border shadow-sm overflow-hidden position-relative group-hover">
                                            <div class="position-absolute top-0 start-0 m-2 z-index-2">
                                                <span class="badge bg-dark fs-1 shadow-sm"><?= $catMeta ? htmlspecialchars($catMeta['name']) : 'Unknown Category' ?></span>
                                            </div>

                                            <div class="d-flex justify-content-center align-items-center bg-light text-center" style="height: 180px; width: 100%;">
                                                <img src="<?= BASE_URL . 'uploads/clients/portfolio/' . $img['image_url'] ?>" class="card-img-top w-100 h-100" style="object-fit: contain;" alt="Portfolio Asset Media">
                                            </div>

                                            <div class="card-body p-2 d-flex flex-column justify-content-between bg-white border-top">
                                                <div class="fs-1 text-muted text-truncate mb-2" title="<?= htmlspecialchars($img['image_url']) ?>">
                                                    Ref: <?= htmlspecialchars($img['image_url']) ?>
                                                </div>

                                                <?php if ($current_user_role === 'Super Admin'): ?>
                                                    <a href="<?= BASE_URL ?>admin/classes/process_client_image.php?action=delete&id=<?= $img['id'] ?>&client_id=<?= $client_id ?>" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Are you sure you want to completely erase this media file and its tracking records data?');">
                                                        Delete Asset
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-secondary w-100" disabled title="Only Super Admins can erase storage elements">
                                                        Delete Asset
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center text-muted py-5 border rounded bg-light">
                                <i class="ti ti-photo-off fs-7 mb-2 d-block"></i>
                                <span>No dynamic portfolio assets or design media files are mapped to this client instance profile setup yet.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adsensedesigns.com" target="_blank" class="pe-1 text-primary text-decoration-underline">Adsensedesigns</a></p>
                </div>

            </div>
        </div>
    </div>

    <?php include BASE_PATH . "admin/includes/script.php" ?>
</body>

</html>