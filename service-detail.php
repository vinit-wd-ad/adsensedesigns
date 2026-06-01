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

// 5. Fetch Sections linked directly to this Corporate Service context
$objSection = new Database('service_section');
$allSections = $objSection->where(['service_id' => $service_id, 'status' => 'active']);

// Verify if segments exist to prevent sort exceptions on null entries arrays
if (!empty($allSections) && is_array($allSections)) {
    usort($allSections, function ($a, $b) {
        return intval($a['priority']) <=> intval($b['priority']);
    });
}

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
if (!empty($service['short_description'])) {
?>
    <section>
        <div class="container py-5">
            <div class="text-center mb-4 section-title">
                <h2 class="hero-title mb-2"><?= htmlspecialchars($service['name']) ?></h2>
                <p class=""><?= htmlspecialchars($service['short_description']) ?></p>
                <div class="hero-divider mx-auto"></div>
            </div>
        </div>
    </section>
<?php
}
?>


<?php if (!empty($allSections) && is_array($allSections)): ?>
    <?php $sectionIndex = 0;
    foreach ($allSections as $section):
        $section_id = intval($section['id']);
        $bg_class = ($sectionIndex % 2 == 0) ? 'bg-white' : 'bg-theme3';

        // Fetch nested block elements inside current single service section context
        $objContent = new Database('service_section_content');
        $contents = $objContent->where(['section_id' => $section_id, 'status' => 'active']);

        // Ensure priority ordering array mapping validation runs safely
        if (!empty($contents) && is_array($contents)) {
            usort($contents, function ($a, $b) {
                return intval($a['priority']) <=> intval($b['priority']);
            });
        }
    ?>

        <section class="service-section-block py-5 <?= $bg_class ?> ">
            <div class="container py-3">
                <div class="row align-items-center">
                    <?php if (!empty($section['image']) && file_exists("uploads/sections/" . $section['image'])): ?>
                        <div class="col-lg-5 <?= ($sectionIndex % 2 == 1) ? 'order-lg-2' : '' ?> mb-4 mb-lg-0 wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-image-wrapper border rounded shadow-sm overflow-hidden">
                                <img src="<?= BASE_URL . 'uploads/sections/' . $section['image'] ?>" alt="<?= htmlspecialchars($section['title']) ?>" class="img-fluid w-100 object-fit-cover">
                            </div>
                        </div>
                        <div class="col-lg-7 <?= ($sectionIndex % 2 == 1) ? 'order-lg-1' : '' ?> wow fadeInRight" data-wow-delay=".5s">
                        <?php else: ?>
                            <div class="col-12 wow fadeInUp" data-wow-delay=".3s">
                            <?php endif; ?>
                            <div class="section-text-content-wrapper section-title">
                                <h3><?= htmlspecialchars($section['title']) ?></h3>
                                <?php if (!empty($section['description'])): ?>
                                    <div class="text-muted leading-relaxed mb-4">
                                        <?= nl2br(htmlspecialchars($section['description'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            </div>
                        </div>

                        <?php if (!empty($contents) && is_array($contents)): ?>
                            <div class="row mt-4">
                                <?php foreach ($contents as $content): ?>
                                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 wow fadeInUp" data-wow-delay=".3s">
                                            <div class="service-item-1">
                                                <div class="d-flex align-items-center mb-3 flex-column">
                                                    <?php if (!empty($content['image']) && file_exists("uploads/contents/" . $content['image'])): ?>
                                                        <div class="mb-3">
                                                            <img src="<?= BASE_URL . 'uploads/contents/' . $content['image'] ?>" alt="<?= htmlspecialchars($content['title']) ?>" style="" class="rounded w-100 img-fluid">
                                                        </div>
                                                    <?php elseif (!empty($content['icon'])): ?>
                                                        <div class="icon text-primary fs-1 mb-3 mt-4">
                                                            <?= $content['icon'] ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="icon text-primary fs-1 my-3">
                                                            <i class="fas fa-check-circle"></i>
                                                        </div>
                                                    <?php endif; ?>

                                                    <h5 class="fw-bold mb-0 px-4"><?= htmlspecialchars($content['title']) ?></h5>
                                                </div>

                                                <?php if (!empty($content['description'])): ?>
                                                    <p class="text-muted small mb-0 px-4 mb-4"><?= nl2br(htmlspecialchars($content['description'])) ?></p>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                </div>
        </section>
    <?php $sectionIndex++;
    endforeach; ?>
<?php else: ?>
    <section class="section-padding bg-white text-center">
        <div class="container">
            <div class="p-5 border rounded bg-light max-w-2xl mx-auto">
                <i class="fas fa-layer-group fs-1 text-muted mb-3"></i>
                <h4 class="text-dark fw-bold">Detailed Analysis Pending</h4>
                <p class="text-muted mb-0">Our structured technical specification framework profiles are currently being updated for this operational segment block.</p>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php include "components/social-section.php" ?>

<?php include "footer.php"; ?>