jQuery(document).ready(function ($) {
    $(".slider").slick({
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        arrows: false,
        adaptiveHeight: true,
    });

    $(".joint-details-page-header .header-right-text ul li a").click(function(e) {
        var href = $(this).attr('href');
        if (href) {
            var body = $("html, body");
            body.stop().animate({scrollTop: jQuery(href).offset().top - 80}, 100, 'swing', function () {
            });
        }
    })

});

