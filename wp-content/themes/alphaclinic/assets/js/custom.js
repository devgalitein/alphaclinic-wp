jQuery(document).ready(function ($) {
    $(".slider").slick({
        autoplay: true,
        autoplaySpeed: 6000,
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

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    var pid = getUrlParameter('pid');
    if (pid) {
        news_ajax(pid);
    }

    $( "body" ).on( "click", ".news-sub-section", function() {
       var newsID = $(this).data('post-id');
       news_ajax(newsID);
    });

    function news_ajax(newsID){
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
                $('html, body').animate({
                    scrollTop: $("#aktuelles").offset().top
                }, 100);
            }
        });
    }

    $('.cf-message').on('input', function(){
        if ( $(this).val().length > 0 ) {
            $('.contact-textarea label').css("opacity", "0");
        } else {
            $('.contact-textarea label').css("opacity", "1");
        }
    });

    $(".box-img").on('mouseenter', function () {
        $(this).next('div').addClass("team-hover");
    }).mouseleave(function() {
        $(this).next('div').removeClass("team-hover");
    });

    if (window.matchMedia("(max-width: 1180px)").matches) {
        $('.main-hotspot-part').on('click', function () {
            var hotspot = $(this).data('hotspot');
            jQuery('#' + hotspot).show();
            $('body').addClass("joint-popup-open")
        });
        $('.close-joint').on('click', function () {
            var hotspot = $(this).data('hotspot');
            jQuery('#' + hotspot).hide();
            $('body').removeClass("joint-popup-open")
        })
    }
});
window.addEventListener("message",function(t){var e=t.data["od-widget-id"],d=t.data["od-widget-height"],a=t.data["od-widget-ios"];if(e){var i=document.getElementById("od-widget-"+e);d&&(i.style.height=d+"px"),!0===a&&(i.style.width="100px",i.style["min-width"]="100%",i.scrolling="no")}}),window.addEventListener("load",function(t){for(var e=document.querySelectorAll("iframe.od-widget"),d=0;d<e.length;d++){var a=e[d];a.dataset&&a.dataset.src&&(a.src=a.dataset.src)}});

