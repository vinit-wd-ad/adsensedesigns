<?php
require "../../setting.php";

$objSeo = new Database('blogs_seo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $blog_id = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;

    if ($blog_id <= 0) {
        redirect('admin/blogs/blog-list.php', ['error' => 'Invalid Request']);
        exit;
    }

    $seoMetaFields = isset($_POST['seo_meta']) ? $_POST['seo_meta'] : [];
    $ogSeoFields   = isset($_POST['og_seo']) ? $_POST['og_seo'] : [];
    
    $canonical_url = trim($_POST['canonical_url']);
    $robots        = trim($_POST['robots']);
    
    $schema_json   = trim($_POST['schema_json']);
    if (empty($schema_json)) {
        $schema_json = '{}'; 
    }

    $dbData = [
        'seo_meta'      => json_encode($seoMetaFields, JSON_UNESCAPED_UNICODE),
        'og_seo'        => json_encode($ogSeoFields, JSON_UNESCAPED_UNICODE),
        'canonical_url' => $canonical_url,
        'robots'        => $robots,
        'schema_json'   => $schema_json
    ];

    $checkExisting = $objSeo->where(['blog_id' => $blog_id]);

    if (!empty($checkExisting)) {
        $objSeo->update($dbData, ['blog_id' => $blog_id]);
        $msg = "SEO details updated successfully";
    } else {
        $dbData['blog_id'] = $blog_id;
        $objSeo->insert($dbData);
        $msg = "SEO details added successfully";
    }

    redirect('admin/blogs/blog-list.php', ["success" => $msg]);
    exit;
}