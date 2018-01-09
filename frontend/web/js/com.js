jQuery(document).ready(function ($) {
    "use strict";



    $('#slider-to-main-form').click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $(".main-form__serction").offset().top - 60
        }, 1400);
    })





    $('.price-list').click(function () {

        if(!$(this).hasClass('done')){
            $(this).addClass('done').next('.ul-accordion').slideDown(400);
        } else {
            $(this).removeClass('done').next('.ul-accordion').slideUp(400);
        }
    })



    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });


    "use strict";
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function () {
        ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0,
        }, scroll_top_duration);
    });

    //--------------------------------------------------//
    // Sticky Header Script
    //--------------------------------------------------//
    var doc_width = $(document).width();
    if (doc_width > 767) /* Above this width the menu will display in dropdown on mouse over - default display for big screen*/ {
        $('#nav').affix({
            offset: {
                top: $('header').height()
            }
        });
        $('#nav').on('affix-top.bs.affix', function () {
            $('#nav + .container').css('margin-top', 0);
        });
    }
    //--------------------------------------------------//
    // Back to TOP Script
    //--------------------------------------------------//

    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function () {
        ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if ($(this).scrollTop() > offset_opacity) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0,
        }, scroll_top_duration);
    });

    if ($('#tp-thumbnail-slide').hasClass('tp-thumbnail-slide')) {
        "use strict";
        jQuery("#tp-thumbnail-slide").owlCarousel({
            nav: false, // Show next and prev buttons
            slideSpeed: 900,
            autoplay: true,
            loop: true,
            items: 3,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            },
        });
    }

    if ($(".tp-accordion").hasClass("check-accordion")) {
        var $active = $('.tp-accordion .panel-collapse.in').prev().addClass('active');
        $active.find('a').prepend('<i class="glyphicon glyphicon-minus sign"></i>');
        $('.tp-accordion .panel-heading').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus sign"></i>');
        $('.tp-accordion').on('show.bs.collapse', function (e) {
            $('.tp-accordion .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
            $(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        })
    }

    if ($(".post").hasClass("format-gallery")) {
        jQuery("#owl-gallery").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 1,
            autoplay: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            },
        });
    }

    if ($('.owl-controls').hasClass('tp-gallery-box')) {
        jQuery(".tp-gallery-box").owlCarousel({
            nav: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            autoHeight: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            autoPlay: 4000,
            items: 1,
            autoplay: true,
            dots: false,
            loop: true,
        });
    }
    if ($('.owl-carousel').hasClass('tp-testimonial-box')) {
        "use strict";
        jQuery(".tp-testimonial-box").owlCarousel({
            nav: false, // Show next and prev buttons
            slideSpeed: 1200,
            autoplay: true,
            loop: true,
            items: 1,
        });
    }
    if ($('.owl-carousel').hasClass('tp-testimonial-two')) {
        "use strict";
        jQuery(".tp-testimonial-two").owlCarousel({
            nav: false, // Show next and prev buttons
            slideSpeed: 1200,
            autoplay: true,
            loop: true,
            items: 2,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            },
        });
    }


    if ($('.owl-carousel').hasClass('tab-treatment')) {
        "use strict"
        jQuery(".tab-treatment").owlCarousel({
            nav: false, // Show next and prev buttons
            slideSpeed: 300,
            items: 1,
            autoplay: true,
        });
    }
    //Call Full width for patten bg
    call_fullwidth();

    jQuery(".tabs-left li a").on("click", function () {

        var target = $(this).attr("href");

        jQuery(".tab-pane").hide();
        jQuery(target).show();

        var carousel = $(target + ' .tab-treatment').data('owlCarousel');
        carousel._width = $(target + ' .tab-treatment').width();
        carousel.invalidate('width');
        carousel.refresh();

    });

});

///////// set full width of screen
function call_fullwidth() {
    if ($("div").hasClass('pattern1')) {
        var side_padding = (($(document).width() - $(".pattern1").width()) / 2);

        $(".pattern1").css({paddingLeft: side_padding + "px", paddingRight: side_padding + "px"});
        $(".pattern1").css({marginLeft: "-" + side_padding + "px", marginRight: "-" + side_padding + "px"});
    }
}

jQuery(window).resize(function () {
    call_fullwidth();
});

