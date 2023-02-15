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
    });

    // menu trigger
    function menuTrigger() {
        const trigger = $('.hamburger')
        if (!trigger.length) return
        $('.hamburger').on('click', function() {
            $('body').toggleClass('body--static')
            $('.menu-dropdown').toggleClass('menu-dropdown--active')
            $(this).toggleClass('open')
            var menuActive = jQuery(this).hasClass('open');
            if (menuActive) {
                $('.menu-open').css("display", "none");
                $('.menu-close').css("display", "block");
            } else {
                $('.menu-open').css("display", "block");
                $('.menu-close').css("display", "none");
            }
        })
    }
    menuTrigger();

    $( "body" ).on( "click", ".news-sub-section", function() {
       var newsID = $(this).data('post-id');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action': 'load_first_news',
                'newsID': newsID
            },
            success: function(data) {
                $(".aktuelles-detials-title").html(data.html);
            }
        });
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action': 'load_other_news',
                'newsID': newsID
            },
            success: function(data) {
                $(".aktuelles-detials-box").html(data.html);
            }
        });
    });

});

