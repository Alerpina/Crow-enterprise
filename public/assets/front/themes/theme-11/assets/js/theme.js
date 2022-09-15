$(function ($) {
    "use strict";


    $(document).ready(function () {

        // Profile Dropdown
        $('.openperfil.my-dropdown').on('mouseover', function () {
            $('.openperfil.my-dropdown .my-dropdown-menu.profile-dropdown').stop().show(0);
        });
        $('.openperfil.my-dropdown').on('mouseout', function () {
            $('.openperfil.my-dropdown .my-dropdown-menu.profile-dropdown').stop().hide(0);
        });

        // Profile Dropdown
        $('.openstore.my-dropdown').on('mouseover', function () {
            $('.openstore.my-dropdown .my-dropdown-menu.profile-dropdown').stop().show(0);
        });
        $('.openstore.my-dropdown').on('mouseout', function () {
            $('.openstore.my-dropdown .my-dropdown-menu.profile-dropdown').stop().hide(0);
        });

        $(function () {

            var url = window.location.href,
                urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");

            // now grab every link from the navigation
            $('.core-nav-list li a').each(function () {
                // and test its normalized href against the url pathname regexp
                if (url == this.href) {
                    $(this).addClass('active');
                }
            });

        });

        $('[data-menu-toggle-main]').on('click', function (e) {
            let idMenu = $(e.currentTarget).attr('data-menu-toggle-main');
            $(idMenu).toggle('fast');
        })

        $('.button-open-search').on('click', function (e) {
            let boxSearch = document.querySelector('.search-box')
            $(boxSearch).toggleClass('open-search');
        })

        /*------addClass/removeClass categories-------*/
        var w = window.innerWidth;


        if (w > 991) {
            $("body").find(".horizontal").show();
            $("body").find(".vertical").hide();
            /*categories slideToggle*/
            $(".categories_title").on("mouseover", function () {
                $(this).addClass('active');
                $('.categories_menu_inner').stop().slideDown('medium');
            });


            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner_horizontal > ul > li").on("mouseover", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });
            $(".categories_menu_inner > ul > li").on("mouseover", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });




            $(document).on('mouseover', function (e) {
                var container = $(".categories_menu_inner_horizontal,.categories_menu_inner, .categories_mega_menu, .categories_title");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_title").removeClass('active');
                }



            });




        }




        /*------addClass/removeClass categories-------*/


        if (w <= 991) {
            $("body").find(".horizontal").hide();
            $("body").find(".vertical").show();


            $(".categories_title").on("click", function () {
                $(this).toggleClass('active');
                $('.categories_menu_inner').stop().slideToggle('medium');

                var divs = $('.qntd');
                var qtd = divs.length;

                if (qtd > 9) {
                    $('.categories_mega_menu').addClass('dropup');
                }
            });

            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner > ul > li").on("click", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });
            $(".categories_menu_inner_horizontal > ul > li").on("click", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });


            $(document).on('click', function (e) {
                var container = $(".categories_menu_inner,.categories_menu_inner_horizontal, .categories_mega_menu, .categories_title");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_title").removeClass('active');
                }
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").on('click', function () {
                $(this).find('i').toggleClass('fa-plus').toggleClass('fa-minus');
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").each(function () {
                $(this).html('<i class="fas fa-plus"></i>');
            });

        }

        /*------addClass/removeClass categories-------*/



        $('nav').coreNavigation({
            menuPosition: "right",
            container: false,
            dropdownEvent: 'hover',
            onOpenDropdown: function () {
                console.log('open');
            },
            onCloseDropdown: function () {
                console.log('close');
            }
        });

        // Nice Select Start
        $('select.nice').niceSelect();

        $('#example').DataTable({
            "paging": true,
            "ordering": false,
            "info": true,
            "language": {
                "url": datatable_translation_url
            }
        });


        //   magnific popup
        $('.video-play-btn').magnificPopup({
            type: 'video'
        });



        // Tooltip Section

        $('[data-toggle="tooltip"]').tooltip({

        });

        $('[rel-toggle="tooltip"]').tooltip();

        $('[data-toggle="tooltip"]').on('click', function () {
            $(this).tooltip('hide');
        })


        $('[rel-toggle="tooltip"]').on('click', function () {
            $(this).tooltip('hide');
        })

        // Tooltip Section Ends

        /*-----------------------------
            Accordion Active js
        -----------------------------*/
        $("#accordion, #accordion2").accordion({
            heightStyle: "content",
            collapsible: true,
            icons: {
                "header": "ui-icon-caret-1-e",
                "activeHeader": " ui-icon-caret-1-s"
            }
        });
        $("#product-details-tab").tabs();


        // Hero Area Slider
        var $mainSlider = $('.intro-carousel');
        if ($('.intro-content').length > 1) {
            $mainSlider.owlCarousel({
                loop: true,
                //navText: ['<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>'],
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 8000,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 1000,
                onInitialized: startProgressBar,
                onTranslate: resetProgressBar,
                onTranslated: startProgressBar,
                responsive: {
                    0: {
                        dots: false,
                        items: 1
                    },
                    768: {
                        items: 1
                    }
                },

            });
        }

        if ($('.intro-content').length > 1) {
            var $currentItem = $('.owl-item', $mainSlider).eq(2);
            var $class1 = $currentItem.find('.subtitle').attr('data-animation');
            $currentItem.find('.subtitle').addClass($class1);
            setTimeout(function () {
                $currentItem.find('.subtitle').removeClass($class1);
            }, 900);

            var $class2 = $currentItem.find('.title').attr('data-animation');
            $currentItem.find('.title').addClass($class2);
            setTimeout(function () {
                $currentItem.find('.title').removeClass($class2);
            }, 900);

            var $class3 = $currentItem.find('.text').attr('data-animation');
            $currentItem.find('.text').addClass($class3);
            setTimeout(function () {
                $currentItem.find('.text').removeClass($class3);
            }, 900);

        }




        if ($('.intro-content').length > 1) {

            $mainSlider.on('changed.owl.carousel', function (event) {
                var $currentItem = $('.owl-item', $mainSlider).eq(event.item.index)

                var $class11 = $currentItem.find('.subtitle').attr('data-animation');
                $currentItem.find('.subtitle').addClass($class11);
                setTimeout(function () {
                    $currentItem.find('.subtitle').removeClass($class11);
                }, 900);

                var $class22 = $currentItem.find('.title').attr('data-animation');
                $currentItem.find('.title').addClass($class22);
                setTimeout(function () {
                    $currentItem.find('.title').removeClass($class22);
                }, 900);
                var $class33 = $currentItem.find('.text').attr('data-animation');
                $currentItem.find('.text').addClass($class33);
                setTimeout(function () {
                    $currentItem.find('.text').removeClass($class33);
                }, 900);


            });

        }



        function startProgressBar() {
            // apply keyframe animation
            $(".slide-progress").css({
                width: "100%",
                transition: "width 8000ms"
            });
        }

        function resetProgressBar() {
            $(".slide-progress").css({
                width: 0,
                transition: "width 0s"
            });
        }
        // Hero Area Slider End





        // flas_deal_slider
        var $flas_deal_slider = $('.flas-deal-slider');

        if ($flas_deal_slider.children().length > 1) {
            $flas_deal_slider.owlCarousel({
                loop: true,
                nav: true,
                navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
                dots: false,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    414: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 5
                    }
                }
            });

        }

        // // Carousel Categories
        // var $carousel_categories = $('.carousel-categories');

        // if ( $carousel_categories.length != 0) {
        //     $carousel_categories.owlCarousel({
        //         loop: true,
        //         nav: true,
        //         navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
        //         dots: false,
        //         margin: 10,
        //         autoplay: true,
        //         autoplayTimeout: 6000,
        //         smartSpeed: 1000,
        //         responsive: {
        //             0: {
        //                 items: 1
        //             },
        //             768: {
        //                 items: 2
        //             },
        //             992: {
        //                 items: 4
        //             },
        //             1200: {
        //                 items: 6
        //             }
        //         }
        //     });

        // }



        // Product deal countdown
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<span>%D : <small>Dias</small></span> <span>%H : <small>Hrs</small></span>  <span>%M : <small>Min</small></span> <span>%S <small>Seg</small></span>'));
            });
        });

        // trending item  slider
        var $trending_slider = $('.trending-item-slider');
        $trending_slider.owlCarousel({
            items: 5,
            autoplay: false,
            margin: 0,
            loop: true,
            dots: true,
            nav: true,
            center: false,
            autoplayHoverPause: true,
            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 2
                },
                414: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });


        // trending item  slider
        var $hot_new_slider = $('.hot-and-new-item-slider');

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        $hot_new_slider.each(function () {
            if ($(this).find('.item-slide').length > 1) {
                $(this).owlCarousel({
                    items: 5,
                    autoplay: true,
                    margin: 0,
                    loop: true,
                    dots: true,
                    nav: true,
                    center: false,
                    autoplayHoverPause: true,
                    navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
                    smartSpeed: 800,
                    responsive: {
                        0: {
                            items: 1
                        },
                        414: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        },
                        1200: {
                            items: 5
                        }
                    }
                })
            }
        });

        // trending item  slider
        var $hot_new_slider = $('.hot-and-new-item-slider-page-product');

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        $hot_new_slider.each(function () {
            if ($(this).find('.item-slide').length > 1) {
                $(this).owlCarousel({
                    items: 1,
                    autoplay: true,
                    margin: 0,
                    loop: true,
                    dots: true,
                    nav: true,
                    center: false,
                    autoplayHoverPause: true,
                    navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
                    smartSpeed: 800,
                })
            }
        });

        // aside_review_slider
        var $aside_review_slider = $('.aside-review-slider');

        if ($aside_review_slider.children().length > 1) {

            $aside_review_slider.owlCarousel({
                loop: true,
                nav: false,
                navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
                dots: false,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                items: 1,
            });

        }

        //service slider
        var $service_slider = $('#services-carousel'),
            $w = $(window).width();

        // fix not looping when just having 1 item.
        // source: https://github.com/OwlCarousel2/OwlCarousel2/issues/548#issuecomment-74332563
        if ($w > 768) {
            $service_slider.each(function () {
                if ($(this).find('.item-slide').length > 3) {
                    $(this).owlCarousel({
                        items: 3,
                        autoplay: true,
                        margin: 0,
                        loop: true,
                        dots: true,
                        nav: true,
                        center: false,
                        autoplayHoverPause: true,
                        navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
                        smartSpeed: 800,
                        responsive: {
                            0: {
                                items: 1
                            },
                            414: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            992: {
                                items: 4
                            },
                            1200: {
                                items: 5
                            }
                        }
                    })
                }
            });
        } else {
            $service_slider.owlCarousel({
                items: 1,
                autoplay: true,
                margin: 0,
                loop: true,
                dots: true,
                nav: true,
                center: false,
                autoplayHoverPause: true,
                navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
                smartSpeed: 800,
            })
        }


        $(document).on('click', function (e) {
            var container = $(".autocomplete-items");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $(".autocomplete").hide();
            }
        });

        if (w <= 991) {

            $(document).on('mouseover', function (e) {
                var container = $(".xzoom-preview");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $(".xzoom-preview").css('display', 'none');
                }
            });

        }

        if (w <= 991) {

            $('.carticon').on('click', function () {
                $(this).next().toggleClass('show');
            });

            $(document).on('click', function (e) {
                var container = $(".carticon, .my-dropdown-menu");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.my-dropdown-menu').removeClass('show');
                }
            });
        }



    });






    /*-------------------------------
        back to top
    ------------------------------*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 1000);
    });

    //define variable for store last scrolltop
    $(window).on('scroll', function () {
        var $window = $(window);

        if ($(window).width() > 991) {

            if ($window.scrollTop() > 45) {
                $(".menufixed").addClass('nav-fixed');

                var tamanhomenu = $('.nav-fixed').height() + $('.top-header').height() + 20;

                $('.breadcrumb-area').css('margin-top', tamanhomenu);

            } else {
                $(".menufixed").removeClass('nav-fixed');

                var tamanhomenu = $('.nav-fixed').height();

                $('.breadcrumb-area').css('margin-top', '');
            }
        } else {
            if ($window.scrollTop() > 190) {
                $(".mainmenu-area").addClass('nav-fixed');

            } else {
                $(".mainmenu-area").removeClass('nav-fixed');
            }
        }


        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        var lastScrollTop = st;

    });

    $(window).on('load', function () {

        /*---------------------
            Preloader
        -----------------------*/
        var preLoder = $("#preloader");
        preLoder.addClass('hide');
        var backtoTop = $('.back-to-top')
        /*-----------------------------
            back to top
        -----------------------------*/
        var backtoTop = $('.bottomtotop')
        backtoTop.fadeOut(100);
    });

    // Coupon code toggle code
    $('#coupon-link').on('click', function () {
        $("#coupon-form,#check-coupon-form").toggle();
    })

    $('.preload-close').click(function () {
        $('.subscribe-preloader-wrap').hide();
    });

    $(window).load(function () {
        setTimeout(function () {
            $('#subscriptionForm').show();
        }, 2000)
    });


    // partner-slider
    var $partner_Slider = $('.partner-slider');
    $partner_Slider.owlCarousel({
        loop: true,
        dots: true,
        autoplay: true,
        margin: 30,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 3
            },
            993: {
                items: 5
            }
        }
    });

    var $product_slider = $('.all-slider');
    $product_slider.owlCarousel({
        loop: false,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });

    var $product_color_gallery_slider = $('.all-slider-color-gallery');
    $product_color_gallery_slider.owlCarousel({
        touchDrag: false,
        mouseDrag: false,
        loop: false,
        dots: false,
        nav: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });

    var $product_material_gallery_slider = $('.all-slider-material-gallery');
    $product_material_gallery_slider.owlCarousel({
        touchDrag: false,
        mouseDrag: false,
        loop: false,
        dots: false,
        nav: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });


});
