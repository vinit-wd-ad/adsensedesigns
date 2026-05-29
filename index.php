<?php
require_once "setting.php";
include "header.php";

render_header(
    "We are adding sense to your brand",
    "We are Adsense Design Pvt. Ltd., a dynamic marketing agency dedicated to crafting compelling brand stories and driving impactful digital experiences",
    [
        "keywords" => "Graphics Design, Motion Graphics, Digital Marketing, Marketing Solutions, Exhibitions, Corporate Gifting, Print Solutions",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/",
    ]
);

?>

<!-- Hero Section Start -->
<section class="hero-section-3">
    <div class="line-area">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="array-button">
        <button class="array-prev"><i class="fal fa-arrow-left"></i> </button>
        <button class="array-next"><i class="fal fa-arrow-right"></i></button>
    </div>
    <div class="swiper hero-slider-3">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero-3 bg-cover" style="background-image: url('assets/img/hero/banner-1.webp');">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <div class="hero-content text-center">
                                    <h5 data-animation="fadeInUp" data-delay="1.3s">
                                        WE ARE ALWAYS BEST
                                    </h5>
                                    <h1 class="banner-title" data-animation="fadeInUp" data-delay="1.5s">DIGITAL MARKETING</h1>
                                    <p data-animation="fadeInUp" data-delay="1.7s">
                                        Adsense is a creative digital agency and design agency based on USA by the
                                        saiful <br>
                                        New Yourk San fransisco company
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero-3 bg-cover" style="background-image: url('assets/img/hero/banner-2jpg.jpg');">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <div class="hero-content text-center">
                                    <h5 data-animation="fadeInUp" data-delay="1.3s">
                                        WE ARE ALWAYS BEST
                                    </h5>
                                    <h1 class="banner-title" data-animation="fadeInUp" data-delay="1.5s">GRAPHICS DESIGN</h1>
                                    <p data-animation="fadeInUp" data-delay="1.7s">
                                        Adsense is a creative digital agency and design agency based on USA by the
                                        saiful <br>
                                        New Yourk San fransisco company
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero-3 bg-cover" style="background-image: url('assets/img/hero/banner-3.jpg');">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <div class="hero-content text-center">
                                    <h5 data-animation="fadeInUp" data-delay="1.3s">
                                        WE ARE ALWAYS BEST
                                    </h5>
                                    <h1 class="banner-title" data-animation="fadeInUp" data-delay="1.5s">MOTION GRAPHICS</h1>
                                    <p data-animation="fadeInUp" data-delay="1.7s">
                                        Adsense is a creative digital agency and design agency based on UK by the
                                        saiful <br>
                                        London Based Consulting company
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section Start -->
<section class="about-section fix section-padding">
    <div class="shape-image">
        <img src="assets/img/about/shape.png" alt="shape-img">
    </div>
    <div class="shape-image-2">
        <img src="assets/img/about/shape-2.png" alt="shape-img">
    </div>
    <div class="line-area">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="about-wrapper-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-image bg-cover wow fadeInUp" data-wow-delay=".3s" style="background-image: url('assets/img/about/about-7.jpg');">
                        <div class="about-image-2 bg-cover wow fadeInLeft" data-wow-delay=".5s" style="background-image: url('assets/img/about/about-6.jpg');"></div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mt-5 mt-lg-0">
                    <div class="about-content">
                        <div class="section-title style-2">
                            <h5>Welcome to Adsense Design </h5>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                WE ARE <b>AD</b>DING <b>SENSE</b> <br> TO YOUR BRAND
                            </h2>
                        </div>
                        <!-- <h5 class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">We know that good design means
                                good business solution</h5> -->
                        <p class="wow fadeInUp" data-wow-delay=".7s">
                            We are Adsense Design Pvt. Ltd., a dynamic marketing agency dedicated to crafting compelling brand stories and driving impactful digital experiences. With a blend of creativity, strategy, and innovation, we specialize in delivering audience-relevant solutions that encourage brands to new heights. From captivating visuals to strategic campaigns, we're here to help our clients stand out in a crowded digital landscape.
                        </p>
                        <div class="author-items wow fadeInUp d-flex justify-content-end" data-wow-delay=".9s">
                            <div class="about-button">
                                <a href="about-us" class="theme-btn">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Section Start -->
<section class="service-section">
    <div class="container">
        <div class="section-title">
            <a href=""><span class="wow fadeInUp">Our Services</span></a>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                We always deliver best <br>
                service for customer
            </h2>
        </div>
        <?php include "components/service-section-3.php"; ?>
    </div>
</section>


