// Show currrent date 
const date = new Date();
var today = date.getFullYear();
$(".today-date").html(today);


// Fade Animation Custom start
$(window).scroll(function() {
    $(".animation .anm_mod").each(function() {
        const position = $(this).offset().top;
        const scroll = $(window).scrollTop();
        const windowHeight = $(window).height();
        if (scroll > position - windowHeight) {
            $(this).addClass("active");
        }
        if (scroll < 100) {
            $(this).removeClass("active");
        }
    });
});

$(function() {
    $('a[href^="#"]').click(function() {
        const speed = 800;
        const href = $(this).attr("href");
        const target = $(href == "#" || href == "" ? "html" : href);
        const position = target.offset().top;
        $("html, body").animate({
            scrollTop: position
        }, speed, "swing");
        return false;
    });
});

// Fade Animation Custom End

$(document).ready(function () {
    $('.anm_mod .content p').css({'text-transform' : 'capitalize'});
});