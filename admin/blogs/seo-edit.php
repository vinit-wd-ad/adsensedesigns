<?php
require "../../setting.php";

$blog_id = isset($_GET['blog_id']) ? intval($_GET['blog_id']) : 0;

if ($blog_id <= 0) {
    redirect('admin/blogs/blog-list.php', ['error' => 'Invalid Blog ID']);
    exit;
}

$objBlog = new Database('blogs');
$blog = $objBlog->find($blog_id);

if (!$blog) {
    redirect('admin/blogs/blog-list.php', ['error' => 'Blog not found']);
    exit;
}

$objSeo = new Database('blogs_seo');
$seoRows = $objSeo->where(['blog_id' => $blog_id]);
$seoData = !empty($seoRows) ? $seoRows[0] : null;

$seo_meta = !empty($seoData['seo_meta']) ? json_decode($seoData['seo_meta'], true) : [];
$og_seo   = !empty($seoData['og_seo']) ? json_decode($seoData['og_seo'], true) : [];

$canonical_url = !empty($seoData['canonical_url']) ? $seoData['canonical_url'] : '';
$robots        = !empty($seoData['robots']) ? $seoData['robots'] : '';
$schema_json   = !empty($seoData['schema_json']) ? $seoData['schema_json'] : '';
?>

<!doctype html>
<html lang="en">

<head>
    <?php include BASE_PATH . "admin/includes/head.php"; ?>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical"
        data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <?php include BASE_PATH . "admin/includes/side-menu.php"; ?>

        <div class="body-wrapper">

            <?php include BASE_PATH . "admin/includes/header.php"; ?>

            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-semibold mb-0">Update SEO Details: <span class="text-primary"><?= htmlspecialchars($blog['title']) ?></span></h5>
                            <a href="<?= BASE_URL ?>admin/blogs/blog-list.php" class="btn btn-primary">
                                Blogs List
                            </a>
                        </div>

                        <form action="<?= BASE_URL ?>admin/classes/process_seo.php" method="POST">
                            <input type="hidden" name="blog_id" value="<?= $blog_id ?>">

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="p-3 border rounded bg-light">
                                        <h6 class="fw-bold mb-3 text-dark"><i class="ti ti-search"></i> Standard SEO Meta</h6>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="seo_meta[title]" class="form-control" value="<?= isset($seo_meta['title']) ? htmlspecialchars($seo_meta['title']) : '' ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="seo_meta[description]" class="form-control" rows="4"><?= isset($seo_meta['description']) ? htmlspecialchars($seo_meta['description']) : '' ?></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="seo_meta[keywords]" class="form-control" placeholder="e.g. tech, blogs, php" value="<?= isset($seo_meta['keywords']) ? htmlspecialchars($seo_meta['keywords']) : '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="p-3 border rounded bg-light">
                                        <h6 class="fw-bold mb-3 text-primary"><i class="ti ti-share"></i> OG SEO (Social Media)</h6>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">OG Title</label>
                                            <input type="text" name="og_seo[title]" class="form-control" value="<?= isset($og_seo['title']) ? htmlspecialchars($og_seo['title']) : '' ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">OG Description</label>
                                            <textarea name="og_seo[description]" class="form-control" rows="4"><?= isset($og_seo['description']) ? htmlspecialchars($og_seo['description']) : '' ?></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">OG Keywords</label>
                                            <input type="text" name="og_seo[keywords]" class="form-control" placeholder="e.g. social, share, trends" value="<?= isset($og_seo['keywords']) ? htmlspecialchars($og_seo['keywords']) : '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="p-3 border rounded bg-light">
                                        <h6 class="fw-bold mb-3 text-danger"><i class="ti ti-settings"></i> Advanced SEO Settings</h6>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Canonical URL</label>
                                                <input type="url" name="canonical_url" class="form-control" placeholder="https://example.com/blog-slug" value="<?= htmlspecialchars($canonical_url) ?>">
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Robots Tag</label>
                                                <input type="text" name="robots" class="form-control" placeholder="index, follow" value="<?= htmlspecialchars($robots) ?>">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Schema JSON-LD (Strict Valid JSON format)</label>
                                                <textarea name="schema_json" class="form-control" rows="5" placeholder='{"@context": "https://schema.org", "@type": "BlogPosting", ...}'><?= htmlspecialchars($schema_json) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success">Update SEO</button>
                            <a href="<?= BASE_URL ?>admin/blogs/blog-list.php" class="btn btn-dark ms-2">Cancel</a>
                        </form>

                    </div>
                </div>

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">
                        Design and Developed by
                        <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">
                            Adsensedesigns
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <?php include BASE_PATH . "admin/includes/script.php" ?>

</body>
</html>