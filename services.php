<?php
require "setting.php";
include "header.php";

render_header(
    "Adsense Designs - Our Services",
    "Explore our wide range of services including graphic design, motion graphics, digital marketing, and more. We are committed to delivering the best solutions for our customers.",
    [
        "keywords" => "services, graphic design, motion graphics, digital marketing, marketing solutions, exhibitions, corporate gifting, print solutions, indoor branding, interiors",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/services",
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
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Our Services</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li>
                    <a href="/">
                        Home Page
                    </a>
                </li>
                <li>
                    /
                </li>
                <li>
                    Services
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Service Section Start -->
<section class="service-section mt-5">
    <div class="container mt-5">
        <div class="section-title">
            <a href=""><span class="wow fadeInUp">Our Services</span></a>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                We always deliver best <br>
                service for customer
            </h2>
        </div>
        <?php include "components/service-section-2.php"; ?>
    </div>
</section>>


<!-- Project Successful Section Start -->
<section class="project-successful section-padding bg-light">
    <div class="container">
        <div class="section-title text-center wow fadeInUp" data-wow-delay=".3s">
            <h5>We completed <span class="text">1240+</span> projects successfully and continuosely working</h5>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="project-successful-items">
                    <div class="icon">
                        <i class="fas fa-stars"></i>
                    </div>
                    <div class="content">
                        <h5>
                            Our global <br>
                            customer
                        </h5>
                    </div>
                    <div class="counter-text">
                        <h2><span class="count">28</span>%</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="project-successful-items active">
                    <div class="icon">
                        <i class="fas fa-stars"></i>
                    </div>
                    <div class="content">
                        <h5>
                            Our completed <br>
                            projects
                        </h5>
                    </div>
                    <div class="counter-text">
                        <h2><span class="count">45</span>%</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="project-successful-items">
                    <div class="icon">
                        <i class="fas fa-stars"></i>
                    </div>
                    <div class="content">
                        <h5>
                            Our expert <br>
                            worker
                        </h5>
                    </div>
                    <div class="counter-text">
                        <h2><span class="count">20</span>%</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include "footer.php"; ?>