<?php
$serviceObj = new Database('services');
$services = $serviceObj->fetchAll();
?>

<div class="row g-4 d-flex justify-content-center">

    <?php
    if (!empty($services)) {
        $sCount = 1;
        foreach ($services as $service) {
    ?>
            <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <a href="<?= BASE_URL ?>service/<?= $service['slug'] ?>">
                    <div class="service-card-items style-2 text-center">
                        <div class="icon">
                            <?= $service['icon'] ?>
                        </div>
                        <div class="content">
                            <h5>
                                <a href="#">
                                    <?= $service['name'] ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
    <?php
            if (isset($maxCount)) {
                if ($sCount === $maxCount) break;
                $sCount = $sCount + 1;
            }
        }
    }
    ?>

</div>