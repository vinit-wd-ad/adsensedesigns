<!-- Footer Section Start -->
<footer class="footer-section style-2 fix bg-cover" style="background-image: url('assets/img/footer-bg.jpg');">
    <div class="container">
        <div class="footer-widgets-wrapper">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="./">
                                <img src="assets/img/logo/logo2.svg" alt="logo-img">
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>
                                201-A, Jaina Tower-II, District Centre,<br> Janak Puri, New Delhi 110058
                            </p>
                            <h6><a href="#"> 011-40044653</a></h6>
                            <h6><a href="#">info@adsensedesigns.com</a></h6>
                            <div class="social-icon d-flex align-items-center">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="active"><i class="fab fa-vimeo-v"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
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
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Case Studies</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 ps-lg-5 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Services</h3>
                        </div>
                        <ul class="list-area">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Graphics Design</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Motion Graphics</a></li>
                            <li><a href="services">view all <span style='font-size:22px;color:brown'>&#8594;</span></a></li>
                            <!-- <li><a href="#">Marketing Solution</a></li>
                            <li><a href="#">Exhibitions</a></li>
                            <li><a href="#">Interiors</a></li>
                            <li><a href="#">Print Solutions</a></li>
                            <li><a href="#">Corprorate Gifting</a></li>
                            <li><a href="#">Indoor & Door Branding</a></li> -->
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
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!--<< Viewport Js >>-->
<script src="assets/js/viewport.jquery.js"></script>
<!--<< Bootstrap Js >>-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--<< Nice Select Js >>-->
<!-- <script src="assets/js/jquery.nice-select.min.js"></script> -->
<!--<< Waypoints Js >>-->
<script src="assets/js/jquery.waypoints.js"></script>
<!--<< Counterup Js >>-->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--<< Swiper Slider Js >>-->
<script src="assets/js/swiper-bundle.min.js"></script>
<!--<< MeanMenu Js >>-->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!--<< Magnific Popup Js >>-->
<!-- <script src="assets/js/jquery.magnific-popup.min.js"></script> -->
<!--<< Wow Animation Js >>-->
<script src="assets/js/wow.min.js"></script>
<!--<< Circle Progress Js >>-->
<!-- <script src="assets/js/circle-progress.js"></script> -->
<!--<< Main.js >>-->
<script src="assets/js/main.js"></script>
<!--<< Custom.js >>-->
<script src="assets/js/custom.js"></script>

<!-- Lenis CDN -->
<script src="assets/js/lenis.min.js"></script>

<script>
    window.addEventListener('load', function() {

        const lenis = new Lenis({
            duration: 1.2,
            smoothWheel: true,
            smoothTouch: false
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);

    });
</script>

</body>

</html>