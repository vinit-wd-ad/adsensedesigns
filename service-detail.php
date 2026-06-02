<?php
require "setting.php";

// 1. Fetch Slug securely from Clean URL Param mapping via htaccess
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// Fallback safety check before triggering Database class exception rule
if (empty($slug)) {
    include "404.php";
    exit;
}

// 2. Load Core Service Profile safely matching strict conditions
$objService = new Database('services');
$serviceRows = $objService->where(['slug' => $slug, 'status' => 'active']);

// Structural checking condition to prevent undefined array index 0 crashes
if (empty($serviceRows)) {
    include "404.php";
    exit;
}

$service = $serviceRows[0];
$service_id = intval($service['id']);

// 3. Load Tailored Service SEO Configurations
$objSeo = new Database('service_seo');
$seoRows = $objSeo->where(['service_id' => $service_id]);
$seoData = !empty($seoRows) ? $seoRows[0] : null;

// Parse Dynamic JSON arrays from DB schema attributes with robust fallbacks
$seo_meta = (!empty($seoData['seo_meta']) && is_string($seoData['seo_meta'])) ? json_decode($seoData['seo_meta'], true) : [];
$og_seo   = (!empty($seoData['og_seo']) && is_string($seoData['og_seo'])) ? json_decode($seoData['og_seo'], true) : [];

// 4. Setup Safe Dynamic Meta Variables with Global Fallback Maps
$meta_title = !empty($seo_meta['title']) ? $seo_meta['title'] : htmlspecialchars($service['name']) . " - Adsense Designs";
$meta_desc  = !empty($seo_meta['description']) ? $seo_meta['description'] : (!empty($service['short_description']) ? htmlspecialchars($service['short_description']) : "Explore our expert dynamic industry application profiles.");
$meta_keys  = !empty($seo_meta['keywords']) ? $seo_meta['keywords'] : "services, corporate identity, design strategies, " . strtolower(htmlspecialchars($service['name']));
$robots     = !empty($seoData['robots']) ? $seoData['robots'] : "index, follow";
$canonical  = !empty($seoData['canonical_url']) ? $seoData['canonical_url'] : BASE_URL . htmlspecialchars($service['slug']);

// Load structural presentation layout configuration header context template asset
include "header.php";

render_header(
    $meta_title,
    $meta_desc,
    [
        "keywords" => $meta_keys,
        "robots"   => $robots,
    ],
    [
        "canonical" => $canonical,
    ]
);

// Inject strict dynamic structured Schema markup to body loop if parsed successfully
if (!empty($seoData['schema_json']) && $seoData['schema_json'] !== '{}' && is_string($seoData['schema_json'])) {
    echo "\n<script type=\"application/ld+json\">\n" . $seoData['schema_json'] . "\n</script>\n";
}
?>

<div class="breadcrumb-wrapper section-padding bg-cover bg-banner-height" style="background-image: url('<?= BASE_URL ?>assets/img/breadcrumb.jpg'); height: 25rem;">
    <div class="layer-shape wow fadeInLeft" data-wow-delay=".3s">
        <img src="<?= BASE_URL ?>assets/img/layer-shape-3.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s"><?= htmlspecialchars($service['name']) ?></h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="<?= BASE_URL ?>">Home</a></li>
                <li>/</li>
                <li><a href="<?= BASE_URL ?>services">Services</a></li>
                <li>/</li>
                <li><?= htmlspecialchars($service['name']) ?></li>
            </ul>
        </div>
    </div>
</div>

<?php
$objWrapper = new Database('service_wrapper');
$allWrappers = $objWrapper->where(['service_id' => $service_id, 'status' => 'active']);


if (!empty($allWrappers) && is_array($allWrappers)):
    usort($allWrappers, function ($a, $b) {
        return intval($a['priority']) <=> intval($b['priority']);
    });

    $globalSectionCount = 0;

    foreach ($allWrappers as $wIndex => $wrapper):
        $wrapper_id = intval($wrapper['id']);

        // Admin ne is wrapper ke liye kaun sa design chuna hai
        $section_design = !empty($wrapper['section_design_type']) ? $wrapper['section_design_type'] : 'default_heading';

        $objSection = new Database('service_section');
        $sections = $objSection->where(['wrapper_id' => $wrapper_id, 'status' => 'active']);

        if (!empty($sections) && is_array($sections)) {
            usort($sections, function ($a, $b) {
                return intval($a['priority']) <=> intval($b['priority']);
            });
        }

        $wrapper_bg = (!empty($sections) && $globalSectionCount % 2 != 0) ? 'bg-theme3' : 'bg-white';
?>
        <section class="service-wrapper-header pt-5 <?= $wrapper_bg ?> <?= empty($sections) ? 'pb-5' : '' ?>">
            <div class="container">
                <div class="text-center mb-0 section-title mx-auto max-w-2xl">
                    <h2 class="hero-title mb-2"><?= htmlspecialchars($wrapper['name']) ?></h2>
                    <?php if (!empty($wrapper['description'])): ?>
                        <p class="text-muted small mb-0"><?= nl2br(htmlspecialchars($wrapper['description'])) ?></p>
                    <?php endif; ?>
                    <div class="hero-divider mx-auto mt-3"></div>
                </div>
            </div>
        </section>

        <?php
        if (!empty($sections)):
            $section_file = "layouts/sections/" . $section_design . ".php";
            if (file_exists($section_file)) {
                include $section_file;
            } else {
                include "layouts/contents/default_heading.php";
            }
        endif;
    endforeach;
else:
    // Fallback UI block if no section blocks or configurations found inside database arrays
    if (!empty($service['short_description'])):
        ?>
        <section class="bg-white">
            <div class="container py-5">
                <div class="text-center mb-4 section-title">
                    <h2 class="hero-title mb-2"><?= htmlspecialchars($service['name']) ?></h2>
                    <p><?= htmlspecialchars($service['short_description']) ?></p>
                    <div class="hero-divider mx-auto"></div>
                </div>
            </div>
        </section>
<?php
    endif;
endif;
?>

<?php include "components/social-section.php" ?>
<?php include "footer.php"; ?>