/* ===================================================================

* ================================================================= */

window.addEventListener('load', function () {

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
function loader() {
    window.addEventListener('load', function () {

        const preloader = document.querySelector('.preloader');

        preloader.classList.add('loaded');

        setTimeout(() => {
            preloader.style.transition = 'opacity 0.1s ease';
            preloader.style.opacity = '0';

            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);

        }, 600);

    });
}

loader();

document.addEventListener("DOMContentLoaded", function () {
    // --- 1. CONFIGURATION ---
    const ICON_OPEN = 'fal fa-plus';
    const ICON_CLOSE = 'fal fa-minus';

    // --- 2. MOBILE MENU CLONING & TOGGLE LOGIC ---
    const mainMenu = document.querySelector('#mobile-menu > ul');
    const mobileMenuContainer = document.querySelector('.mobile-menu');

    if (mainMenu && mobileMenuContainer) {
        mobileMenuContainer.innerHTML = '';
        mobileMenuContainer.appendChild(mainMenu.cloneNode(true));

        const mobileItems = mobileMenuContainer.querySelectorAll('li');

        mobileItems.forEach(item => {
            const submenu = item.querySelector(':scope > .submenu');
            const link = item.querySelector(':scope > a');

            if (submenu && link) {
                const arrow = link.querySelector('i');

                // Initial Icon Setup
                if (arrow) {
                    arrow.className = ICON_OPEN;
                }

                // for Smooth transition 
                submenu.style.maxHeight = '0px';
                submenu.style.overflow = 'hidden';
                submenu.style.display = 'block';

                link.style.cursor = 'pointer';

                // Click Event Listener
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    item.classList.toggle('submenu-open');

                    if (item.classList.contains('submenu-open')) {
                        // Submenu open karein (Dynamic Height)
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        if (arrow) arrow.className = ICON_CLOSE;
                    } else {
                        // Submenu close karein
                        submenu.style.maxHeight = '0px';
                        if (arrow) arrow.className = ICON_OPEN;
                    }
                });
            }
        });
    }

    // --- 3. SIDEBAR OPEN / CLOSE LOGIC ---
    const openBtn = document.querySelector('.sidebar__toggle');
    const closeBtn = document.querySelector('.offcanvas__close button');
    const offcanvas = document.querySelector('.offcanvas__info');
    const overlay = document.querySelector('.offcanvas__overlay');

    if (openBtn && offcanvas && overlay) {
        openBtn.addEventListener('click', function () {
            offcanvas.classList.add('active');
            overlay.classList.add('active');
        });
    }

    if (closeBtn && offcanvas && overlay) {
        closeBtn.addEventListener('click', function () {
            offcanvas.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    if (overlay && offcanvas) {
        overlay.addEventListener('click', function () {
            offcanvas.classList.remove('active');
            overlay.classList.remove('active');
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {

    //>> Sidebar Toggle JS Start <<//
    document.querySelectorAll(".offcanvas__close, .offcanvas__overlay").forEach(el => {
        el.addEventListener("click", function () {
            document.querySelectorAll(".offcanvas__info").forEach(info => info.classList.remove("info-open"));
            document.querySelectorAll(".offcanvas__overlay").forEach(overlay => overlay.classList.remove("overlay-open"));
        });
    });

    document.querySelectorAll(".sidebar__toggle").forEach(el => {
        el.addEventListener("click", function () {
            document.querySelectorAll(".offcanvas__info").forEach(info => info.classList.add("info-open"));
            document.querySelectorAll(".offcanvas__overlay").forEach(overlay => overlay.classList.add("overlay-open"));
        });
    });

    //>> Body Overlay JS Start <<//
    document.querySelectorAll(".body-overlay").forEach(el => {
        el.addEventListener("click", function () {
            document.querySelectorAll(".offcanvas__area").forEach(area => area.classList.remove("offcanvas-opened"));
            document.querySelectorAll(".df-search-area").forEach(search => search.classList.remove("opened"));
            document.querySelectorAll(".body-overlay").forEach(overlay => overlay.classList.remove("opened"));
        });
    });

    //>> Sticky Header JS Start <<//
    window.addEventListener("scroll", function () {
        const headerSticky = document.getElementById("header-sticky");
        if (headerSticky) {
            if (window.scrollY > 250) {
                headerSticky.classList.add("sticky");
            } else {
                headerSticky.classList.remove("sticky");
            }
        }
    });

    // Swiper Animation Helper Function (Vanilla Version)
    function animated_swiper(selector, initInstance) {
        const animated = function () {
            document.querySelectorAll(`${selector} [data-animation]`).forEach(el => {
                let anim = el.getAttribute("data-animation");
                let delay = el.getAttribute("data-delay");
                let duration = el.getAttribute("data-duration");

                el.classList.remove("anim" + anim);
                el.classList.add(anim, "animated");

                el.style.webkitAnimationDelay = delay;
                el.style.animationDelay = delay;
                el.style.webkitAnimationDuration = duration;
                el.style.animationDuration = duration;

                const handleAnimEnd = function () {
                    el.classList.remove(anim, "animated");
                    el.removeEventListener("animationend", handleAnimEnd);
                };
                el.addEventListener("animationend", handleAnimEnd);
            });
        };

        animated();

        initInstance.on("slideChange", function () {
            document.querySelectorAll(`${selector} [data-animation]`).forEach(el => {
                el.classList.remove("animated");
            });
        });
        initInstance.on("slideChange", animated);
    }

    //>> Hero-1 Slider Start <<//
    const sliderActive2 = ".hero-slider";
    if (document.querySelector(sliderActive2)) {
        const sliderInit2 = new Swiper(sliderActive2, {
            loop: true,
            slidesPerView: 1,
            effect: "fade",
            speed: 3000,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });
        animated_swiper(sliderActive2, sliderInit2);
    }
    //>> Banner Animation <<//

    //>> Hero-2 Slider Start <<//
    const sliderActive1 = ".hero-slider-2";
    if (document.querySelector(sliderActive1)) {
        const sliderInit1 = new Swiper(sliderActive1, {
            loop: true,
            slidesPerView: 1,
            direction: "vertical",
            speed: 2000,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot-2",
                clickable: true,
            },
        });
        animated_swiper(sliderActive1, sliderInit1);
    }
    // Content animation when active starts here

    //>> Hero-3 Slider Start <<//
    const sliderActive3 = ".hero-slider-3";
    if (document.querySelector(sliderActive3)) {
        const sliderInit3 = new Swiper(sliderActive3, {
            loop: true,
            slidesPerView: 1,
            effect: "fade",
            speed: 2000,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });
        animated_swiper(sliderActive3, sliderInit3);
    }
    // Content animation when active starts here


    //>> Video Popup Start <<//
    // Note: MagnificPopup is a jQuery plugin and requires access to the jQuery object for initialization.
    if (typeof jQuery !== 'undefined') {
        $(".img-popup").magnificPopup({
            type: "image",
            gallery: { enabled: true },
        });

        $('.video-popup').magnificPopup({
            type: 'iframe',
        });

        //>> Counterup Start <<//
        $(".count").counterUp({
            delay: 15,
            time: 4000,
        });

        //>> Nice Select Start <<//
        $('select').niceSelect();
    }

    //>> Wow Animation Start <<//
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }

    //>> Scroll JS Start <<//
    const scrollPath = document.querySelector(".scroll-up path");
    if (scrollPath) {
        const pathLength = scrollPath.getTotalLength();
        scrollPath.style.transition = scrollPath.style.WebkitTransition = "none";
        scrollPath.style.strokeDasharray = pathLength + " " + pathLength;
        scrollPath.style.strokeDashoffset = pathLength;
        scrollPath.getBoundingClientRect();
        scrollPath.style.transition = scrollPath.style.WebkitTransition = "stroke-dashoffset 10ms linear";

        const updatescroll = function () {
            let scrolltotal = window.scrollY;
            let height = document.documentElement.scrollHeight - window.innerHeight;
            let scrolltotalheight = pathLength - (scrolltotal * pathLength) / height;
            scrollPath.style.strokeDashoffset = scrolltotalheight;
        };
        updatescroll();

        window.addEventListener("scroll", updatescroll);
        const offset = 50;
        const duration = 950;

        window.addEventListener("scroll", function () {
            const scrollUp = document.querySelector(".scroll-up");
            if (scrollUp) {
                if (window.scrollY > offset) {
                    scrollUp.classList.add("active-scroll");
                } else {
                    scrollUp.classList.remove("active-scroll");
                }
            }
        });

        const scrollUpBtn = document.querySelector(".scroll-up");
        if (scrollUpBtn) {
            scrollUpBtn.addEventListener("click", function (event) {
                event.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" // Smooth scrolling feature is natively built-in standard CSS/JS
                });
            });
        }
    }

    //>> Search Popup Start <<//
    const searchWrap = document.querySelector(".search-wrap");
    const navSearch = document.querySelector(".nav-search");
    const searchClose = document.getElementById("search-close");
    const searchCloses = document.querySelectorAll(".search-close");

    document.querySelectorAll(".search-trigger").forEach(el => {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            if (searchWrap) {
                searchWrap.style.display = (searchWrap.style.display === 'none' || searchWrap.style.display === '') ? 'block' : 'none';
            }
            if (navSearch) navSearch.classList.add("open");
            if (searchClose) searchClose.classList.add("open");
        });
    });

    searchCloses.forEach(el => {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            if (searchWrap) searchWrap.style.display = 'none';
            if (navSearch) navSearch.classList.remove("open");
            if (searchClose) searchClose.classList.remove("open");
        });
    });

    function closeSearch() {
        if (searchWrap) searchWrap.style.display = 'none';
        if (navSearch) navSearch.classList.remove("open");
        if (searchClose) searchClose.classList.remove("open");
    }

    document.body.addEventListener("click", function () {
        closeSearch();
    });

    document.querySelectorAll(".search-trigger, .main-search-input").forEach(el => {
        el.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    });

    //>> Brand Slider Start <<//
    if (document.querySelector('.brand-slider')) {
        new Swiper(".brand-slider", {
            spaceBetween: 30,
            speed: 1000,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                1399: { slidesPerView: 5 },
                1199: { slidesPerView: 3 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 1 },
                0: { slidesPerView: 1 },
            },
        });
    }

    if (document.querySelector('.brand-slider-2')) {
        new Swiper(".brand-slider-2", {
            spaceBetween: 30,
            speed: 1000,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                1199: { slidesPerView: 7 },
                991: { slidesPerView: 6 },
                767: { slidesPerView: 5 },
                575: { slidesPerView: 3 },
                0: { slidesPerView: 1 },
            },
        });
    }

    //>> News Slider Start <<//
    if (document.querySelector('.news-slider')) {
        new Swiper(".news-slider", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1199: { slidesPerView: 3 },
                991: { slidesPerView: 2 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 1 },
                0: { slidesPerView: 1 },
            },
        });
    }

    //>> Project Slider Start <<//
    if (document.querySelector('.project-slider')) {
        new Swiper(".project-slider", {
            spaceBetween: 5,
            speed: 1500,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1199: { slidesPerView: 4 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 1 },
                0: { slidesPerView: 1 },
            },
        });
    }

    if (document.querySelector('.project-slider-2')) {
        new Swiper(".project-slider-2", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1199: { slidesPerView: 4 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 1 },
                0: { slidesPerView: 1 },
            },
        });
    }

    if (document.querySelector('.project-slider-3')) {
        new Swiper(".project-slider-3", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1199: { slidesPerView: 4 },
                991: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 2 },
                0: { slidesPerView: 1 },
            },
        });
    }

    //>> Testimonial Slider Start <<//
    if (document.querySelector('.testimonial-slider')) {
        new Swiper(".testimonial-slider", {
            spaceBetween: 1,
            speed: 2000,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                1199: { slidesPerView: 2 },
                991: { slidesPerView: 2 },
                767: { slidesPerView: 2 },
                575: { slidesPerView: 1 },
                0: { slidesPerView: 1 },
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });
    }

    //>> Quantity JS Start <<//
    document.querySelectorAll(".quantity").forEach(qtyContainer => {
        qtyContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("plus")) {
                let input = e.target.previousElementSibling;
                if (input && input.classList.contains("qty")) {
                    let val = parseInt(input.value, 10) || 0;
                    input.value = val + 1;
                    input.dispatchEvent(new Event('change'));
                }
            }
            if (e.target.classList.contains("minus")) {
                let input = e.target.nextElementSibling;
                if (input && input.classList.contains("qty")) {
                    let val = parseInt(input.value, 10) || 0;
                    if (val > 0) {
                        input.value = val - 1;
                        input.dispatchEvent(new Event('change'));
                    }
                }
            }
        });
    });

    //>> Quantity Cart JS Start <<//
    let quantity = 0;
    let price = 0;

    const updateCartDOM = (qty) => {
        document.querySelectorAll(".cart-item-quantity-amount, .product-quant").forEach(el => el.innerHTML = qty);
        let basePriceEl = document.querySelector(".base-price, .base-pri");
        let basePrice = basePriceEl ? parseFloat(basePriceEl.textContent) : 0;
        document.querySelectorAll(".total-price, .product-pri").forEach(el => el.innerHTML = (basePrice * qty).toFixed(2));
    };

    updateCartDOM(quantity);

    document.querySelectorAll(".cart-increment, .cart-incre").forEach(el => {
        el.addEventListener("click", function () {
            if (quantity <= 4) {
                quantity++;
                updateCartDOM(quantity);
            }
        });
    });

    document.querySelectorAll(".cart-decrement, .cart-decre").forEach(el => {
        el.addEventListener("click", function () {
            if (quantity >= 1) {
                quantity--;
                updateCartDOM(quantity);
            }
        });
    });

    document.querySelectorAll(".cart-item-remove>a").forEach(el => {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            let cartItem = this.closest(".cart-item");
            if (cartItem) {
                cartItem.style.transition = "all 0.3s ease";
                cartItem.style.opacity = "0";
                setTimeout(() => cartItem.style.display = "none", 300);
            }
        });
    });

    //>> PaymentMethod JS Start <<//
    const getPaymentMethod = () => {
        let checkedInput = document.querySelector("input[name='pay-method']:checked");
        return checkedInput ? checkedInput.value : '';
    };

    document.querySelectorAll(".payment").forEach(el => el.innerHTML = getPaymentMethod());

    document.querySelectorAll(".checkout-radio-single").forEach(el => {
        el.addEventListener("click", function () {
            document.querySelectorAll(".payment").forEach(el => el.innerHTML = getPaymentMethod());
        });
    });

    // Circle Progress
    // Note: If this plugin has a standard jQuery dependency, it cannot be directly refactored without a pure JS alternative.
    if (typeof jQuery !== 'undefined' && jQuery.fn.loading) {
        $(".circle-bar").loading();
    }

    //>> Mouse Cursor Start <<//
    function mousecursor() {
        const e = document.querySelector(".cursor-inner"),
            t = document.querySelector(".cursor-outer");

        if (document.body && e && t) {
            let o = false;
            window.addEventListener("mousemove", function (s) {
                if (!o) {
                    t.style.transform = `translate(${s.clientX}px, ${s.clientY}px)`;
                }
                e.style.transform = `translate(${s.clientX}px, ${s.clientY}px)`;
            });

            document.body.addEventListener("mouseenter", function (s) {
                if (s.target.tagName === 'A' || s.target.classList.contains("cursor-pointer")) {
                    e.classList.add("cursor-hover");
                    t.classList.add("cursor-hover");
                }
            }, true);

            document.body.addEventListener("mouseleave", function (s) {
                if (s.target.tagName === 'A' || s.target.classList.contains("cursor-pointer")) {
                    if (!(s.target.tagName === 'A' && s.target.closest(".cursor-pointer"))) {
                        e.classList.remove("cursor-hover");
                        t.classList.remove("cursor-hover");
                    }
                }
            }, true);

            e.style.visibility = "visible";
            t.style.visibility = "visible";
        }
    }

    mousecursor();

}); // End Document Ready Function

