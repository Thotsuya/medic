(function($) {

    "use strict";


    //Hide Loading Box (Preloader)
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }


    var navcollapse = $('.main-menu .navigation li');
    navcollapse.hover(function() {
        $(this).children('.submenu').stop(true, false, true).slideToggle(300);
    });
    //Submenu Dropdown Toggle
    if ($('.main-menu .mobile-menu li.dropdown ul').length) {
        $('.main-menu .mobile-menu li.dropdown').append('<div class="dropdown-btn"></div>');

        //Dropdown Button
        $('.main-menu .mobile-menu li.dropdown .dropdown-btn').on('click', function() {
            $(this).prev('ul').slideToggle(500);
        });
    }

    function stickyHeader() {
        if ($('.stricky').length) {
            var strickyScrollPos = 100;
            if ($(window).scrollTop() > strickyScrollPos) {
                $('.stricky').removeClass('fadeIn animated');
                $('.stricky').addClass('stricky-fixed fadeInDown animated');
                $('.scroll-to-top').fadeIn(500);
            } else if ($(this).scrollTop() <= strickyScrollPos) {
                $('.stricky').removeClass('stricky-fixed fadeInDown animated');
                $('.stricky').addClass('slideIn animated');
                $('.scroll-to-top').fadeOut(500);
            }
        };
    }



    //Mixitup Gallery
    if ($('.mixitup-gallery').length) {
        $('.mixitup-gallery').mixItUp({});
    }


    //Sortable Masonary with Filters
    function enableMasonry() {
        if ($('.sortable-masonry').length) {

            var winDow = $(window);
            // Needed variables
            var $container = $('.sortable-masonry .items-container');
            var $filter = $('.filter-btns');

            $container.isotope({
                filter: '*',
                masonry: {
                    columnWidth: 0
                },
                animationOptions: {
                    duration: 500,
                    easing: 'linear'
                }
            });


            // Isotope Filter
            $filter.find('li').on('click', function() {
                var selector = $(this).attr('data-filter');

                try {
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 500,
                            easing: 'linear',
                            queue: false
                        }
                    });
                } catch (err) {

                }
                return false;
            });


            winDow.bind('resize', function() {
                var selector = $filter.find('li.active').attr('data-filter');

                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear',
                        queue: false
                    }
                });
            });


            var filterItemA = $('.filter-btns li');

            filterItemA.on('click', function() {
                var $this = $(this);
                if (!$this.hasClass('active')) {
                    filterItemA.removeClass('active');
                    $this.addClass('active');
                }
            });
        }
    }

    enableMasonry();



    // Gallery masonary style
    if ($('.item-container').length) {
        $('.item-container').isotope({
            layoutMode: 'masonry'
        });
    }


    //Accordion Box
    if ($('.accordion-box').length) {
        $('.accordion-box .acc-btn').on('click', function() {
            if ($(this).hasClass('active') !== true) {
                $('.accordion-box .acc-btn').removeClass('active');
            }

            if ($(this).next('.acc-content').is(':visible')) {
                $(this).removeClass('active');
                $(this).next('.acc-content').slideUp(500);
            } else {
                $(this).addClass('active');
                $('.accordion-box .acc-content').slideUp(500);
                $(this).next('.acc-content').slideDown(500);
            }
        });
    }

    //Search Box Toggle
    if ($('.seach-toggle').length) {
        //Dropdown Button
        $('.seach-toggle').on('click', function() {
            $(this).toggleClass('active');
            $(this).next('.search-box').toggleClass('now-visible');
        });
    }


    // Scroll to a Specific Div
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function() {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }


    //testimonial Slider
    if ($('.testimonial-slider').length) {
        $('.testimonial-slider').owlCarousel({
            loop: true,
            margin: 75,
            nav: true,
            smartSpeed: 3000,
            autoplay: 4000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });
    }


    //Four Column Carousel Slider
    if ($('.four-column-carousel').length) {
        $('.four-column-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 2000,
            autoplay: 4000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 3
                },
                1070: {
                    items: 4
                }
            }
        });
    }


    //Three Column Carousel Slider
    if ($('.three-column-carousel').length) {
        $('.three-column-carousel').owlCarousel({
            loop: true,
            margin: 45,
            nav: true,
            smartSpeed: 3000,
            autoplay: 4000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                }
            }
        });
    }



    //Two Column Carousel Slider
    if ($('.two-column-carousel').length) {
        $('.two-column-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 500,
            autoplay: 4000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 2
                }
            }
        });
    }


    //Single Item Slider
    if ($('.single-item-carousel').length) {
        $('.single-item-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            smartSpeed: 700,
            autoplay: 4000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });
    }


    //Main Slider Carousel
    if ($('.main-slider-carousel').length) {
        $('.main-slider-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            animateOut: 'slideOutDown',
            animateIn: 'fadeIn',
            active: true,
            smartSpeed: 1000,
            autoplay: 5000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });
    }


    //Tabs Box
    if ($('.tabs-box').length) {

        //Tabs
        $('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {

            e.preventDefault();
            var target = $($(this).attr('data-tab'));

            target.parents('.tabs-box').find('.tab-buttons').children('.tab-btn').removeClass('active-btn');
            $(this).addClass('active-btn');
            target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
            target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
            $(target).fadeIn(300);
            $(target).addClass('active-tab');
        });

    }


    //Tabbed Floor Plans Function
    if ($('.tabbed-floor-plans .floor-btn').length) {

        //Floor Details Hide Show
        $('.tabbed-floor-plans .floor-btn').on('click', function(e) {
            e.preventDefault();
            var target = $($(this).attr('href'));
            $('.tabbed-floor-plans .floor-btn').removeClass('active');
            $(this).addClass('active');
            $('.tabbed-floor-plans .floor-details').removeClass('collapsed');
            $('.tabbed-floor-plans .floor-details ').fadeOut(0);
            $(target).fadeIn(300);
        });

    }

    //5.Search Toggle Btn
    if ($('.toggle-search').length) {
        $('.toggle-search').on('click', function() {
            $('.header-search').slideToggle(300);
        });

    }


    //Custom Seclect Box
    if ($('.custom-select-box').length) {
        $('.custom-select-box').selectmenu().selectmenu('menuWidget').addClass('overflow');
    }



    // Cart Touch Spin
    function cartTouchSpin() {
        if ($('.quantity-spinner').length) {
            $("input.quantity-spinner").TouchSpin({
                verticalbuttons: true
            });
        }
    }




    //=== Contact Form Validation ===
    if ($("#contact-form").length) {
        $("#contact-form").validate({
            submitHandler: function(form) {
                var form_btn = $(form).find('button[type="submit"]');
                var form_result_div = '#form-result';
                $(form_result_div).remove();
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'true') {
                            $(form).find('.form-control').val('');
                        }
                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                        $(form_result_div).html(data.message).fadeIn('slow');
                        setTimeout(function() { $(form_result_div).fadeOut('slow') }, 6000);
                    }
                });
            }
        });
    }

    function priceFilter() {
        if ($('.range-slider-price').length) {

            var priceRange = document.getElementById('range-slider-price');

            noUiSlider.create(priceRange, {
                start: [10, 25],
                limit: 90,
                behaviour: 'drag',
                connect: true,
                range: {
                    'min': 11,
                    'max': 90
                }
            });

            var limitFieldMin = document.getElementById('min-value-rangeslider');
            var limitFieldMax = document.getElementById('max-value-rangeslider');

            priceRange.noUiSlider.on('update', function(values, handle) {
                (handle ? limitFieldMax : limitFieldMin).value = values[handle];
            });
        };
    }


    //Gallery Popup Hide / Show
    if ($('.has-gallery-popup').length) {

        //Show Gallery Popup
        $('.has-gallery-popup').on('click', function(e) {
            e.preventDefault();
            var target = $($(this).attr('href'));
            $('body').addClass('popup-visible');
            $(target).addClass('now-visible');
        });

        //Show Gallery Popup
        $('.gallery-box .btn-close,.gallery-box .bg-fade-layer').on('click', function() {
            $('.gallery-box').removeClass('now-visible');
            $('body').removeClass('popup-visible');
        });

    }

    //Gallery Popup Slider / Vertical Gallery Slider
    if ($('.vertical-slider').length) {
        var slider = new MasterSlider();
        slider.setup('masterslider', {
            width: 850,
            height: 470,
            space: 10,
            view: 'basic',
            dir: 'v'
        });
        slider.control('arrows');
        slider.control('scrollbar', { dir: 'v' });
        slider.control('circletimer', { color: "#FFFFFF", stroke: 9 });
        slider.control('thumblist', { autohide: false, dir: 'v' });
    }

    // Date picker
    function datepicker() {
        if ($('#datepicker').length) {
            $('#datepicker').datepicker();
        };
    }
    // Date picker
    function datepickerone() {
        if ($('#datepickerone').length) {
            $('#datepickerone').datepicker();
        };
    }


    // Time picker
    function timepicker() {
        $('input[name="time"]').ptTimeSelect();
    }


    //Appointment Calendar
    if ($('#appoinment_calendar').length) {
        $('#appoinment_calendar').monthly();
    }


    // Fact Counter
    function factCounter() {
        if ($('.fact-counter').length) {
            $('.fact-counter .counter-column.animated').each(function() {

                var $t = $(this),
                    n = $t.find(".count-text").attr("data-stop"),
                    r = parseInt($t.find(".count-text").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".count-text").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".count-text").text(this.countNum);
                        }
                    });
                }

            });
        }
    }

    //13. Countdown Timer
    if ($('.countdown').length) {
        $('.countdown').countdown('2019/1/1', function(event) {
            var $this = $(this).html(event.strftime('' + '<div class="counter-column"><span class="count">%D</span><br>Days</div> ' + '<div class="counter-column"><span class="count">%H</span><span class="colon"></span><br>Hours</div>  ' + '<div class="counter-column"><span class="count">%M</span><span class="colon"></span><br>Mutines</div>  ' + '<div class="counter-column"><span class="count">%S</span><span class="colon"></span><br>Seconds</div>'));
        });
    }

    function customTabProductPageTab() {
        if ($('.product-details-tab-title').length) {
            var tabWrap = $('.product-details-tab-content');
            var tabClicker = $('.product-details-tab-title ul li');

            tabWrap.children('div').hide();
            tabWrap.children('div').eq(0).show();
            tabClicker.on('click', function() {
                var tabName = $(this).data('tab-name');
                tabClicker.removeClass('active');
                $(this).addClass('active');
                var id = '#' + tabName;
                tabWrap.children('div').not(id).hide();
                tabWrap.children('div' + id).fadeIn('500');
                return false;
            });
        }
    }

    // Scroll to a Specific Div
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function() {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 10);

        });
    }

    //LightBox / Fancybox
    if ($('.lightbox-image').length) {
        $('.lightbox-image').fancybox({
            openEffect: 'fade',
            closeEffect: 'fade',
            helpers: {
                media: {},
                title: {
                    type: 'inside'
                }
            }
        });
    }


    // Elements Animation
    if ($('.wow').length) {
        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: false, // trigger animations on mobile devices (default is true)
            live: true // act on asynchronously loaded content (default is true)
        });
        wow.init();
    }





    /*	=========================================================================
    When document is Scrollig, do
    ========================================================================== */
    jQuery(document).on('ready', function() {
        (function($) {
            // add your functions
            datepicker();
            datepickerone();
        })(jQuery);
    });



    /* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

    $(window).on('scroll', function() {
        stickyHeader();
        factCounter();
    });



    /* ==========================================================================
   When document is loaded, do
   ========================================================================== */

    $(window).on('load', function() {
        handlePreloader();
        enableMasonry();
    });



})(window.jQuery);