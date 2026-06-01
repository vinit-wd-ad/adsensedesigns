<?php
require "../../setting.php";

// Targeting the specific database table from your screenshot
$objSeo = new Database('service_seo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0;

    // Direct redirect backup if authentication map validation fails
    if ($service_id <= 0) {
        redirect('admin/services/service-list.php', ['error' => 'Invalid Request']);
        exit;
    }

    $seoMetaFields = isset($_POST['seo_meta']) ? $_POST['seo_meta'] : [];
    $ogSeoFields   = isset($_POST['og_seo']) ? $_POST['og_seo'] : [];
    
    $canonical_url = trim($_POST['canonical_url']);
    $robots        = trim($_POST['robots']);
    
    // Schema json handling to avoid breaking strict database attributes
    $schema_json   = trim($_POST['schema_json']);
    if (empty($schema_json)) {
        $schema_json = '{}'; 
    }

    // Exact array representation as your blog mapping mechanism
    $dbData = [
        'seo_meta'      => json_encode($seoMetaFields, JSON_UNESCAPED_UNICODE),
        'og_seo'        => json_encode($ogSeoFields, JSON_UNESCAPED_UNICODE),
        'canonical_url' => $canonical_url,
        'robots'        => $robots,
        'schema_json'   => $schema_json
    ];

    // Conditional tracking based directly on service_id column context
    $checkExisting = $objSeo->where(['service_id' => $service_id]);

    if (!empty($checkExisting)) {
        // Safe update pipeline sequence tracking matching target mapping condition
        $objSeo->update($dbData, ['service_id' => $service_id]);
        $msg = "Service SEO details updated successfully";
    } else {
        // Fresh insertion configuration workflow routing context map
        $dbData['service_id'] = $service_id;
        $objSeo->insert($dbData);
        $msg = "Service SEO details added successfully";
    }

    // Final redirection destination path mapping
    redirect('admin/services/service-list.php', ["success" => $msg]);
    exit;
} else {
    redirect('admin/services/service-list.php');
    exit;
}