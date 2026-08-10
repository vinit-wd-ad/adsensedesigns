<?php
// Auto-load centralized initialization layers
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_social');

// ====================================================================
// TASK 1: HANDLING REGISTERED DELETION MAPS (GET)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $row_id    = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/client-links-manage.php", ['client_id' => $client_id, 'error' => 'Unauthorized operation access!']);
    }

    if ($row_id > 0) {
        $result = $obj->delete(['id' => $row_id]);
        if ($result) {
            redirect("admin/case-studies/client-links-manage.php", ['client_id' => $client_id, 'msg' => 'deleted']);
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

    $id         = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $client_id  = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;
    $name       = isset($_POST['name']) ? trim($_POST['name']) : '';
    $icon       = isset($_POST['icon']) ? trim($_POST['icon']) : '';
    $link       = isset($_POST['link']) ? trim($_POST['link']) : '';
    $status     = isset($_POST['status']) ? trim($_POST['status']) : '1';
    $sort_order = isset($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;

    // Integrity checks
    if ($client_id === 0 || empty($name) || empty($link) || empty($icon)) {
        redirect("admin/case-studies/client-links-manage.php", ['client_id' => $client_id, 'error' => 'All mandatory fields including Name, Icon, and Link URL must be defined!']);
    }

    $dataPayload = [
        'client_id'  => $client_id,
        'name'       => $name,
        'icon'       => $icon,
        'link'       => $link,
        'status'     => $status,
        'sort_order' => $sort_order
    ];

    if ($id > 0) {
        $result = $obj->update($dataPayload, ['id' => $id]);
        $success_msg = 'updated';
    } else {
        $result = $obj->insert($dataPayload);
        $success_msg = 'success';
    }

    if ($result !== false) {
        redirect("admin/case-studies/client-links-manage.php", ['client_id' => $client_id, 'msg' => $success_msg]);
    } else {
        redirect("admin/case-studies/client-links-manage.php", ['client_id' => $client_id, 'error' => 'Operation failed inside storage.']);
    }
} else {
    redirect("admin/case-studies/client-list.php");
}