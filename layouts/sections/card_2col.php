<?php
$sections = isset($sections) && is_array($sections) ? $sections : [];
$wrapper_bg = isset($wrapper_bg) ? $wrapper_bg : '';
?>
<section class="service-section-grid pb-5 pt-3 <?= $wrapper_bg ?>">
    <div class="container">
        <div class="row">
            <?php foreach ($sections as $section): ?>
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="service-card-box h-100 shadow-sm border rounded bg-white p-4 text-center">

                        <?php if (!empty($section['image']) && file_exists("uploads/sections/" . $section['image'])): ?>
                            <div class="mb-3 overflow-hidden rounded" style="max-height: 180px;">
                                <img src="<?= BASE_URL . 'uploads/sections/' . $section['image'] ?>" alt="<?= htmlspecialchars($section['title']) ?>" class="img-fluid w-100 object-fit-cover">
                            </div>
                        <?php elseif (!empty($section['icon'])): ?>
                            <div class="icon fs-1 mb-3">
                                <?= $section['icon'] ?>
                            </div>
                        <?php else: ?>
                            <div class="icon fs-1 mb-3">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        <?php endif; ?>

                        <h4 class="fw-bold fs-5 mb-2"><?= htmlspecialchars($section['title']) ?></h4>
                        <?php if (!empty($section['description'])): ?>
                            <p class="text-muted small mb-0"><?= htmlspecialchars($section['description']) ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            <?php $globalSectionCount++;
            endforeach; ?>
        </div>
    </div>
</section>