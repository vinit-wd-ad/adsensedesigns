<?php
$sections = isset($sections) && is_array($sections) ? $sections : [];

foreach ($sections as $section):
    $section_id = intval($section['id']);
    $section_bg = ($globalSectionCount % 2 == 0) ? 'bg-white' : 'bg-theme3';

    $content_design = !empty($section['content_design_type']) ? $section['content_design_type'] : 'default_card_3col';

    $objContent = new Database('service_section_content');
    $contents = $objContent->where(['section_id' => $section_id, 'status' => 'active']);
?>
    <section class="service-section-block py-5 <?= $section_bg ?>">
        <div class="container">
            <div class="row align-items-center my-2 section-inner-row">
                <?php if (!empty($section['image']) && file_exists("uploads/sections/" . $section['image'])): ?>
                    <div class="col-lg-5 <?= ($globalSectionCount % 2 == 1) ? 'order-lg-2' : '' ?> mb-4 wow fadeInLeft">
                        <img src="<?= BASE_URL . 'uploads/sections/' . $section['image'] ?>" class="img-fluid w-100 border rounded shadow-sm">
                    </div>
                    <div class="col-lg-7 <?= ($globalSectionCount % 2 == 1) ? 'order-lg-1' : '' ?> wow fadeInRight">
                    <?php else: ?>
                        <div class="col-12 wow fadeInUp">
                        <?php endif; ?>
                        <div class="section-title text-start">
                            <h3 class="fw-bold mb-3"><?= htmlspecialchars($section['title']) ?></h3>
                            <p class="text-muted leading-relaxed"><?= nl2br(htmlspecialchars($section['description'])) ?></p>
                        </div>
                        </div>
                    </div>

                    <?php if (!empty($contents)):

                        $content_file = "layouts/contents/" . $content_design . ".php";
                        if (file_exists($content_file)) {
                            include $content_file;
                        } else {
                            include "layouts/contents/default_card_3col.php";
                        }
                    ?>

                    <?php endif; ?>

            </div>
    </section>
<?php
    $globalSectionCount++;
endforeach;
?>