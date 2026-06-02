<?php
$contents = isset($contents) && is_array($contents) ? $contents : [];
?>
<div class="project-wrapper style-4 pt-4">
    <div class="swiper project-slider-4" data-items="4">
        <div class="swiper-wrapper">
            <?php if (!empty($contents)): ?>
                <?php foreach ($contents as $content): ?>
                    <div class="swiper-slide h-auto">
                        <div class="service-item-1 bg-transparent text-center">

                            <?php if (!empty($content['image']) && file_exists("uploads/contents/" . $content['image'])): ?>
                                <div class="mb-3">
                                    <img src="<?= BASE_URL . 'uploads/contents/' . $content['image'] ?>" alt="<?= htmlspecialchars($content['title']) ?>" class="w-100 img-fluid object-fit-cover">
                                </div>
                            <?php elseif (!empty($content['icon'])): ?>
                                <div class="icon fs-1 mb-3">
                                    <?= $content['icon'] ?>
                                </div>
                            <?php else: ?>
                                <div class="icon fs-1 mb-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            <?php endif; ?>

                            <h5 class="fw-bold mb-2"><?= strtoupper(htmlspecialchars($content['title'])) ?></h5>
                            <?php if (!empty($content['description'])): ?>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($content['description']) ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination mt-4 position-relative"></div>
    </div>
</div>