<?php
$serObj = new Database('services');
$serHeader = $serObj->where(['status' => 'active']);

function render_header($title = "Default Title", $description = "Default description", $meta_tags = [],  $link_tags = [], $schema = [])
{
    global $BASE_URL;
    global $serHeader;
?>

    <!DOCTYPE html>
    <html lang="en" class="lenis">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="geo.region" content="IN-DL" />
        <meta name="geo.placename" content="New Delhi" />
        <?php
        // Additional meta tags (array of name => content)
        foreach ($meta_tags as $key => $content) {
            // Agar key 'og:' ya 'property' se shuru ho toh attribute 'property' use karein, warna 'name'
            if (strpos($key, 'og:') === 0) {
                echo '<meta property="' . htmlspecialchars($key) . '" content="' . $content . '">' . "\n\t\t";
            } else {
                echo '<meta name="' . htmlspecialchars($key) . '" content="' . $content . '">' . "\n\t\t";
            }
        }
        // Output optional link tags
        foreach ($link_tags as $rel => $href) {
            echo '<link rel="' . htmlspecialchars($rel) . '" href="' . htmlspecialchars($href) . '">' . "\n";
        }
        ?>
        <!-- <meta name="msvalidate.01" content="8BA2DD0F6A3775417E8A3BBF05F9D014" /> -->

        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="<?= BASE_URL ?>assets/img/logo/s-logo.png">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
        <!--<< Font Awesome.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/all.min.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/flaticon.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/animate.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/swiper-bundle.min.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/custom.css?v=1.01.11">
        <!--<< Style.css >>-->
        <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

        <?php
        if (!empty($schema)) {
            echo '<script type="application/ld+json">' . "\n";
            echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            echo "\n" . '</script>' . "\n";
        }
        ?>
    </head>

<?php
    include BASE_PATH . "nav.php";
}
?>