<!-- Website Checking Section Start -->
<section class="website-checking section-padding fix bg-cover mt-5" style="background-image: url('assets/img/bg.jpg');">
    <div class="container">
        <div class="section-title text-center">
            <span class="text-white wow fadeInUp">Ready to buildup</span>
            <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">Get your free quote today</h2>
        </div>
        <div class="website-checking-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="checking-area wow fadeInUp" data-wow-delay=".5s">
                        <div class="check-items d-flex align-items-center">
                            <div class="check-input">
                                <input type="text" id="text" placeholder="Web URL">
                            </div>
                            <div class="check-input">
                                <input type="email" id="email" placeholder="Email Address">
                            </div>
                        </div>
                        <button class="theme-btn header-color-2" type="submit">
                            CHECK NOW
                        </button>
                    </div>
                    <h6 class="wow fadeInUp" data-wow-delay=".7s">Please check our <a href="./">Privacy
                            Policy</a> to find out how we manage and protect you data</h6>
                </div>
            </div>
            <div class="counter-wrapper section-padding pb-0">
                <div class="counter-items wow fadeInUp" data-wow-delay=".3s">
                    <p>More than</p>
                    <h2><span class="count">100</span></h2>
                    <p>Satisfied Clients</p>
                </div>
                <div class="counter-items wow fadeInUp" data-wow-delay=".5s">
                    <p>Experience of</p>
                    <h2><span class="count">40</span>+</h2>
                    <p>Instiution & Industries</p>
                </div>
                <div class="counter-items wow fadeInUp" data-wow-delay=".7s">
                    <p>Handling</p>
                    <h2><span class="count">25</span>+</h2>
                    <p>Successful Brands </p>
                </div>
                <div class="counter-items wow fadeInUp" data-wow-delay=".9s">
                    <p>More than</p>
                    <h2><span class="count">90</span>%</h2>
                    <p>Customer Retention Ratio</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Section Start -->
