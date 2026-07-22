;(function ($) {
    'use strict';
    $(document).ready(function () {
        let CHENG_SCROLL_TO_TOP = {
            init : function(){
                let base = this;
                base._scrollToTop();
            },
            _scrollToTop: function(){
                $(window).scroll(function() {
                    if ($(window).scrollTop() > 980) {
                        $('.back_to_top').fadeIn('slow');
                    } else {
                        $('.back_to_top').fadeOut('slow');
                    }
                });
            
                $('a[href^=#]:not([href=#]):not([role=tab]), .back_to_top').on('click', function(event) {
                    var $anchor = $(this);
                    $('html, body').stop().animate({
                        scrollTop: $($anchor.attr('href')).offset().top - 50
                    }, 1500);
                    event.preventDefault();
                });
            }
        }
        CHENG_SCROLL_TO_TOP.init();

        let CHENG_HEADER = {
            init: function () {
               
                let base = this;
                base._calculateHeaderSpacer();

                $(window).on('stt_on_resize', function () {
                    base._calculateHeaderSpacer();
                });

                base.initSticky();
                $(window).on('scroll', function () {
                    base.initSticky();
                });

                $('#header').on('mouseenter', function () {
                    $(this).addClass('on-hover');
                }).on('mouseleave', function () {
                    $(this).removeClass('on-hover');
                });
            },
            _calculateHeaderSpacer: function () {
                let base = this;

                let $spacer = $('#header-spacer'),
                    $header = $('#header');

                $spacer.css('height', $header.height());
            },
            
            initSticky: function () {
                let $header = $('#cheng-header.header-sticky');
                if ($header.length) {
                    let scroll_top = $(window).scrollTop();
                    if (scroll_top > 0 && $header.offset().top <= scroll_top) {
                        $header.addClass('is-sticky');
                    } else {
                        $header.removeClass('is-sticky');
                    }
                }
            }
        };
        CHENG_HEADER.init();
    });

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/eld_slide.default', function ($wrapper) {
            cheng_home_slider_element($wrapper);
        });
    });
    function cheng_home_slider_element($wrapper) {
        let $slider = $('.home-slider-element', $wrapper);

        let dotsClass = $slider.hasClass('home-slider') ? 'slick-dots container' : 'slick-dots';
        dotsClass += ' ' + $slider.attr('data-dot-class') || '';

        let options = {
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            nextArrow: '<i class="fa fa-chevron-right"></i>',
            prevArrow: '<i class="fa fa-chevron-left"></i>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: true,
                        dots: true,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: true,
                        dots: true,
                    }
                },
            ]
        }
        $slider.on('setPosition', function (event, $slick) {
            let $slider = $slick.$slider,
                is_main_slider = ($slider.attr('data-main-slider') == 1);
            if (is_main_slider) {
                let $header = $('#header:not(.is-transparent-header)');
                if ($header.length) {
                    let height = $(window).height() - $header.height();
                    let $adminbar = $('#wpadminbar');

                    if ($adminbar.length) {
                        height -= $adminbar.height();
                    }
                    $('.slide-item', $slider).height(height);
                }
            }
        });
        $slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            let $nextSlide = $(slick.$slides[nextSlide]),
                $slider = slick.$slider;
            if ($nextSlide.length) {
                let theme = $nextSlide.attr('data-theme') || 'light';
                if (theme === 'light') {
                    $('.slick-arrow', $slider).removeClass('btn-arrow-dark-screen');
                } else {
                    $('.slick-arrow', $slider).addClass('btn-arrow-dark-screen');
                }
            }
        });



        $slider.on('init', function (event, slick) {
            let $slides = slick.$slides;
            if ($slides.length) {
                let $currentSlide = $($slides.eq(slick.currentSlide));
                if ($currentSlide.length) {
                    let theme = $currentSlide.attr('data-theme') || 'light';
                    if (theme === 'light') {
                        $('.slick-arrow', $slider).removeClass('btn-arrow-dark-screen');
                    } else {
                        $('.slick-arrow', $slider).addClass('btn-arrow-dark-screen');
                    }
                }
            }
        });
        if (window.matchMedia("(max-width: 768px)").matches) {
            /* the viewport is less than 768 pixels wide */
            $slider.slick();
          } else {
            $slider.slick(options);
          }
       
    }
})
(jQuery);