(function ($) {

    $.fn.menumaker = function (options) {

        var cssmenu = $(this),
            settings = $.extend({
                title: "Menu",
                format: "dropdown",
                sticky: false
            }, options);

        return this.each(function () {
            cssmenu.prepend('<div id="menu-button"></div>');
            $(this).find("#menu-button").on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.hide().removeClass('open');
                } else {
                    mainmenu.show().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });

            cssmenu.find('li ul').parent().addClass('has-sub');

            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function () {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open').hide();
                    } else {
                        $(this).siblings('ul').addClass('open').show();
                    }
                });
            };

            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');

            if (settings.sticky === true) cssmenu.css('position', 'fixed');

            resizeFix = function () {
                if ($(window).width() > 768) {
                    cssmenu.find('ul').show();
                }

                if ($(window).width() <= 768) {
                    cssmenu.find('ul').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);

        });
    };
})(jQuery);

(function ($) {
    $(document).ready(function () {

        $("#navigation").menumaker({
            title: "Menu",
            format: "multitoggle"
        });


        $('.step_1').addClass('step_active done');


        if ($('.owl-carousel').hasClass('owl_clinic')) {
            jQuery(".owl_clinic").owlCarousel({
                nav: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                autoHeight: true,
                navText: ["<i class='clinic__arrow fa fa-angle-left'></i>", "<i class='clinic__arrow fa fa-angle-right'></i>"],
                autoPlay: 4000,
                items: 1,
                autoplay: true,
                dots: false,
                loop: true,
            });
        }


    });


    if ($(window).width() <= 1200 && $(window).width() >= 768) {
        $('.step .circle').circleProgress({
            value: 1,
            size: 121,
            thickness: 2,
            fill: {
                color: '#2aa9e0'
            }
        });
    }
    if ($(window).width() <= 768) {
        $('.step .circle').circleProgress({
            value: 1,
            size: 90,
            thickness: 2,
            fill: {
                color: '#2aa9e0'
            }
        });
        $('.l-chart__bar_now').addClass('l-chart__bar_now_active');
        $('.l-chart__bar_now .l-chart__h2').addClass('l-chart__h2_active')
        $('.l-chart ').addClass('done');
    }
    if ($(window).width() >= 1200) {
        $('.step_1 .circle').circleProgress({
            value: 1,
            size: 121,
            thickness: 2,
            startAngle: -Math.PI/2,
            fill: {
                color: '#2aa9e0'
            }
        });
    }
})(jQuery);


$.fn.extend({
    inViewport: function () {
        var top_of_element = $(this).offset().top;
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_screen = $(window).scrollTop() + $(window).height();
        var top_of_screen = $(window).scrollTop();

        if ((bottom_of_screen > top_of_element) &&
            (top_of_screen < bottom_of_element)) {
            return true;
        }
        return false;
    }
})


window.check = 1;
window.onscroll = function () {

    if ($(window).width() >= 1200) {
        if (window.pageYOffset >= $(window).height() + 200 && $('.l-chart ').hasClass('done') != true) {
            console.log('I find u - 2');

            $('.l-chart__bar_now').addClass('l-chart__bar_now_active');
            $('.l-chart__bar_now .l-chart__h2').addClass('l-chart__h2_active')
            $('.l-chart ').addClass('done');
        }

        var scrolled = window.pageYOffset;
        var getscroll = scrolled;

        if (window.pageYOffset >= 290 && check == 1) {
            $('.step_2 .circle').circleProgress({
                value: 1,
                size: 121,
                thickness: 2,
                startAngle: -Math.PI/2,
                fill: {
                    color: '#2aa9e0'
                }
            });

            $('.step_2').addClass('step_active done');
            check++;
        }
        if (window.pageYOffset >= 890 && check == 2) {
            $('.step_3 .circle').circleProgress({
                value: 1,
                size: 121,
                thickness: 2,
                startAngle: -Math.PI/2,
                fill: {
                    color: '#2aa9e0'
                }
            });

            $('.step_3').addClass('step_active done');
            check++;
        }
        if (window.pageYOffset >= 1450 && check == 3) {
            $('.step_4 .circle').circleProgress({
                value: 1,
                size: 121,
                thickness: 2,
                startAngle: -Math.PI/2,
                fill: {
                    color: '#2aa9e0'
                }
            });

            $('.step_4').addClass('step_active done');
            check++;
        }
        if (window.pageYOffset >= 2100 && check == 4) {
            $('.step_5 .circle').circleProgress({
                value: 1,
                size: 121,
                thickness: 2,
                startAngle: -Math.PI/2,
                fill: {
                    color: '#2aa9e0'
                }
            });

            $('.step_5').addClass('step_active done');
            check++;
        }

        if (window.pageYOffset >= 2450 && check == 5) {

            $('#step-form').addClass('step-form_active done');
            check++;
        }
    }

}