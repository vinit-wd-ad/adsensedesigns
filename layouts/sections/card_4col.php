<?php
$sections = isset($sections) && is_array($sections) ? $sections : [];
$wrapper_bg = isset($wrapper_bg) ? $wrapper_bg : '';
?>
<section class="service-section-grid pb-5 pt-3 <?= $wrapper_bg ?>">
    <div class="container">
        <div class="row">
            <?php foreach ($sections as $section): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="service-item-1 text-center">

                        <?php if (!empty($section['image']) && file_exists("uploads/sections/" . $section['image'])): ?>
                            <div class="mb-3">
                                <img src="<?= BASE_URL . 'uploads/sections/' . $section['image'] ?>" alt="<?= htmlspecialchars($section['title']) ?>" class="img-fluid w-100 object-fit-cover">
                            </div>
                        <?php elseif (!empty($section['icon'])): ?>
                            <div class="icon fs-1 mb-3 mt-4">
                                <?= $section['icon'] ?>
                            </div>
                        <?php else: ?>
                            <div class="icon fs-1 mb-3 mt-4">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        <?php endif; ?>

                        <h4 class="fw-bold fs-5 mb-2 px-4"><?= htmlspecialchars($section['title']) ?></h4>
                        <?php if (!empty($section['description'])): ?>
                            <p class="text-muted small mb-4 px-4"><?= htmlspecialchars($section['description']) ?></p>
                        <?php endif; ?>

                    </div>
                </div>
            <?php $globalSectionCount++;
            endforeach; ?>
        </div>
    </div>
</section>