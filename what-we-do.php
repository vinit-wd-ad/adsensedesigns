<?php
require_once "setting.php";
include "header.php";

$schema = [
    "@context" => "https://schema.org",
    "@type" => "Service",
    "name" => "What We Do - Adsense Designs Services",
    "provider" => [
        "@type" => "LocalBusiness",
        "name" => "Adsense Designs Pvt. Ltd.",
        "url" => "https://adsensedesigns.com/"
    ],
    "description" => "Discover what we do at Adsense Designs. We specialize in graphic design, digital marketing, web development, corporate gifting, and exhibition setups.",
    "url" => "https://adsensedesigns.com/what-we-do"
];

render_header(
    "What We Do | Creative & Digital Marketing Services | Adsense Designs",
    "Discover what we do at Adsense Designs. We specialize in creating innovative solutions including graphics design, digital marketing, web solutions, and corporate branding to drive business growth.",
    [
        "keywords" => "what we do, digital marketing services, graphics design, web design, UI/UX, exhibition setups, corporate gifting, business solutions",
        "robots" => "index, follow",
        // Open Graph Tags
        "og:title" => "What We Do | Services by Adsense Designs",
        "og:description" => "Explore our wide range of services: Graphics Design, Digital Marketing, Corporate Branding, and Web Solutions.",
        "og:image" => BASE_URL . "assets/img/logo/og-banner.jpg",
        "og:url" => "https://adsensedesigns.com/what-we-do",
        "og:type" => "website",
        // Twitter Cards
        "twitter:card" => "summary_large_image",
        "twitter:title" => "What We Do | Services by Adsense Designs",
        "twitter:description" => "Explore our wide range of services: Graphics Design, Digital Marketing, Corporate Branding, and Web Solutions.",
        "twitter:image" => BASE_URL . "assets/img/logo/og-banner.jpg"
    ],
    [
        "canonical" => "https://adsensedesigns.com/what-we-do"
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
            <h1 class="wow fadeInUp" data-wow-delay=".3s">What We Do</h1>
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
                    What We Do
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- WHAT WE DO SECTION START -->
<section class="what-we-do py-5">
    <div class="container py-3">

        <!-- Section Heading -->
        <div class="text-center mb-5">
            <h6 class="section-subtitle">OUR SERVICES</h6>
            <h2 class="section-title my-2">What We Do</h2>
            <p class="section-para mx-auto">
                We provide creative digital solutions that help businesses grow,
                build strong branding, and create impactful customer experiences.
            </p>
        </div>

        <!-- Services Row -->
        <div class="row g-4 justify-content-center">

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-palette"></i>
                    </div>
                    <h4>Graphic Design</h4>
                    <p>
                        Creative visual designs that make your brand memorable.
                    </p>

                    <div class="mini-points">
                        <span>✔ Logo Design</span>
                        <span>✔ Social Creatives</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-bullhorn"></i>
                    </div>
                    <h4>Digital Marketing</h4>
                    <p>
                        Result-driven strategies to grow your online presence.
                    </p>

                    <div class="mini-points">
                        <span>✔ SEO Marketing</span>
                        <span>✔ Social Media Ads</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-video"></i>
                    </div>
                    <h4>Motion Graphics</h4>
                    <p>
                        Engaging animations and promotional video content.
                    </p>

                    <div class="mini-points">
                        <span>✔ Video Animation</span>
                        <span>✔ Brand Promotions</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-code"></i>
                    </div>
                    <h4>Web Development</h4>
                    <p>
                        Modern responsive websites designed for performance.
                    </p>

                    <div class="mini-points">
                        <span>✔ Responsive Design</span>
                        <span>✔ Fast Loading</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-paint-brush"></i>
                    </div>
                    <h4>Branding Solutions</h4>
                    <p>
                        Build a unique and professional brand identity.
                    </p>

                    <div class="mini-points">
                        <span>✔ Brand Identity</span>
                        <span>✔ Creative Strategy</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-print"></i>
                    </div>
                    <h4>Print Solutions</h4>
                    <p>
                        High-quality printing solutions for your business.
                    </p>

                    <div class="mini-points">
                        <span>✔ Brochure Design</span>
                        <span>✔ Packaging Design</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-tv"></i>
                    </div>
                    <h4>Exhibition Design</h4>
                    <p>
                        Creative exhibition and event branding solutions.
                    </p>

                    <div class="mini-points">
                        <span>✔ Stall Design</span>
                        <span>✔ Event Branding</span>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="col-lg-3 col-md-6">
                <div class="service-card text-center">
                    <div class="service-icon">
                        <i class="fa fa-solid fa-building"></i>
                    </div>
                    <h4>Interior Branding</h4>
                    <p>
                        Transform interiors with creative branding concepts.
                    </p>

                    <div class="mini-points">
                        <span>✔ Office Branding</span>
                        <span>✔ Wall Graphics</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- WHAT WE DO SECTION END -->


<!-- Cta Section Start -->
<section class="cta-section-3 fix section-padding bg-cover" style="background-image: url('assets/img/cta-banner/02.jpg');">
    <div class="container">
        <div class="cta-wrapper-3">
            <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                Ready To Grow Your Brand?
            </h2>
            <a href="<?= BASE_URL ?>contact-us" class="theme-btn hover-white wow fadeInUp" data-wow-delay=".5s">Get Free Consultation</a>
        </div>
    </div>
</section>

<?php include "components/social-section.php" ?>


<?php include "footer.php"; ?>