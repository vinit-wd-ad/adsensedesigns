<?php
require "setting.php"; 
include "header.php";

$slug = '';
if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = trim($_GET['slug']);
} else {
    
    $request_uri = str_replace('/adsense/', '', $_SERVER['REQUEST_URI']);
    $uri_parts = explode('/', trim($request_uri, '/'));
    if (isset($uri_parts[0]) && $uri_parts[0] === 'blog' && isset($uri_parts[1])) {
        $slug = trim($uri_parts[1]);
    }
}

// Database Objects initializing
$objBlog = new Database('blogs');
$objContent = new Database('blogs_content');
$objSeo = new Database('blogs_seo');

$blog = null;
$content = '';
$seoData = null;
$isDefault = true;

if (!empty($slug)) {
    try {
        $blogRows = $objBlog->whereCustom(['slug' => $slug], "slug = :slug");
        
        if (!empty($blogRows)) {
            $blog = $blogRows[0];
            $blog_id = $blog['id'];
            $isDefault = false;

            $contentRows = $objContent->where(['blog_id' => $blog_id]);
            $content = !empty($contentRows) ? $contentRows[0]['content'] : '';

            $seoRows = $objSeo->where(['blog_id' => $blog_id]);
            if (!empty($seoRows)) {
                $seoData = $seoRows[0];
            }
        }
    } catch (Exception $e) {
        $isDefault = true;
    }
}


if (!$isDefault && $blog) {
    $seo_meta = !empty($seoData['seo_meta']) ? json_decode($seoData['seo_meta'], true) : [];

    $page_title = !empty($seo_meta['title']) ? $seo_meta['title'] : $blog['title'];
    $meta_desc  = !empty($seo_meta['description']) ? $seo_meta['description'] : $blog['short_description'];
    $keywords   = !empty($seo_meta['keywords']) ? $seo_meta['keywords'] : "web design, blogs, adsense designs";

    $robots     = !empty($seoData['robots']) ? $seoData['robots'] : "index, follow";
    $canonical  = !empty($seoData['canonical_url']) ? $seoData['canonical_url'] : BASE_URL . "blog/" . $blog['slug'];
} else {

    $page_title = "Adsense Designs - Blog Details";
    $meta_desc  = "Explore Our Blog Details - Adsense Designs";
    $keywords   = "service details, web design, cloud service, IT management";
    $robots     = "index, follow";
    $canonical  = "https://adsensedesigns.com/blog-details";
}


render_header(
    $page_title,
    $meta_desc,
    [
        "keywords" => $keywords,
        "robots" => $robots,
    ],
    [
        "canonical" => $canonical,
    ]
);

if (!$isDefault && !empty($seoData['schema_json']) && $seoData['schema_json'] !== '{}') {
    echo "\n<script type='application/ld+json'>\n" . $seoData['schema_json'] . "\n</script>\n";
}

// Display elements assignment
$displayTitle     = !$isDefault ? htmlspecialchars($blog['title']) : "World best web <br> design service provider.";
$displayShortDesc = !$isDefault ? htmlspecialchars($blog['short_description']) : "We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors.";
$displayImage     = (!$isDefault && !empty($blog['image'])) ? BASE_URL . "uploads/blogs/" . $blog['image'] : "assets/img/service/details.jpg";
?>

<div class="breadcrumb-wrapper section-padding bg-cover bg-banner-height" style="background-image: url('<?= BASE_URL ?>assets/img/breadcrumb.jpg');height:25rem;">
    <div class="layer-shape wow fadeInLeft" data-wow-delay=".3s">
        <img src="<?= BASE_URL ?>assets/img/layer-shape-3.png" alt="shape-img">
    </div>
    <div class="breadcrumb-shape wow fadeInRight" data-wow-delay=".5s"></div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s"><?= !$isDefault ? "Blog Details" : "Service Details" ?></h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="<?= BASE_URL ?>">Home Page</a></li>
                <li>/</li>
                <li><?= !$isDefault ? htmlspecialchars($blog['title']) : "Service Details" ?></li>
            </ul>
        </div>
    </div>
</div>

<section class="Service-details fix section-padding">
    <div class="container">
        <div class="service-details-wrapper">
            <div class="row g-5">
                <div class="col-12">
                    <div class="service-details-content">

                        <h2><?= $displayTitle ?></h2>
                        <p><?= $displayShortDesc ?></p>

                        <!-- <div class="details-image bg-cover mt-4" style="background-image: url('<?= $displayImage ?>');"></div> -->
                        <img src="<?= $displayImage ?>" alt="">

                        <div class="main-blog-rich-content mt-5">
                            <?php if (!$isDefault && !empty($content)): ?>
                                <?= $content ?>
                            <?php else: ?>
                                <h3 class="details-title">Cloud Service</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula.
                                </p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>