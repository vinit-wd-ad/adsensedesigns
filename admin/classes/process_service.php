<?php
// ── INCOMING GLOBAL CONFIGURATION SETTINGS ──
require_once '../../setting.php';

$obj = new Database('services');

// ── HANDLE DELETE ACTION (GET REQUEST) ──
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);

        $service = $obj->find($id);
        if ($service) {
            if (!empty($service['image']) && file_exists(BASE_PATH . "uploads/services/" . $service['image'])) {
                @unlink(BASE_PATH . "uploads/services/" . $service['image']);
            }

            $obj->delete(['id' => $id]);
            $msg = "Service permanently removed";
            redirect('admin/services/service-list.php', ["success" => $msg]);
        }
    } catch (Exception $e) {
        redirect('admin/services/service-list.php', ["error" => "Error: " . $e->getMessage()]);
    }
}

// ── HANDLE INSERT & UPDATE ACTIONS (POST REQUEST) ──
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id                = isset($_POST['id']) ? $_POST['id'] : '';
        $name              = trim($_POST['name']);
        $icon              = trim($_POST['icon']);
        $short_description = trim($_POST['short_description']);
        $status            = !empty($_POST['status']) ? trim($_POST['status']) : 'active';
        $priority          = !empty($_POST['priority']) ? intval($_POST['priority']) : 0;

        $parent_id         = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

        // Auto-generate Slug if empty
        $slug = !empty($_POST['slug']) ? strtolower(trim($_POST['slug'])) : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        // 1. Validation
        if (empty($name)) {
            $redirectUrl = empty($id) ? 'admin/services/service-new.php' : 'admin/services/service-new.php';
            $params = empty($id) ? ["error" => "Service Name is required"] : ["eid" => $id, "error" => "Service Name is required"];
            redirect($redirectUrl, $params);
        }

        // 2. Handle Image Upload
        $finalImageName = $_POST['old_image'] ?? null;

        if (!empty($_FILES['image']['name'])) {
            $targetDir = BASE_PATH . "uploads/services/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName)) {

                if (!empty($id) && !empty($_POST['old_image']) && file_exists($targetDir . $_POST['old_image'])) {
                    @unlink($targetDir . $_POST['old_image']);
                }

                $finalImageName = $fileName;
            }
        }

        // 3. Data Array Mapping
        $data = [
            'name'              => $name,
            'parent_id'         => $parent_id,
            'slug'              => $slug,
            'image'             => $finalImageName,
            'icon'              => $icon,
            'short_description' => $short_description,
            'status'            => $status,
            'priority'          => $priority
        ];

        // 4. Insert or Update Logic
        if (empty($id)) {
            $obj->insert($data);
            $msg = "Service added successfully";
        } else {
            $obj->update($data, ['id' => $id]);
            $msg = "Service updated successfully";
        }

        redirect('admin/services/service-list.php', ["success" => $msg]);
    } catch (Exception $e) {
        $redirectUrl = empty($_POST['id']) ? 'admin/services/service-new.php' : 'admin/services/service-new.php';
        $params = empty($_POST['id']) ? ["error" => $e->getMessage()] : ["eid" => $_POST['id'], "error" => $e->getMessage()];
        redirect($redirectUrl, $params);
    }
}
