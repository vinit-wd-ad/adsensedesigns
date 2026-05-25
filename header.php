<?php
function render_header($title = "Default Title", $description = "Default description", $meta_tags = [],  $link_tags = [])
{
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo htmlspecialchars($title); ?></title>
        <meta name="description" content="<?php echo htmlspecialchars($description); ?>" />
        <?php
        // Additional meta tags (array of name => content)
        foreach ($meta_tags as $name => $content) {
            echo '<meta name="' . htmlspecialchars($name) . '" content="' . htmlspecialchars($content) . '">' . "\n\t\t";
        }
        // Output optional link tags
        foreach ($link_tags as $rel => $href) {
            echo '<link rel="' . htmlspecialchars($rel) . '" href="' . htmlspecialchars($href) . '">' . "\n";
        }
        ?>
        <meta name="msvalidate.01" content="8BA2DD0F6A3775417E8A3BBF05F9D014" />

        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="assets/img/logo/s-logo.png">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<< Font Awesome.css >>-->
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--<< Magnific Popup.css >>-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--<< MeanMenu.css >>-->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--<< Nice Select.css >>-->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/custom.css?v=1.01.01">
        <!--<< Style.css >>-->
        <link rel="stylesheet" href="assets/css/style.css">


    </head>

    <body>

        <!-- Preloader Start -->
        <div id="preloader" class="preloader">
            <div class="animation-preloader">
                <div class="spinner">
                </div>
                <div class="txt-loading">
                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>
                    <span data-text-preloader="D" class="letters-loading">
                        D
                    </span>
                    <span data-text-preloader="S" class="letters-loading">
                        S
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="N" class="letters-loading">
                        N
                    </span>
                    <span data-text-preloader="S" class="letters-loading">
                        S
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                </div>
                <p class="text-center">...........</p>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--<< Mouse Cursor Start >>-->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

        <!-- Offcanvas Area Start -->
        <div class="fix-area">
            <div class="offcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="offcanvas__content">
                        <div class="offcanvas__top mb-3 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.jpeg" alt="logo-img">
                                </a>
                            </div>
                            <div class="offcanvas__close">
                                <button>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mobile-menu fix mb-3"></div>
                        <div class="offcanvas__contact">
                            <h4>Contact Info</h4>
                            <ul>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="mailto:info@example.com"><span>info@example.com</span></a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-clock"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a target="_blank" href="#">Mod-friday, 09am -05pm</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="far fa-phone"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="tel:+11002345909">+11002345909</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="header-button mt-4">
                                <a href="contact.html" class="theme-btn text-center">
                                    Contact Us
                                </a>
                            </div>
                            <div class="social-icon d-flex align-items-center">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas__overlay"></div>

        <!-- Header Area Start -->
        <header>
            <div class="header-top">
                <div class="container-fluid">
                    <div class="header-top-wrapper">
                        <ul>
                            <li>
                                <i class="fal fa-map-marker-alt me-2"></i>
                                201-A, Jaina Tower-II, District Centre, Janak Puri, New Delhi 110058
                            </li>
                            <li>
                                <i class="fal fa-envelope me-2"></i>
                                <a href="mailto:info@example.com"><span>info@adsensedesigns.com</span></a>
                            </li>
                        </ul>
                        <div class="social-icon d-flex align-items-center">
                            <span class="me-3">Follow us:</span>
                            <a href="#"><i class="fab fa-facebook-f me-3"></i></a>
                            <a href="#"><i class="fab fa-twitter me-3"></i></a>
                            <a href="#"><i class="fab fa-youtube me-3"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-sticky" class="header-1">
                <div class="container-fluid">
                    <div class="mega-menu-wrapper">
                        <div class="header-main">
                            <div class="logo">
                                <a href="./" class="header-logo">
                                    <img src="assets/img/logo/logo2.svg" alt="logo-img">
                                </a>
                                <a href="./" class="header-logo-2">
                                    <img src="assets/img/logo/logo1.png" alt="logo-img">
                                </a>
                            </div>
                            <div class="header-left">
                                <div class="mean__menu-wrapper d-none d-lg-block">
                                    <div class="main-menu">
                                        <nav id="mobile-menu">
                                            <ul>
                                                <li class="active">
                                                    <a href="./">
                                                        Home
                                                    </a>
                                                </li>

                                                <li>
                                                    <a>About Us
                                                        <i class="fas fa-angle-down"></i>
                                                    </a>
                                                    <ul class="submenu">
                                                        <li><a href="about">Who We Are</a></li>
                                                        <li><a href="what-we-do">What We Do</a></li>
                                                        <li><a href="why-us">Why Choose Us</a></li>
                                                        <li><a href="testimonial">Testimonial</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="services">
                                                        Services
                                                        <i class="fas fa-angle-down"></i>
                                                    </a>
                                                    <ul class="submenu">
                                                        <li><a href="service-details">GRAPHICS DESIGN</a></li>
                                                        <li><a href="service-details">MOTION GRAPHICS</a></li>
                                                        <li><a href="service-details">DIGITAL MARKETING</a></li>
                                                        <li><a href="service-details">MARKETING SOLUTION</a></li>
                                                        <li><a href="service-details">EXHIBITIONS</a></li>
                                                        <li><a href="service-details">INTERIORS</a></li>
                                                        <li><a href="service-details">PRINT SOLUTIONS</a></li>
                                                        <li><a href="service-details">CORPRORATE GIFTING</a></li>
                                                        <li><a href="service-details">INDOOR & DOOR BRANDING</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="case-studies">
                                                        Case Studies
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blogs">
                                                        Blogs
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="contact">Contact Us</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="header-right d-flex justify-content-end align-items-center">
                                <a href="#0" class="search-trigger search-icon"><i class="fal fa-search"></i></a>
                                <!-- <a href="shop-cart.html" class="cart-icon"><i class="far fa-shopping-cart"></i></a> -->
                                <div class="header__hamburger d-lg-none my-auto">
                                    <div class="sidebar__toggle">
                                        <i class="far fa-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Search Area Start -->
        <div class="search-wrap">
            <div class="search-inner">
                <i class="fas fa-times search-close" id="search-close"></i>
                <div class="search-cell">
                    <form method="get">
                        <div class="search-field-holder">
                            <input type="search" class="main-search-input" placeholder="Search...">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
}
    ?>