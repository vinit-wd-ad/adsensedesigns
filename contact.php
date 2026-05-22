<?php

include "header.php";

render_header(
    "Adsense Designs - Contact Us",
    "Get in touch with us for your design needs",
    [
        "keywords" => "contact, design, web design, graphic design",
        "robots" => "index, follow",
    ],
    [
        "canonical" => "https://adsensedesigns.com/contact",
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
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Contact Us</h1>
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
                    Contact Us
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Info Section Start -->
<section class="contact-info-section section-padding fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="map-items">
                    <div class="googpemap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.011745161381!2d77.07868172604562!3d28.629410084221504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0549626a308d%3A0xed8415163367b8e1!2sadsense%20designs%20pvt.%20ltd.!5e0!3m2!1sen!2sin!4v1719896534531!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mt-5 mt-lg-0">
                <div class="contact-info-content">
                    <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                        <h2>Get in Touch</h2>
                    </div>
                    <p class="mt-4 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                        A vast majority of the app marketers mainly concent post-launch app marketing techniques and measures while completely missing pre-launch campaign. This prevents the
                    </p>
                    <div class="info-list">
                        <h3 class="wow fadeInUp" data-wow-delay=".3s">Contact Info</h3>
                        <div class="info-items mb-3 wow fadeInUp" data-wow-delay=".5s">
                            <h5>Address</h5>
                            <p>201-A, Jaina Tower-II, District Centre, Janak Puri, New Delhi 110058</p>
                        </div>
                        <div class="info-items mb-3 wow fadeInUp" data-wow-delay=".7s">
                            <h5>Phone</h5>
                            <a href="tel:+09354587874"> 011-40044653</a>
                        </div>
                        <div class="info-items wow fadeInUp" data-wow-delay=".9s">
                            <h5>Email</h5>
                            <a href="#0">info@adsensedesigns.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section Start -->
<section class="contact-section-2 fix section-padding pt-0">
    <div class="container">
        <div class="contact-form-items">
            <div class="title">
                <h2>Let’s Get in Touch</h2>
                <p>Your email address will not be published. Required fields are marked *</p>
            </div>
            <form action="contact.php" id="contact-form" method="POST">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="form-clt">
                            <input type="text" name="name" id="name" placeholder="Your Name*">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-clt">
                            <input type="text" name="email" id="email" placeholder="Your Email*">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-clt">
                            <input type="text" name="text" id="text" placeholder="Website*">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-clt">
                            <textarea name="message" id="message" placeholder="Write Message*"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <button type="submit" class="theme-btn">
                            SEND YOUR MEASSAGE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>