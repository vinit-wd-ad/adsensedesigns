<?php
// Configuration, DB dependencies, and routing handlers auto-loaded
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_work_category');

// ====================================================================
// TASK 1: HANDLING WORK CATEGORY AND PHYSICAL FILE DELETION (GET)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $delete_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Strict Security Guard Layer: Only Super Admin holds drop rights
    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/category-work-list.php", ['error' => 'Unauthorized! Only Super Admins can delete categories.']);
    }

    if ($delete_id > 0) {
        $targetCategory = $obj->find($delete_id);
        if ($targetCategory) {
            // Remove physical upload file asset from directory mapping
            if (!empty($targetCategory['image'])) {
                $physicalImagePath = BASE_PATH . 'uploads/categories/' . $targetCategory['image'];
                if (file_exists($physicalImagePath)) {
                    @unlink($physicalImagePath);
                }
            }

            // Perform structural database drop execution
            $result = $obj->delete(['id' => $delete_id]);
            if ($result) {
                redirect("admin/case-studies/category-work-list.php", ['msg' => 'deleted']);
            }
        }
    }
    redirect("admin/case-studies/category-work-list.php", ['error' => 'Target database record validation failed.']);
}

// ====================================================================
// TASK 2: HANDLING WORK CATEGORY MUTATION (POST INSERT/UPDATE)
// ====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Filter, sanitize, and extract input variables
    $id    = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name  = trim($_POST['name']);
    $slug  = trim($_POST['slug']);
    $icon  = trim($_POST['icon']); // Capture raw icon code or font-awesome class names

    // Server-side fallback protection for formatting slugs securely
    $slug  = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', str_replace(' ', '-', $slug)));

    // Integrity Validation Check
    if (empty($name) || empty($slug)) {
        $params = ['error' => 'Category Name and Slug are required!'];
        if ($id > 0) $params['eid'] = $id;
        redirect("admin/case-studies/category-work-new.php", $params);
    }

    // CRITICAL SECURITY GUARD: Stop malicious or unauthorized role injections
    if ($id === 0) {
        if ($current_user_role === 'Moderator') {
            redirect("admin/case-studies/category-work-list.php");
        }
    } else {
        $existingCategory = $obj->find($id);
        if (!$existingCategory) {
            redirect("admin/case-studies/category-work-list.php");
        }
    }

    // ====================================================================
    // 🔴 REFINED UNIQUE CONSTRAINT CHECK (PREVENTS DATABASE CRASH)
    // ====================================================================
    if ($id === 0) {
        // Insertion workflow check logic
        $checkDuplicateName = $obj->where(['name' => $name]);
        if (!empty($checkDuplicateName)) {
            redirect("admin/case-studies/category-work-new.php", ['error' => 'This Category Name already exists! Please write a unique name.']);
        }

        $checkDuplicateSlug = $obj->where(['slug' => $slug]);
        if (!empty($checkDuplicateSlug)) {
            redirect("admin/case-studies/category-work-new.php", ['error' => 'This Slug format already exists! Please modify the value.']);
        }
    } else {
        // Updation workflow check logic (Excluding current processing row ID context)
        $checkDuplicateName = $obj->where(['name' => $name]);
        if (!empty($checkDuplicateName)) {
            foreach ($checkDuplicateName as $row) {
                if (intval($row['id']) !== $id) {
                    redirect("admin/case-studies/category-work-new.php", ['eid' => $id, 'error' => 'Another category profile is already utilizing this identical name.']);
                }
            }
        }

        $checkDuplicateSlug = $obj->where(['slug' => $slug]);
        if (!empty($checkDuplicateSlug)) {
            foreach ($checkDuplicateSlug as $row) {
                if (intval($row['id']) !== $id) {
                    redirect("admin/case-studies/category-work-new.php", ['eid' => $id, 'error' => 'Collision error! Another configuration profile has registered this URL slug context.']);
                }
            }
        }
    }
    // ====================================================================

    // Dynamic Image Asset File Processing Lifecycle
    $image = ($id > 0) ? $existingCategory['image'] : '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['image']['tmp_name'];
        $fileName      = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {

            // Standardize structured unique filesystem identifier
            $newFileName = time() . '_' . preg_replace("/[^a-zA-Z0-9]/", "", $slug) . '.' . $fileExtension;
            $uploadFileDir = BASE_PATH . 'uploads/categories/';

            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Purge older image references during edit operations to prevent orphan files
                if ($id > 0 && !empty($existingCategory['image'])) {
                    $oldFilePath = $uploadFileDir . $existingCategory['image'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $image = $newFileName;
            }
        } else {
            $params = ['error' => 'Invalid file format! Only JPG, PNG, WEBP, and SVG are accepted.'];
            if ($id > 0) $params['eid'] = $id;
            redirect("admin/case-studies/category-work-new.php", $params);
        }
    }

    // Database Entry Assembly Array containing distinct context for icon and image
    $dataArray = [
        'name'  => $name,
        'slug'  => $slug,
        'icon'  => $icon,
        'image' => $image
    ];

    if ($id > 0) {
        $result = $obj->update($dataArray, ['id' => $id]);
    } else {
        $result = $obj->insert($dataArray);
    }

    // Perform strict structural response checking for error execution routines
    if ($result !== false) {
        redirect("admin/case-studies/category-work-list.php", ['msg' => 'success']);
    } else {
        redirect("admin/case-studies/category-work-list.php", ['msg' => 'failed']);
    }
} else {
    redirect("admin/case-studies/category-work-list.php");
}
