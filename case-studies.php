<?php

include "header.php";

render_header(
    "Adsense Designs - Case Studies",
    "Explore Our Case Studies, Client Projects, and Design Success Stories",
    [
        "keywords" => "case studies, client projects, design success stories",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/case-studies",
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
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Case Studies</h1>
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
                    Case Studies
                </li>
            </ul>
        </div>
    </div>
</div>

<?php include "components/case-studies.php"; ?>


<?php include "footer.php"; ?>