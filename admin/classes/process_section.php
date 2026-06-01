<?php
// ── INCOMING GLOBAL CONFIGURATION SETTINGS ──
require_once '../../setting.php'; 

$obj = new Database('service_section');

// ── HANDLE DELETE ACTION (GET REQUEST) ──
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);
        
        $section = $obj->find($id);
        if ($section) {
            // Unlink Image if exists
            if (!empty($section['image']) && file_exists(BASE_PATH . "uploads/sections/" . $section['image'])) {
                @unlink(BASE_PATH . "uploads/sections/" . $section['image']);
            }
            
            $obj->delete(['id' => $id]);
            $msg = "Section permanently removed";
            redirect('admin/services/section-list.php', ["success" => $msg]);
        }
    } catch (Exception $e) {
        redirect('admin/services/section-list.php', ["error" => "Error: " . $e->getMessage()]);
    }
}

// ── HANDLE INSERT & UPDATE ACTIONS (POST REQUEST) ──
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id           = isset($_POST['id']) ? trim($_POST['id']) : '';
        $title        = trim($_POST['title']); 
        $description  = trim($_POST['description']);
        $status       = !empty($_POST['status']) ? trim($_POST['status']) : 'active';
        $priority     = !empty($_POST['priority']) ? intval($_POST['priority']) : 0;
        $service_id   = !empty($_POST['service_id']) ? intval($_POST['service_id']) : null;
        
        // Track whether user wants to purge the existing uploaded image file
        $remove_image = isset($_POST['remove_image']) && $_POST['remove_image'] == '1';

        // 1. Validation
        if (empty($title) || empty($service_id)) {
            $redirectUrl = 'admin/services/section-new.php';
            $params = empty($id) ? ["service_id" => $service_id, "error" => "Title and Service Selection are required"] : ["service_id" => $service_id, "eid" => $id, "error" => "Title and Service Selection are required"];
            redirect($redirectUrl, $params);
        }

        // 2. Handle Image Actions & Uploads Configuration Strategy
        $targetDir = BASE_PATH . "uploads/sections/";
        $finalImageName = !empty($_POST['old_image']) ? $_POST['old_image'] : null;

        // Process image complete removal workflow if specified
        if ($remove_image && !empty($id)) {
            if (!empty($finalImageName) && file_exists($targetDir . $finalImageName)) {
                @unlink($targetDir . $finalImageName);
            }
            $finalImageName = null; // Purge reference variable out for SQL storage update mapping
        }

        // Process new fresh image submission payload override if file stream contains bytes
        if (!empty($_FILES['image']['name'])) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES["image"]["name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName)) {
                
                // Automatically sweep old redundant physical storage profile from disk if exists
                if (!empty($id) && !empty($_POST['old_image']) && file_exists($targetDir . $_POST['old_image'])) {
                    @unlink($targetDir . $_POST['old_image']);
                }
                
                $finalImageName = $fileName; 
            }
        }

        // 3. Data Array Mapping
        $data = [
            'service_id'  => $service_id,
            'title'       => $title,
            'image'       => $finalImageName, // Stores null value if removed completely
            'description' => $description,
            'status'      => $status,
            'priority'    => $priority
        ];

        // 4. Insert or Update Database Execution Workflow Logic
        if (empty($id)) {
            $obj->insert($data);
            $msg = "Section added successfully";
        } else {
            $obj->update($data, ['id' => $id]);
            $msg = "Section updated successfully";
        }

        redirect('admin/services/section-list.php?service_id=' . $service_id, ["success" => $msg]);

    } catch (Exception $e) {
        $redirectUrl = 'admin/services/section-new.php';
        $params = empty($_POST['id']) ? ["error" => $e->getMessage()] : ["eid" => $_POST['id'], "error" => $e->getMessage()];
        redirect($redirectUrl, $params);
    }
}