<?php
// ── INCOMING GLOBAL CONFIGURATION SETTINGS ──
require_once '../../setting.php';

$obj = new Database('service_section_content');

// ── HANDLE DELETE ACTION (GET REQUEST) ──
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);

        $content = $obj->find($id);
        if ($content) {
            $section_id = $content['section_id'];
            // Unlink Image if exists
            if (!empty($content['image']) && file_exists(BASE_PATH . "uploads/contents/" . $content['image'])) {
                @unlink(BASE_PATH . "uploads/contents/" . $content['image']);
            }

            $obj->delete(['id' => $id]);
            $msg = "Content permanently removed";
            redirect('admin/services/content-list.php?section_id=' . $section_id, ["success" => $msg]);
        }
    } catch (Exception $e) {
        redirect('admin/services/content-list.php', ["error" => "Error: " . $e->getMessage()]);
    }
}

// ── HANDLE INSERT & UPDATE ACTIONS (POST REQUEST) ──
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id          = isset($_POST['id']) ? trim($_POST['id']) : '';
        $title       = trim($_POST['title']);
        $icon        = trim($_POST['icon']);
        $description = trim($_POST['description']);
        $status      = !empty($_POST['status']) ? trim($_POST['status']) : 'active';
        $priority    = !empty($_POST['priority']) ? intval($_POST['priority']) : 0;
        $section_id  = !empty($_POST['section_id']) ? intval($_POST['section_id']) : null;
        
        // Track whether user wants to clear out the existing file assignment
        $remove_image = isset($_POST['remove_image']) && $_POST['remove_image'] == '1';

        // 1. Validation
        if (empty($title) || empty($section_id)) {
            $redirectUrl = 'admin/services/content-new.php';
            $params = empty($id) ? ["section_id" => $section_id, "error" => "Title and Section Selection are required"] : ["section_id" => $section_id, "eid" => $id, "error" => "Title and Section Selection are required"];
            redirect($redirectUrl, $params);
        }

        // 2. Handle Image Operations Strategy
        $targetDir = BASE_PATH . "uploads/contents/";
        $finalImageName = !empty($_POST['old_image']) ? $_POST['old_image'] : null;

        // Process pure image file unlinking task if requested by administrator
        if ($remove_image && !empty($id)) {
            if (!empty($finalImageName) && file_exists($targetDir . $finalImageName)) {
                @unlink($targetDir . $finalImageName);
            }
            $finalImageName = null; // Unbind filename reference vector for DB storage clean out
        }

        // Process new incoming replacement file payload stream 
        if (!empty($_FILES['image']['name'])) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName)) {

                // Clear old redundant file from storage structure safely 
                if (!empty($id) && !empty($_POST['old_image']) && file_exists($targetDir . $_POST['old_image'])) {
                    @unlink($targetDir . $_POST['old_image']);
                }

                $finalImageName = $fileName;
            }
        }

        // 3. Data Array Mapping
        $data = [
            'section_id'  => $section_id,
            'title'       => $title,
            'icon'        => $icon,
            'image'       => $finalImageName, // Stores safe null if purged
            'description' => $description,
            'status'      => $status,
            'priority'    => $priority
        ];

        // 4. Insert or Update Logic
        if (empty($id)) {
            $obj->insert($data);
            $msg = "Content added successfully";
        } else {
            $obj->update($data, ['id' => $id]);
            $msg = "Content updated successfully";
        }

        redirect('admin/services/content-list.php?section_id=' . $section_id, ["success" => $msg]);
    } catch (Exception $e) {
        $redirectUrl = 'admin/services/content-new.php';
        $params = empty($_POST['id']) ? ["error" => $e->getMessage()] : ["eid" => $_POST['id'], "error" => $e->getMessage()];
        redirect($redirectUrl, $params);
    }
}