<!-- Footer Section Start -->
<footer class="footer-section style-2 fix bg-cover" style="background-image: url('<?= BASE_URL ?>assets/img/footer-bg.jpg');">
    <div class="container">
        <div class="footer-widgets-wrapper">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="<?= BASE_URL ?>">
                                <img src="<?= BASE_URL ?>assets/img/logo/logo2.svg" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>
                               <i class="fa-solid fa-location-dot"></i> 201-A, Jaina Tower-II, District Centre,<br> Janak Puri, New Delhi 110058
                            </p>
                            <h6><a href="#"><i class="fa-solid fa-phone"></i> 011-40044653</a></h6>
                            <h6><a href="#"><i class="fa-solid fa-envelope"></i> info@adsensedesigns.com</a></h6>
                            <div class="social-icon d-flex align-items-center">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Navigtion</h3>
                        </div>
                        <ul class="list-area">
                            <li><a href="<?= BASE_URL ?>about-us">About Us</a></li>
                            <li><a href="<?= BASE_URL ?>services">Services</a></li>
                            <li><a href="<?= BASE_URL ?>case-studies">Case Studies</a></li>
                            <li><a href="<?= BASE_URL ?>blogs">Blogs</a></li>
                            <li><a href="<?= BASE_URL ?>contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 ps-lg-5 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Services</h3>
                        </div>
                        <ul class="list-area">
                            <?php
                            $serHeader = empty($serHeader) ? [] : $serHeader;
                            $serCount = 1; 
                            foreach ($serHeader as $serviceH) {
                            ?>
                                <li><a href="<?= BASE_URL ?>service/<?= $serviceH['slug'] ?>"><?= ($serviceH['name']) ?></a></li>
                            <?php
                            if($serCount === 4) break;
                            $serCount ++;
                            }
                            ?>
                            <li><a href="services">view all <span style='font-size:22px;color:brown'>&#8594;</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".9s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Subscribe</h3>
                        </div>
                        <div class="footer-content">
                            <div class="footer-input">
                                <input type="email" placeholder="Subscribe our newsletter">
                                <button class="newsletter-button" type="submit">
                                    <i class="flaticon-send"></i>
                                </button>
                            </div>
                            <p>
                                The ultimate Webflow template for agencies <br>
                                startups, and small businesses.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wrapper">
                <p>
                    © <span class="today-date"></span> created by <a href="/" class="base-color">Adsense Designs Pvt. Ltd.</a>.
                </p>
                <p>All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

<!-- Back To Top Start -->
<div class="scroll-up">
    <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!--<< All JS Plugins >>-->
<!--<< Bootstrap Js >>-->
<script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
<!--<< Swiper Slider Js >>-->
<script src="<?= BASE_URL ?>assets/js/swiper-bundle.min.js"></script>
<!--<< Wow Animation Js >>-->
<script src="<?= BASE_URL ?>assets/js/wow.min.js"></script>
<!--<< Main.js >>-->
<script src="<?= BASE_URL ?>assets/js/lenis.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/main.js"></script>
<!--<< Custom.js >>-->
<script src="<?= BASE_URL ?>assets/js/custom.js"></script>

</body>

</html>