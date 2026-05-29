<?php
require "../../setting.php";

$objBlog = new Database('blogs');
$objSeo  = new Database('blogs_seo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id          = isset($_POST['id']) ? $_POST['id'] : '';
    $userId      = $_SESSION['admin_id'];

    $categoryId  = trim($_POST['category_id']);
    $title       = trim($_POST['title']);
    $slug        = trim($_POST['slug']);
    $status      = trim($_POST['status']);
    $short_desc  = trim($_POST['short_description']);

    // Validation
    $errors = [];

    if (empty($categoryId)) {
        $errors[] = "Category is required";
    }

    if (empty($title)) {
        $errors[] = "Title is required";
    }

    if (empty($slug)) {
        $errors[] = "Slug is required";
    }

    // If validation fails
    if (!empty($errors)) {

        redirect('admin/blogs/blog-new.php', ['error' => $errors]);
        exit;
    }

    $imageName = "";

    if (!empty($_FILES['image']['name'])) {

        $targetDir = BASE_PATH . "uploads/blogs/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageName = time() . '_' . basename($_FILES["image"]["name"]);

        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $targetDir . $imageName
        );
    }

    $blogData = [
        'user_id'            => $userId,
        'category_id'        => $categoryId,
        'title'              => $title,
        'slug'               => $slug,
        'short_description'  => $short_desc,
        'status'             => $status
    ];

    // Only update image if uploaded
    if (!empty($imageName)) {
        $blogData['image'] = $imageName;
    }

    if (empty($id)) {

        // INSERT
        $blogId = $objBlog->insert($blogData);

        // Insert empty SEO row
        $objSeo->insert([
            'blog_id' => $blogId,
            'seo_meta' => json_encode([]),
            'og_seo' => json_encode([])
        ]);

        $msg = "Blog created successfully";
    } else {

        // UPDATE
        $objBlog->update($blogData, ['id' => $id]);

        $blogId = $id;

        $msg = "Blog updated successfully";
    }

    redirect('admin/blogs/blog-list.php', ["success" => $msg]);
}
