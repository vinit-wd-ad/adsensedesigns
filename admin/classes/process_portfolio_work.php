<?php
// Include centralized setup dependencies
require "../../setting.php";

// Global Authentication Guard
if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
    redirect("admin/login.php");
}

$current_user_role = $_SESSION['admin_role'];
$obj = new Database('portfolio_work');

// ====================================================================
// OPERATION 1: HANDLING WORK DELETION (GET REQUEST)
// ====================================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $work_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $category_id = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

    // Security check: Only Super Admin can perform a deletion operation
    if ($current_user_role !== 'Super Admin') {
        redirect("admin/case-studies/work-new.php", ['cid' => $category_id, 'error' => 'Unauthorized access! Only Super Admins can delete work items.']);
    }

    if ($work_id > 0 && $category_id > 0) {
        $result = $obj->delete(['id' => $work_id]);
        if ($result) {
            redirect("admin/case-studies/work-new.php", ['cid' => $category_id, 'msg' => 'deleted']);
        }
    }
    redirect("admin/case-studies/category-work-list.php");
}

// ====================================================================
// OPERATION 2: HANDLING WORK INSERTION (POST REQUEST)
// ====================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Security verification: Moderators are restricted from creating entries
    if ($current_user_role === 'Moderator') {
        redirect("admin/case-studies/category-work-list.php");
    }

    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $name        = trim($_POST['name']);

    // Integrity Validation Check
    if (empty($name) || $category_id === 0) {
        redirect("admin/case-studies/work-new.php", ['cid' => $category_id, 'error' => 'Work Name field cannot be empty!']);
    }

    // ====================================================================
    // 🔴 NEW ANTI-DUPLICATE CONSTRAINT: SPECIFIC TO CATEGORY
    // ====================================================================
    $checkDuplicate = $obj->where([
        'category_id' => $category_id,
        'name'        => $name
    ]);

    if (!empty($checkDuplicate)) {
        redirect("admin/case-studies/work-new.php", [
            'cid'   => $category_id,
            'error' => 'This Work item name is already registered under this specific category!'
        ]);
    }
    // ====================================================================

    // Prepare structured payload matching the database schema columns
    $dataArray = [
        'category_id' => $category_id,
        'name'        => $name,
        'status'      => 'active'
    ];

    $result = $obj->insert($dataArray);

    if ($result) {
        redirect("admin/case-studies/work-new.php", ['cid' => $category_id, 'msg' => 'success']);
    } else {
        redirect("admin/case-studies/work-new.php", ['cid' => $category_id, 'error' => 'Database operation failed.']);
    }
} else {
    redirect("admin/case-studies/category-work-list.php");
}
