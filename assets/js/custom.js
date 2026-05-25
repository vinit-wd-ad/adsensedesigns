// Show current date 
const date = new Date();
var today = date.getFullYear();
document.querySelectorAll(".today-date").forEach(el => {
    el.innerHTML = today;
});


// Fade Animation Custom start

window.addEventListener("scroll", function () {
    document.querySelectorAll(".animation .anm_mod").forEach(el => {
        // Get element's bounding position relative to the viewport + current scroll
        const rect = el.getBoundingClientRect();
        const position = rect.top + window.scrollY;
        const scroll = window.scrollY;
        const windowHeight = window.innerHeight;

        // Check if the element has entered the viewport view range
        if (scroll > position - windowHeight) {
            el.classList.add("active");
        }

        // Reset animation state when scrolled close to the top
        if (scroll < 100) {
            el.classList.remove("active");
        }
    });
});

// Smooth Scroll for Anchors
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const href = this.getAttribute("href");
        // Fallback to html element if href is empty or just '#'
        const targetSelector = (href === "#" || href === "") ? "html" : href;
        const targetElement = document.querySelector(targetSelector);

        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    });
});
// Fade Animation Custom End

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.anm_mod .content p').forEach(el => {
        el.style.textTransform = 'capitalize';
    });
});
