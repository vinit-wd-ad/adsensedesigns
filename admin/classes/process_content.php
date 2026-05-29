<?php
require "../../setting.php";

$objContent = new Database('blogs_content');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    if ($blog_id <= 0) {
        redirect('admin/blogs/blog-list.php', ['error' => 'Invalid Request: Blog ID missing hai.']);
        exit;
    }

    try {
        $checkExisting = $objContent->where(['blog_id' => $blog_id]);

        $dbData = [
            'content' => $content
        ];

        if (!empty($checkExisting)) {
            $objContent->update($dbData, ['blog_id' => $blog_id]);
            $msg = "Blog content successfully update ho gaya hai.";
        } else {
            $dbData['blog_id'] = $blog_id;
            $objContent->insert($dbData);
            $msg = "Blog content successfully save ho gaya hai.";
        }

        redirect('admin/blogs/blog-list.php', ["success" => $msg]);
        exit;
    } catch (Exception $e) {
        redirect('admin/blogs/blog-list.php', ['error' => 'Database Error: ' . $e->getMessage()]);
        exit;
    }
} else {
    redirect('admin/blogs/blog-list.php', ['error' => 'Direct access allowed nahi hai.']);
    exit;
}
