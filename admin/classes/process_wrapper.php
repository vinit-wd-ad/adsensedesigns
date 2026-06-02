<?php
// ── INCOMING GLOBAL CONFIGURATION SETTINGS ──
require_once '../../setting.php';

$obj = new Database('service_wrapper');

// ── HANDLE DELETE ACTION (GET REQUEST) ──
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);

        $wrapper = $obj->find($id);
        if ($wrapper) {
            $obj->delete(['id' => $id]);
            $msg = "Wrapper permanently removed";
            redirect('admin/services/wrapper-list.php', ["success" => $msg]);
        }
    } catch (Exception $e) {
        redirect('admin/services/wrapper-list.php', ["error" => "Error: " . $e->getMessage()]);
    }
}

// ── HANDLE INSERT & UPDATE ACTIONS (POST REQUEST) ──
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id           = isset($_POST['id']) ? trim($_POST['id']) : '';
        $name         = trim($_POST['name']);
        $description  = trim($_POST['description']);
        $status       = !empty($_POST['status']) ? trim($_POST['status']) : 'active';
        $priority     = !empty($_POST['priority']) ? intval($_POST['priority']) : 0;
        $service_id   = !empty($_POST['service_id']) ? intval($_POST['service_id']) : null;
        $design_type = $_POST['section_design_type'];

        // 1. Validation (name aur service_id dono required hain)
        if (empty($name) || empty($service_id)) {
            $redirectUrl = 'admin/services/wrapper-new.php';
            $params = empty($id) ? ["service_id" => $service_id, "error" => "Name and Service Selection are required"] : ["service_id" => $service_id, "eid" => $id, "error" => "Name and Service Selection are required"];
            redirect($redirectUrl, $params);
        }

        // 2. Data Array Mapping (service_wrapper table ke columns ke mutabik)
        $data = [
            'service_id'  => $service_id,
            'name'        => $name,
            'description' => $description,
            'status'      => $status,
            'section_design_type' => $design_type,
            'priority'    => $priority
        ];

        // 3. Insert or Update Database Execution Workflow Logic
        if (empty($id)) {
            $obj->insert($data);
            $msg = "Wrapper added successfully";
        } else {
            $obj->update($data, ['id' => $id]);
            $msg = "Wrapper updated successfully";
        }

        redirect('admin/services/wrapper-list.php?service_id=' . $service_id, ["success" => $msg]);
    } catch (Exception $e) {
        $redirectUrl = 'admin/services/wrapper-new.php';
        $params = empty($_POST['id']) ? ["error" => $e->getMessage()] : ["eid" => $_POST['id'], "error" => $e->getMessage()];
        redirect($redirectUrl, $params);
    }
}
