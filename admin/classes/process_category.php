<?php
require "../../setting.php";

$obj = new Database('blogs_categories');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id    = isset($_POST['id']) ? $_POST['id'] : '';
    $name  = trim($_POST['name']); 
    $slug  = strtolower(trim($_POST['slug']));

    // 1. Validation
    if (empty($name) || empty($slug)) {
        redirect('admin/blogs/category-new  .php', ["error" => "Name and Slug are required"]);
    }

    $imageData = null;

    // 2. Handle Image Upload
    $finalImageName = $_POST['old_image'] ?? null; 

    if (!empty($_FILES['image']['name'])) {
        $targetDir = BASE_PATH . "uploads/categories/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . '_' . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName)) {
            $finalImageName = $fileName; 
        }
    }

    $data = [
        'name'  => $name,
        'slug'  => $slug,
        'image' => $finalImageName
    ];

    // 4. Insert or Update
    if (empty($id)) {
        $obj->insert($data);
        $msg = "Category added successfully";
    } else {
        $obj->update($data, ['id' => $id]);
        $msg = "Category updated successfully";
    }

    redirect('admin/blogs/category-list.php', ["success" => $msg]);
}
