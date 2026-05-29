<?php

if (isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    $fileName = time() . '_' . $file['name'];
    $uploadPath = '../../uploads/blogs/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo json_encode([
            'uploaded' => 1,
            'fileName' => $fileName,
            'url'      => BASE_URL . 'uploads/blogs/' . $fileName
        ]);
    } else {
        echo json_encode(['uploaded' => 0, 'error' => ['message' => 'Upload failed']]);
    }
}
