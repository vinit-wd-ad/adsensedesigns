<?php
// Configuration, DB dependencies, and routing handlers auto-loaded globally
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_client');

// ====================================================================
// TASK 1: HANDLING MASTER RECORD AND PHYSICAL FILE DELETION (GET)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $delete_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Authorization Barrier Check
    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/client-list.php", ['error' => 'Unauthorized! Only Super Admins can delete client profiles.']);
    }

    if ($delete_id > 0) {
        $targetClient = $obj->find($delete_id);
        if ($targetClient) {
            if (!empty($targetClient['logo_url'])) {
                $physicalLogoPath = BASE_PATH . 'uploads/clients/' . $targetClient['logo_url'];
                if (file_exists($physicalLogoPath)) {
                    @unlink($physicalLogoPath);
                }
            }

            $result = $obj->delete(['id' => $delete_id]);
            if ($result) {
                redirect("admin/case-studies/client-list.php", ['msg' => 'deleted']);
            }
        }
    }
    redirect("admin/case-studies/client-list.php", ['error' => 'Target database record verification routing failed.']);
}

// ====================================================================
// TASK 2: HANDLING REFINED MUTATION LIFECYCLES (POST INSERT/UPDATE)
// ====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Input sanitization filters matrix layout
    $id                = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $company_name      = trim($_POST['company_name']);
    $website_url       = trim($_POST['website_url']);
    $email             = trim($_POST['email']);
    $phone             = trim($_POST['phone']);
    $industry          = trim($_POST['industry']);
    $priority          = isset($_POST['priority']) ? intval($_POST['priority']) : 1;
    $status            = trim($_POST['status']);
    $short_description = trim($_POST['short_description']);

    // Standard baseline requirement structural integrity guard
    if (empty($company_name)) {
        $params = ['error' => 'Company Name is required!'];
        if ($id > 0) $params['eid'] = $id;
        redirect("admin/case-studies/client-new.php", $params);
    }

    // Role execution checks mapping parameters blocks
    if ($id === 0) {
        if ($current_user_role === 'Moderator') {
            redirect("admin/case-studies/client-list.php");
        }
    } else {
        $existingClient = $obj->find($id);
        if (!$existingClient) {
            redirect("admin/case-studies/client-list.php");
        }
        if ($current_user_role === 'Moderator') {
            $status = $existingClient['status'];
        }
    }

    // 🔴 REFINED NO-COLLISION UNIQUE STRUCTURAL CHECK (Anti-Duplicate Guard Engine)
    if ($id === 0) {
        $checkDuplicate = $obj->where(['company_name' => $company_name]);
        if (!empty($checkDuplicate)) {
            redirect("admin/case-studies/client-new.php", ['error' => 'This Company Profile name already exists inside current records database layout system!']);
        }
    } else {
        $checkDuplicate = $obj->where(['company_name' => $company_name]);
        if (!empty($checkDuplicate)) {
            foreach ($checkDuplicate as $row) {
                if (intval($row['id']) !== $id) {
                    redirect("admin/case-studies/client-new.php", ['eid' => $id, 'error' => 'Collision profile context detected! Another entity profile owns this business label name structure registry.']);
                }
            }
        }
    }

    // Binary Storage Processing Module Configuration Settings Maps
    $logo_url = ($id > 0) ? $existingClient['logo_url'] : '';

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['logo']['tmp_name'];
        $fileName      = $_FILES['logo']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {

            $newFileName = time() . '_' . preg_replace("/[^a-zA-Z0-9]/", "", $company_name) . '.' . $fileExtension;
            $uploadFileDir = BASE_PATH . 'uploads/clients/';

            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            $dest_path = $uploadFileDir . $newFileName;

            // Original image dimensions
            list($oldWidth, $oldHeight) = getimagesize($fileTmpPath);

            // Fixed width
            $newWidth = 150;

            // Auto height according to ratio
            $newHeight = round(($oldHeight / $oldWidth) * $newWidth);

            // Create source image
            switch (strtolower($fileExtension)) {
                case 'jpg':
                case 'jpeg':
                    $source = imagecreatefromjpeg($fileTmpPath);
                    break;

                case 'png':
                    $source = imagecreatefrompng($fileTmpPath);
                    break;

                case 'webp':
                    $source = imagecreatefromwebp($fileTmpPath);
                    break;

                default:
                    $source = false;
            }

            if ($source) {

                $resized = imagecreatetruecolor($newWidth, $newHeight);

                // PNG transparency support
                if ($fileExtension == 'png') {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                }

                imagecopyresampled(
                    $resized,
                    $source,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $oldWidth,
                    $oldHeight
                );

                // Save resized image
                switch (strtolower($fileExtension)) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($resized, $dest_path, 90);
                        break;

                    case 'png':
                        imagepng($resized, $dest_path);
                        break;

                    case 'webp':
                        imagewebp($resized, $dest_path, 90);
                        break;
                }

                imagedestroy($source);
                imagedestroy($resized);

                // Delete old image on update
                if ($id > 0 && !empty($existingClient['logo_url'])) {
                    $oldFilePath = $uploadFileDir . $existingClient['logo_url'];
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $logo_url = $newFileName;
            }
        } else {
            $params = ['error' => 'Invalid file extension formatting profiles handled. Allowed values: JPG, PNG, WEBP, and SVG.'];
            if ($id > 0) $params['eid'] = $id;
            redirect("admin/case-studies/client-new.php", $params);
        }
    }

    // Compilation payloads array assembly definitions structures mappings execution maps
    $dataArray = [
        'company_name'      => $company_name,
        'website_url'       => $website_url,
        'email'             => $email,
        'phone'             => $phone,
        'industry'          => $industry,
        'short_description' => $short_description,
        'status'            => $status,
        'priority'          => $priority,
        'logo_url'          => $logo_url
    ];

    if ($id > 0) {
        $result = $obj->update($dataArray, ['id' => $id]);
    } else {
        $result = $obj->insert($dataArray);
    }

    if ($result !== false) {
        redirect("admin/case-studies/client-list.php", ['msg' => 'success']);
    } else {
        redirect("admin/case-studies/client-list.php", ['msg' => 'failed']);
    }
} else {
    redirect("admin/case-studies/client-list.php");
}
