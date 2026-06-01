<?php
// Auto-load centralized initialization layers
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_client_work');

// ====================================================================
// TASK 1: HANDLING REGISTERED DELETION MAPS (GET)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $row_id    = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'error' => 'Unauthorized operation access!']);
    }

    if ($row_id > 0) {
        $result = $obj->delete(['id' => $row_id]);
        if ($result) {
            redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'msg' => 'deleted']);
        }
    }
    redirect("admin/case-studies/client-list.php");
}

// ====================================================================
// TASK 2: HANDLING STRUCTURAL DATA MANIFESTATION (POST INSERT/UPDATE)
// ====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($current_user_role === 'Moderator') {
        redirect("admin/case-studies/client-list.php");
    }

    $id          = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $client_id   = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $work_ids    = isset($_POST['work_ids']) ? $_POST['work_ids'] : [];
    $priority    = trim($_POST['priority']);
    $status      = isset($_POST['status']) ? trim($_POST['status']) : 'active';

    // Integrity checks
    if ($client_id === 0 || $category_id === 0 || empty($work_ids)) {
        redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'error' => 'All mandatory fields including multiple work entities must be defined!']);
    }

    // CRITICAL SECURITY CONSTRAINT: Strict enforcement of category uniqueness per client profile mapping
    if ($id === 0) {
        // Checking during INSERT operation lifecycle
        $duplicateCheck = $obj->where(['client_id' => $client_id, 'category_id' => $category_id]);
        if (!empty($duplicateCheck)) {
            redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'error' => 'This configuration category has already been assigned to the client profile! Please modify the existing mapping instead.']);
        }
    } else {
        // Checking during UPDATE operation lifecycle to make sure it doesn't collide with other existing parameters
        $duplicateCheck = $obj->where(['client_id' => $client_id, 'category_id' => $category_id]);
        if (!empty($duplicateCheck)) {
            foreach ($duplicateCheck as $checkRow) {
                if (intval($checkRow['id']) !== $id) {
                    redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'error' => 'Collision encountered! Another allocation block is already utilizing this targeted scope category mapping.']);
                }
            }
        }
    }

    // Standardize representation to format raw JSON strings securely
    $jsonWorkIds = json_encode(array_map('intval', $work_ids));

    $dataPayload = [
        'client_id'   => $client_id,
        'category_id' => $category_id,
        'work_ids'    => $jsonWorkIds,
        'priority'    => !empty($priority) ? $priority : 'Medium',
        'status'      => $status
    ];

    if ($id > 0) {
        $result = $obj->update($dataPayload, ['id' => $id]);
        $success_msg = 'updated';
    } else {
        $result = $obj->insert($dataPayload);
        $success_msg = 'success';
    }

    if ($result !== false) {
        redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'msg' => $success_msg]);
    } else {
        redirect("admin/case-studies/client-work-manage.php", ['client_id' => $client_id, 'error' => 'Operation failed inside storage.']);
    }
} else {
    redirect("admin/case-studies/client-list.php");
}