/**
 * Initialize circle progress loading animation on targeted elements.
 * @param {string|NodeList|HTMLElement} selector - The element(s) to apply the loading animation to.
 */
function initCircleLoading(selector) {
    const DEFAULTS = {
        backgroundColor: '#b3cef6',
        progressColor: '#4b86db',
        percent: 75,
        duration: 2000
    };

    // Determine target elements based on the provided parameter type
    let targets;
    if (typeof selector === 'string') {
        targets = document.querySelectorAll(selector);
    } else if (selector instanceof NodeList) {
        targets = selector;
    } else if (selector instanceof HTMLElement) {
        targets = [selector];
    } else {
        return; // Exit if the selector is invalid
    }

    // Loop through each target element
    targets.forEach(target => {
        const colorData = target.getAttribute('data-color');
        const percentData = target.getAttribute('data-percent');
        const durationData = target.getAttribute('data-duration');

        // Extract options from data attributes or fallback to defaults
        const opts = {
            backgroundColor: colorData ? colorData.split(',')[0] : DEFAULTS.backgroundColor,
            progressColor: colorData ? colorData.split(',')[1] : DEFAULTS.progressColor,
            percent: percentData ? parseFloat(percentData) : DEFAULTS.percent,
            duration: durationData ? parseInt(durationData, 10) : DEFAULTS.duration
        };

        // Create and append the structure using template literals
        const template = `
            <div class="background"></div>
            <div class="rotate"></div>
            <div class="left"></div>
            <div class="right"></div>
            <div class=""><span>${opts.percent}%</span></div>
        `;
        target.insertAdjacentHTML('beforeend', template);

        // Apply custom dynamic styles to the created elements
        const backgroundEl = target.querySelector('.background');
        const leftEl = target.querySelector('.left');
        const rotateEl = target.querySelector('.rotate');
        const rightEl = target.querySelector('.right');

        if (backgroundEl) backgroundEl.style.backgroundColor = opts.backgroundColor;
        if (leftEl) leftEl.style.backgroundColor = opts.backgroundColor;
        if (rotateEl) rotateEl.style.backgroundColor = opts.progressColor;
        if (rightEl) rightEl.style.backgroundColor = opts.progressColor;

        // Trigger CSS transition dynamically
        if (rotateEl) {
            setTimeout(() => {
                rotateEl.style.transition = `transform ${opts.duration}ms linear`;
                rotateEl.style.transform = `rotate(${opts.percent * 3.6}deg)`;
            }, 1);
        }

        // Apply fallback step animations if percentage is greater than 50%
        if (opts.percent > 50) {
            let animationRight = `toggle ${(opts.duration / opts.percent * 50)}ms step-end`;
            let animationLeft = `toggle ${(opts.duration / opts.percent * 50)}ms step-start`;

            if (rightEl) {
                rightEl.style.animation = animationRight;
                rightEl.style.opacity = '1';
            }
            if (leftEl) {
                leftEl.style.animation = animationLeft;
                leftEl.style.opacity = '0';
            }
        }
    });
}