<section class="project-section-3 section-padding">
    <div class="line-area">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="shape-image">
        <img src="assets/img/project/shape.png" alt="shape-img">
    </div>
    <div class="shape-image-2 float-bob-y">
        <img src="assets/img/project/shape-2.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="section-title">
            <span class="wow fadeInUp">Our work</span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                We’ve done lot’s of work
            </h2>
        </div>
    </div>
    <div class="container pt-4 shadow-sm style-2">

        <!-- 1. Tabs Links (Pure Flat Horizontal Layout - No Borders) -->
        <ul class="nav nav-tabs d-flex flex-nowrap justify-content-between border-0 mb-3 w-100" id="premiumTab" role="tablist" style="overflow-x: auto; white-space: normal;">
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link active w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-brand-tab" data-bs-toggle="tab" data-bs-target="#h-brand-pane" type="button" role="tab" aria-selected="true">
                    BRAND IDENTITY
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-packaging-tab" data-bs-toggle="tab" data-bs-target="#h-packaging-pane" type="button" role="tab" aria-selected="false">
                    PACKAGING DESIGN
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-web-tab" data-bs-toggle="tab" data-bs-target="#h-web-pane" type="button" role="tab" aria-selected="false">
                    WEB SOLUTIONS
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-social-tab" data-bs-toggle="tab" data-bs-target="#h-social-pane" type="button" role="tab" aria-selected="false">
                    SOCIAL MEDIA MANAGEMENT
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-marketing-tab" data-bs-toggle="tab" data-bs-target="#h-marketing-pane" type="button" role="tab" aria-selected="false">
                    TOTAL MARKETING SOLUTION
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-promo-tab" data-bs-toggle="tab" data-bs-target="#h-promo-pane" type="button" role="tab" aria-selected="false">
                    PROMOTIONAL ITEMS
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-merch-tab" data-bs-toggle="tab" data-bs-target="#h-merch-pane" type="button" role="tab" aria-selected="false">
                    BRAND MERCHANDISERS
                </button>
            </li>
            <li class="nav-item flex-fill text-center" role="presentation" style="min-width: 110px;">
                <button class="nav-link w-100 border-0 rounded-0 py-2 px-1 text-uppercase tracking-wider fw-bold lh-sm text-wrap" id="h-trophies-tab" data-bs-toggle="tab" data-bs-target="#h-trophies-pane" type="button" role="tab" aria-selected="false">
                    TROPHIES & MEMENTOES
                </button>
            </li>
        </ul>

        <!-- 2. Tabs Contents Area -->
        <div class="tab-content py-4 border-0" id="premiumTabContent">

            <!-- BRAND IDENTITY -->
            <div class="tab-pane fade show active" id="h-brand-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <!-- <div class="col-lg-6 mt-4 mt-lg-0">
                        <video autoplay muted loop playsinline style="width:100%; height:auto; object-fit:cover;">
                            <source src="assets/img/project/branding1.mp4" type="video/mp4">
                        </video>
                    </div> -->
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <img src="assets/img/project/brand-identity1.jpg" class="img-fluid w-100 rounded-0 shadow-sm" alt="Brand Identity Concept">
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <img src="assets/img/project/brand-identity3.jpg" class="img-fluid w-100 rounded-0 shadow-sm" alt="Brand Identity Concept">
                    </div>
                </div>
            </div>

            <!-- PACKAGING DESIGN -->
            <div class="tab-pane fade" id="h-packaging-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <img src="assets/img/project/packaging1.png" class="img-fluid rounded-0 shadow-sm" alt="Box Packaging">
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <img src="assets/img/project/packaging2.png" class="img-fluid rounded-0 shadow-sm" alt="Box Packaging">
                    </div>
                </div>
            </div>

            <!-- WEB SOLUTIONS -->
            <div class="tab-pane fade" id="h-web-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <img src="assets/img/project/web-solution2.png" class="img-fluid w-100 h-100 rounded-0 shadow-sm" alt="Box Packaging">
                        </div>
                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <img src="assets/img/project/web-solution3.jpeg" class="img-fluid rounded-0 shadow-sm" alt="Box Packaging">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SOCIAL MEDIA MANAGEMENT -->
            <div class="tab-pane fade" id="h-social-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <video autoplay muted loop playsinline style="width:100%; height:auto; object-fit:cover;">
                            <source src="assets/img/project/social1.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <video autoplay muted loop playsinline style="width:100%; height:auto; object-fit:cover;">
                            <source src="assets/img/project/social2.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <img src="assets/img/project/social3.jpeg" class="img-fluid rounded-0 shadow-sm" alt="Social Media Strategy">
                    </div>
                </div>
            </div>

            <!-- TOTAL MARKETING SOLUTION -->
            <div class="tab-pane fade" id="h-marketing-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="assets/img/project/total-marketing2.png" class="img-fluid rounded-0 shadow-sm" alt="Total Marketing Ecosystem">
                    </div>
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-0 h-100 w-100 shadow-sm" alt="Total Marketing Ecosystem">
                    </div>
                </div>
            </div>

            <!-- PROMOTIONAL ITEMS -->
            <div class="tab-pane fade" id="h-promo-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="assets/img/project/promotional-1.jpeg" class="img-fluid rounded-0 shadow-sm" alt="Corporate Giveaways">
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <a href="./case-studies" class="btn btn-dark rounded-0 mt-2 px-4 py-2">View Case Studies</a>
                    </div>
                </div>
            </div>

            <!-- BRAND MERCHANDISERS -->
            <div class="tab-pane fade" id="h-merch-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="assets/img/project/brand1.jpeg" class="img-fluid rounded-0 shadow-sm" alt="Corporate Giveaways">
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <a href="./case-studies" class="btn btn-dark rounded-0 mt-2 px-4 py-2">View Case Studies</a>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/project/brand3.jpeg" class="img-fluid rounded-0 shadow-sm" alt="Corporate Giveaways">
                    </div>
                </div>
            </div>

            <!-- TROPHIES & MEMENTOES -->
            <div class="tab-pane fade" id="h-trophies-pane" role="tabpanel" tabindex="0">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="assets/img/project/trophy1.png" class="img-fluid rounded-0 shadow-sm" alt="Premium Crystal Award">
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/project/trophy2.png" class="img-fluid rounded-0 shadow-sm" alt="Corporate Trophies">
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/project/trophy3.png" class="img-fluid rounded-0 shadow-sm" alt="Corporate Trophies">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- CSS Styling (Place inside your global stylesheet or <style> block) -->
    <style>

    </style>
</section>

<?php include "components/why-choose-us-section.php"; ?>

<?php include "components/review-slider-section.php"; ?>

<!-- Brand Section Start -->
<div class="brand-section-3 fix section-padding">
    <div class="layer-shape">
        <img src="assets/img/layer-shape.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="row text-end">
            <a href="" class="text-primary m-0 p-0" style="color: var(--white) !important;z-index: 99999;">view all &rarr;</a>
        </div>
        <div class="brand-wrapper style-4">
            <div class="swiper brand-slider-2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/vibezzzz.png" alt="brand-img">
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/cargill.png" alt="brand-img">
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/SRS.png" alt="brand-img">
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/STOREFORME.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/dev-energy.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/swasth-01-01.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/GVI-01a.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/LEOAN.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/NIBUS GLOBAL.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/JSM ENERGY.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/HAUS STORM.png" alt="brand-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-image">
                            <img src="assets/img/brand/supplement.png" alt="brand-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Sectio End -->

<?php include "components/blog-section.php"; ?>

<?php include "components/contact-us-home-section.php"; ?>

<?php include "components/social-section.php"; ?>

<?php include "footer.php";  ?>