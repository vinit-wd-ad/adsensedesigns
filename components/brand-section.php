<?php
// Brand logos list (Images Array)
$brandLogos = [
    'vibezzzz.png',
    'cargill.png',
    'srs-india.png',
    'STOREFORME.png',
    'dev-energy.png',
    'swasth-01-01.png',
    'gvi.png',
    'leon.png',
    'nibus-global.png',
    'jsm-energy.png',
    'snoox.png',
    'rmps.png',
    'haus-storm.png',
    'supplement.png',
    'rni.png',
    'goodwill.png',
    'kl-fresh-story.png'
];
?>

<!-- Brand Section Start -->
<div class="brand-section-3 fix section-padding">
    <div class="layer-shape">
        <img src="assets/img/layer-shape.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="row text-end">
            <a href="" class="text-primary m-0 p-0" style="color: var(--white) !important; z-index: 99999;">view all &rarr;</a>
        </div>
        <div class="brand-wrapper style-4">
            <div class="swiper brand-slider-2">
                <div class="swiper-wrapper">
                    <?php if (!empty($brandLogos)): ?>
                        <?php foreach ($brandLogos as $logo): ?>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/<?= htmlspecialchars($logo) ?>" alt="brand-img">
                                    <div class="color-overlay"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Section End -->