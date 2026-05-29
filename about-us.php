<?php
require "setting.php";
include "header.php";

render_header(
    "Adsense Designs - About Us",
    "we know that good design means good business solution",
    [
        "keywords" => "graphic design, web design, UI/UX, business solutions",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/about",
    ]
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
            <h1 class="wow fadeInUp" data-wow-delay=".3s">About Us</h1>
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
                    About Us
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- About Section Start -->
<section class="about-section fix py-5">
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
    <div class="about-wrapper-3 py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-image bg-cover wow fadeInUp" data-wow-delay=".3s"
                        style="background-image: url('assets/img/about/about-7.jpg');">
                        <div class="about-image-2 bg-cover wow fadeInLeft" data-wow-delay=".5s"
                            style="background-image: url('assets/img/about/about-6.jpg');"></div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mt-5 mt-lg-0">
                    <div class="about-content">
                        <div class="section-title style-2">
                            <h5>About us</h5>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                Creative Digital Agency That Builds Powerful Brands
                            </h2>
                        </div>
                        <h5 class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">We help businesses grow through innovative design, strategic marketing, and impactful digital experiences.</h5>
                        <p class="wow fadeInUp" data-wow-delay=".7s">
                            We are Adsense Design Pvt. Ltd., a dynamic marketing agency dedicated to crafting compelling brand stories and driving impactful digital experiences. With a blend of creativity, strategy, and innovation, we specialize in delivering audience-relevant solutions that encourage brands to new heights. From captivating visuals to strategic campaigns, we're here to help our clients stand out in a crowded digital landscape.
                        </p>
                        <div class="author-items wow fadeInUp d-flex justify-content-end" data-wow-delay=".9s">
                            <div class="about-button">
                                <a href="case-studies" class="theme-btn bg-white border">
                                    View Portfolio
                                </a>
                                <a href="<?= BASE_URL ?>contact-us" class="theme-btn">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who We Are Section Start -->
<section class="service-productive fix py-5" style="background-color: #bdbdbd36;">
    <div class="service-productive-wrapper py-4">
        <div class="circle-shape">
            <img src="assets/img/circle-shape.png" alt="shape-img" class="text-circle">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 mt-5 mt-xl-0">
                    <div class="productive-content">
                        <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                            <h2>Who We Are</h2>
                        </div>
                        <p class="mt-4 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            Adsense Designs is a creative digital agency focused on delivering branding, marketing, web development, and design solutions that help businesses stand out in the modern digital world.
                        </p>
                        <div class="icon-items-area">

                            <!-- Item -->
                            <div class="icon-item d-flex align-items-center wow fadeInUp" data-wow-delay=".3s">
                                <div class="icon">
                                    <i class="fa fa-solid fa-users"></i>
                                </div>
                                <div class="content">
                                    <h5>
                                        Creative & Experienced Team
                                    </h5>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="icon-item d-flex align-items-center wow fadeInUp" data-wow-delay=".5s">
                                <div class="icon">
                                    <i class="fa fa-solid fa-chart-line"></i>
                                </div>
                                <div class="content">
                                    <h5>
                                        Result-Oriented Solutions
                                    </h5>
                                </div>
                            </div>

                        </div>

                        <div class="icon-items-area">

                            <!-- Item -->
                            <div class="icon-item d-flex align-items-center wow fadeInUp" data-wow-delay=".3s">
                                <div class="icon">
                                    <i class="fa fa-solid fa-handshake"></i>
                                </div>
                                <div class="content">
                                    <h5>
                                        Client-Centered Approach
                                    </h5>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="icon-item d-flex align-items-center wow fadeInUp" data-wow-delay=".5s">
                                <div class="icon">
                                    <i class="fa fa-solid fa-layer-group"></i>
                                </div>
                                <div class="content">
                                    <h5>
                                        Modern Design Strategy
                                    </h5>
                                </div>
                            </div>

                        </div>
                        <h6 class="wow fadeInUp" data-wow-delay=".7s">We’re commited to deliver high quality productive service</h6>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="productive-image-2 text-end">
                        <img src="assets/img/about/about-8.jpg" alt="img" class="w-75">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "components/review-slider-section.php"; ?>

<!-- Cta Section Start -->
<section class="cta-section-3 fix section-padding bg-cover" style="background-image: url('assets/img/cta-banner/02.jpg');">
    <div class="container">
        <div class="cta-wrapper-3">
            <div class="text-white wow fadeInUp" data-wow-delay=".3s">
                <h2 class="text-white">Ready To Grow Your Business?</h2>
                <h4 class="text-white">Let’s create something amazing together.</h4>
            </div>

            <a href="<?= BASE_URL ?>contact-us" class="theme-btn hover-white wow fadeInUp" data-wow-delay=".5s">Get Free Consultation</a>
        </div>
    </div>
</section>



<?php include "footer.php"; ?>