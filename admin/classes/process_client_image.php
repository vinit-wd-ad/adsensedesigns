<?php
// Include centralized configuration dependencies
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_client_image');

// ====================================================================
// TASK 1: HANDLING IMAGE FILE AND TRACKING ROW DELETION (GET)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id        = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'error' => 'Unauthorized operation access! Only Super Admins can drop assets.']);
    }

    if ($id > 0) {
        // Fetch target row metadata to clear the local filesystem storage track
        $imageRow = $obj->find($id);
        if ($imageRow) {
            $physicalPath = BASE_PATH . 'uploads/clients/portfolio/' . $imageRow['image_url'];
            if (!empty($imageRow['image_url']) && file_exists($physicalPath)) {
                @unlink($physicalPath); // Remove file from server disk safely
            }

            // Delete record from database
            $result = $obj->delete(['id' => $id]);
            if ($result) {
                redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'msg' => 'deleted']);
            }
        }
    }
    redirect("admin/case-studies/client-list.php");
}

// ====================================================================
// TASK 2: HANDLING COMPREHENSIVE MULTIPART IMAGE UPLOADS (POST)
// ====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($current_user_role === 'Moderator') {
        redirect("admin/case-studies/client-list.php");
    }

    $client_id   = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    // Validate request parameter structures
    if ($client_id === 0 || $category_id === 0 || !isset($_FILES['portfolio_image']) || $_FILES['portfolio_image']['error'] !== 0) {
        redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'error' => 'Please select a valid image category and asset file context.']);
    }

    // Asset extension verification checks
    $fileInfo  = $_FILES['portfolio_image'];
    $fileName  = $fileInfo['name'];
    $fileTmp   = $fileInfo['tmp_name'];
    $fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $validExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($fileExt, $validExts)) {
        redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'error' => 'Invalid file extension! Supported formats: JPG, JPEG, PNG, WEBP, GIF.']);
    }

    // Prepare absolute directory environment paths
    $uploadDir = BASE_PATH . 'uploads/clients/portfolio/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create directory safely if it doesn't exist
    }

    // Generate unique file name mapping to prevent collisions
    $sluggedName = "client_" . $client_id . "_cat_" . $category_id . "_" . time() . "_" . rand(1000, 9999) . "." . $fileExt;
    $targetPath  = $uploadDir . $sluggedName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        $dataPayload = [
            'client_id'   => $client_id,
            'category_id' => $category_id,
            'image_url'   => $sluggedName
        ];

        $result = $obj->insert($dataPayload);

        if ($result) {
            redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'msg' => 'success']);
        } else {
            // Rollback uploaded file if DB reference write fails
            if (file_exists($targetPath)) @unlink($targetPath);
            redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'error' => 'Failed to store image record reference inside storage engine.']);
        }
    } else {
        redirect("admin/case-studies/client-image-manage.php", ['client_id' => $client_id, 'error' => 'Disk upload operational failure. Verify file access permissions.']);
    }
} else {
    redirect("admin/case-studies/client-list.php");
}
