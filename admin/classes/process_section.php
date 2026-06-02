<?php
// ── INCOMING GLOBAL CONFIGURATION SETTINGS ──
require_once '../../setting.php'; 

$obj = new Database('service_section');

// Target directory path for Section images
define('UPLOAD_DIR', '../../uploads/sections/');

// ── HANDLE DELETE ACTION (GET REQUEST) ──
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    try {
        $id = intval($_GET['id']);
        $wrapper_id = isset($_GET['wrapper_id']) ? intval($_GET['wrapper_id']) : '';
        
        $section = $obj->find($id);
        if ($section) {
            if (!empty($section['image']) && file_exists(UPLOAD_DIR . $section['image'])) {
                @unlink(UPLOAD_DIR . $section['image']);
            }

            $obj->delete(['id' => $id]);
            $msg = "Section permanently removed";
            
            $redirectUrl = 'admin/services/section-list.php' . (!empty($wrapper_id) ? '?wrapper_id=' . $wrapper_id : '');
            redirect($redirectUrl, ["success" => $msg]);
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
        $wrapper_id   = !empty($_POST['wrapper_id']) ? intval($_POST['wrapper_id']) : null;
        $old_image    = isset($_POST['old_image']) ? trim($_POST['old_image']) : '';
        $remove_image = isset($_POST['remove_image']) ? intval($_POST['remove_image']) : 0;
        $design_type = $_POST['content_design_type'];

        // 1. Core Fields Validation
        if (empty($title) || empty($wrapper_id)) {
            $redirectUrl = 'admin/services/section-new.php';
            $params = empty($id) ? ["wrapper_id" => $wrapper_id, "error" => "Title and Wrapper Selection are required"] : ["wrapper_id" => $wrapper_id, "eid" => $id, "error" => "Title and Wrapper Selection are required"];
            redirect($redirectUrl, $params);
        }

        // 2. Image Processing Logic (Optional and Removable)
        $image_name = $old_image; 

        // CASE A: User wants to remove the existing image explicitly
        if ($remove_image === 1) {
            if (!empty($old_image) && file_exists(UPLOAD_DIR . $old_image)) {
                @unlink(UPLOAD_DIR . $old_image);
            }
            $image_name = ''; // Reset image name to empty
        }

        // CASE B: User uploaded a new image file
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName    = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = 'sec_' . time() . '_' . md5(uniqid()) . '.' . $fileExtension;
                
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0755, true);
                }
                
                $dest_path = UPLOAD_DIR . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Agar nayi image safely upload ho gayi, toh purani image file delete karo
                    if (!empty($old_image) && $remove_image !== 1 && file_exists(UPLOAD_DIR . $old_image)) {
                        @unlink(UPLOAD_DIR . $old_image);
                    }
                    $image_name = $newFileName;
                } else {
                    throw new Exception("File system upload execution failed.");
                }
            } else {
                throw new Exception("Invalid file pattern. Only JPG, JPEG, PNG, GIF, WEBP are supported.");
            }
        }

        // 3. Data Array Mapping 
        // Agar image column database mein strict NULL demand karta hai toh '' ki jagah null bhej sakte hain
        // Lekin standard setups ke liye empty string sabse safe hai jab query build hoti hai.
        $final_image_value = !empty($image_name) ? $image_name : '';

        $data = [
            'wrapper_id'  => $wrapper_id,
            'title'       => $title,
            'image'       => $final_image_value,
            'description' => $description,
            'content_design_type' => $design_type,
            'status'      => $status,
            'priority'    => $priority
        ];

        // 4. Database Insertion or Mutation Workflow
        if (empty($id)) {
            $obj->insert($data);
            $msg = "Section added successfully";
        } else {
            $obj->update($data, ['id' => $id]);
            $msg = "Section updated successfully";
        }

        redirect('admin/services/section-list.php?wrapper_id=' . $wrapper_id, ["success" => $msg]);

    } catch (Exception $e) {
        $redirectUrl = 'admin/services/section-new.php';
        $params = empty($_POST['id']) ? ["wrapper_id" => $_POST['wrapper_id'], "error" => $e->getMessage()] : ["wrapper_id" => $_POST['wrapper_id'], "eid" => $_POST['id'], "error" => $e->getMessage()];
        redirect($redirectUrl, $params);
    }
}