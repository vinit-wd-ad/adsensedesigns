<?php
$contents = isset($contents) && is_array($contents) ? $contents : [];
?>

<div class="row">
    <?php if (!empty($contents)): ?>
        <?php foreach ($contents as $content): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="service-item-1 h-100 text-center">

                    <?php if (!empty($content['image']) && file_exists("uploads/contents/" . $content['image'])): ?>
                        <div class="mb-3">
                            <img src="<?= BASE_URL . 'uploads/contents/' . $content['image'] ?>" alt="<?= htmlspecialchars($content['title']) ?>" class="w-100 img-fluid object-fit-cover">
                        </div>
                    <?php elseif (!empty($content['icon'])): ?>
                        <div class="icon fs-1 mb-3 mt-4">
                            <?= $content['icon'] ?>
                        </div>
                    <?php else: ?>
                        <div class="icon fs-1 mb-3 mt-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    <?php endif; ?>

                    <h5 class="fw-bold mb-2 px-4"><?= strtoupper(htmlspecialchars($content['title'])) ?></h5>
                    <?php if (!empty($content['description'])): ?>
                        <p class="text-muted px-4 small mb-4"><?= htmlspecialchars($content['description']) ?></p>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>