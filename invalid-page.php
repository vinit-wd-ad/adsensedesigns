<?php
header("HTTP/1.1 410 Gone");
header("Status: 410 Gone");
require "setting.php";
include "header.php";

render_header(
    "Page Not Found",
    "The page you are looking for does not exist.",
    [
        "keywords" => "404, page not found, error",
        "robots" => "noindex, nofollow",
    ]
);

?>
<!--<< Breadcrumb Section Start >>-->
<div class="breadcrumb-wrapper bg-cover section-padding" style="background-image: url('assets/img/breadcrumb.jpg');">
    <div class="layer-shape wow fadeInLeft" data-wow-delay=".3s">
        <img src="assets/img/layer-shape-3.png" alt="shape-img">
    </div>
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Page Not Found</h1>
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
                    Page not found
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Info Section Start -->
<section class="contact-info-section section-padding fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="contact-info-content">
                    <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                        <!-- <h1>Page Not Found</h1> -->
                    </div>

                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="/" class="theme-btn">Go To Home Page</a>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>