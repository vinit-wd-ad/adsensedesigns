<?php
require_once "setting.php";
include "header.php";

$schema = [
    "@context" => "https://schema.org",
    "@type" => "CollectionPage",
    "name" => "Case Studies & Success Stories - Adsense Designs",
    "description" => "Explore our portfolio of case studies, client projects, and design success stories showcasing our creative and digital marketing expertise.",
    "url" => "https://adsensedesigns.com/case-studies",
    "publisher" => [
        "@type" => "Organization",
        "name" => "Adsense Designs Pvt. Ltd.",
        "logo" => [
            "@type" => "ImageObject",
            "url" => "https://adsensedesigns.com/assets/img/logo/logo.png"
        ]
    ]
];

render_header(
    "Case Studies & Client Success Stories | Adsense Designs",
    "Explore our case studies, client projects, and design success stories. See how we deliver impactful creative design, digital marketing, and branding solutions for businesses.",
    [
        "keywords" => "case studies, client projects, design success stories, portfolio, digital marketing results, branding projects, adsense designs",
        "robots" => "index, follow",
        // Open Graph Tags
        "og:title" => "Case Studies & Success Stories | Adsense Designs",
        "og:description" => "Discover our successful client projects, design portfolios, and digital marketing transformation case studies.",
        "og:image" => BASE_URL . "assets/img/logo/og-banner.jpg",
        "og:url" => "https://adsensedesigns.com/case-studies",
        "og:type" => "website",
        // Twitter Cards
        "twitter:card" => "summary_large_image",
        "twitter:title" => "Case Studies & Success Stories | Adsense Designs",
        "twitter:description" => "Discover our successful client projects, design portfolios, and digital marketing transformation case studies.",
        "twitter:image" => BASE_URL . "assets/img/logo/og-banner.jpg"
    ],
    [
        "canonical" => "https://adsensedesigns.com/case-studies"
    ],
    $schema
);

?>

<!--<< Breadcrumb Section Start >>-->
<div class="breadcrumb-wrapper section-padding bg-cover bg-banner-height" style="background-image: url('assets/img/breadcrumb.jpg');height:25rem;">
    <div class="layer-shape wow fadeInLeft" data-wow-delay=".3s">
        <img src="assets/img/layer-shape-3.png" alt="shape-img">
    </div>
    <div class="breadcrumb-shape wow fadeInRight" data-wow-delay=".5s">
        <!-- <img src="assets/img/breadcrumb-shape.png" alt="shape-img"> -->
    </div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Case Studies</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li>
                    <a href="/">
                        Home
                    </a>
                </li>
                <li>
                    /
                </li>
                <li>
                    Case Studies
                </li>
            </ul>
        </div>
    </div>
</div>

<?php include "components/case-studies2.php"; ?>


<?php include "footer.php"; ?>