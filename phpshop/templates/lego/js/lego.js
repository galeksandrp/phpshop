[].forEach.call(document.querySelectorAll("img[data-src]"), function(img) {
    img.setAttribute("src", img.getAttribute("data-src"));
    img.onload = function() {
        img.removeAttribute("data-src");
    };
});

$(document).ready(function() {


    $(".big-container .template-product-list .row .product-block-wrapper-fix").unwrap();

    var body_width = $('body').width();
    if (body_width > 992) {


        if ($(".big-container .template-product-list .col-md-3").length) {
            $(".template-product-list .product-block-wrapper-fix.col-md-3").css("width", "20%")
            var col_count = 5;
            var $e = $('.template-product-list');
            while ($e.children('.product-block-wrapper-fix').not('.row').length) {
                $e.children('.product-block-wrapper-fix').not('.row').filter(':lt(' + col_count + ')').wrapAll('<div class="row">');
            }

        }
        if ($(".big-container .template-product-list .col-md-4").length) {
            $(".template-product-list .product-block-wrapper-fix.col-md-4").removeClass("col-md-4").addClass('col-md-3')
            var col_count = 4;
            var $e = $('.template-product-list');
            while ($e.children('.product-block-wrapper-fix').not('.row').length) {
                $e.children('.product-block-wrapper-fix').not('.row').filter(':lt(' + col_count + ')').wrapAll('<div class="row">');

            }
        }
        if ($(".big-container .template-product-list .col-md-6").length) {
            $(".template-product-list .product-block-wrapper-fix.col-md-6").removeClass("col-md-6").addClass('col-md-4')
            var col_count = 3;
            var $e = $('.template-product-list');
            while ($e.children('.product-block-wrapper-fix').not('.row').length) {
                $e.children('.product-block-wrapper-fix').not('.row').filter(':lt(' + col_count + ')').wrapAll('<div class="row">');
            }
        }
    }
    if (body_width > 768 && body_width < 850) {

        if ($(".big-container .template-product-list .col-sm-3").length) {
            $(".template-product-list .product-block-wrapper-fix.col-sm-3").removeClass("col-sm-3").addClass('col-sm-4')
            var col_count = 3;
            var $e = $('.template-product-list');
            while ($e.children('.product-block-wrapper-fix').not('.row').length) {
                $e.children('.product-block-wrapper-fix').not('.row').filter(':lt(' + col_count + ')').wrapAll('<div class="row">');
            }
        }



    }
    if (body_width > 350 && body_width < 768) {

        if ($(".template-product-list .big-container .col-xs-6").length) {
            var col_count = 2;
            var $e = $('.template-product-list');
            while ($e.children('.product-block-wrapper-fix').not('.row').length) {
                $e.children('.product-block-wrapper-fix').not('.row').filter(':lt(' + col_count + ')').wrapAll('<div class="row">');
            }
        }



    }
    $(".sort-table-product-link").each(function() {

        $(this).wrapAll('<div class="link-block"></div>')
        $(this).html('');
        $(this).append('<img class="link-img" src=>')
        var src = $(this).attr("data-option")
        console.log(src)
        $(this).children(".link-img").attr("src", src);
    })
    $(".link-block").siblings("br").remove()

    $('#cartlink').click(function() {
        console.log($("#panel1 .swiper-wrapper").length);

    });

    console.log($("#panel1 .swiper-wrapper").length);
    if ($(".carousel-inner .item+.item").length) {
        $(".carousel-control, .carousel-indicators").css("visibility", "visible")
    }

   // ����� ����� ������ ���-�� �����
   $(".modal-nowBuy").fadeIn(2000).delay(7000).fadeOut(1000);
    
    // ������� ���� ������ ���-�� �����
    $('.nowbuy-close').on('click', function(e) {
        e.preventDefault();
        $('.modal-nowBuy').addClass('hide');
        $.cookie('nowbuy_close', 1, {
            path: '/',
            expires: 24
        });
    });


    if ($(".sidebar-left").hasClass("hide")) {
        $(".main-content").css("width", "100%")
        $(".main-content  .col-md-4").css("width", "25%")
    }
    if ($(".inner-nowbuy").hasClass("hide")) {
        $(".order").parents(".main-content").css("width", "100%")
        $(".order").parents(".main-content").children(".sidebar-left-inner").remove()
        $(".order").parents(".main").css("width", "100%")
        $(".order").parents(".main").addClass("big-container")

    }
    $(".big-container .catalog-wrap").removeClass("col-md-4");
    $(".big-container .catalog-wrap").addClass("col-md-3");


    var now = new Date();
    var night = new Date(
            now.getFullYear(),
            now.getMonth(),
            now.getDate() + 1, // the next day, ...
            0, 0, 0 // ...at 00:00:00 hours
            );
    var msTillMidnight = night.getTime() / 1000 - now.getTime() / 1000;
    var clock = $('.clock').FlipClock({
        language: 'russian',
        coundown: true

    });



    clock.setTime(msTillMidnight); //Устанавливаем нужное время в секундах
    clock.setCountdown(true); //Устанавливаем отсчет времени назад
    clock.start(); //Запускаем отсчет

    $(".catalog > a").on('click', function() {
        /*  $(this).parent("li").children("i").toggleClass("fa-chevron-up");
         $(this).parent("li").children("i").toggleClass("fa-chevron-down");*/
        $(this).siblings("ul").slideToggle();
        $(this).children("i").toggleClass("fa-chevron-down")
        $(this).children("i").toggleClass("fa-chevron-up")


    });

    var $grid =$('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: '.grid-item',
    });
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});


    $('.header-search [data-toggle="popover"]').popover({
        container: '.header-search'
    });
    if ($('.pageCatalContent').is(':empty')) {
        $('.pageCatal').remove();
    }
    /*  $(document).click(function (e) {
     if (!$(e.target).is('[data-toggle="popover"], .popover-title, .popover-content')) {
     $('[data-toggle="popover"]').popover('hide');
     }
     });*/

    $(".main-menu-block").appendTo(".menu-wrap .container-fluid");
    $("#catalog-menu ul").removeClass("dropdown-menu", "dropdown-parent");
    $("#catalog-menu ul").removeClass("dropdown-menu-indent-sm");
    $("#catalog-menu ul").removeClass("no-border-radius");
    $("#catalog-menu li").removeClass("dropdown");
    $("#catalog-menu li").removeClass("dropdown-right");
    $("#catalog-menu a").removeClass("sub-marker");
    var pathname = self.location.pathname;
    console.log(pathname);
    $("#catalog-menu li").each(function() {
        var path = $(this)
                .find("a")
                .attr("href");
        if (path === pathname) {
            $(this).addClass("visible-list");
            $(this).children("a").addClass('active-item');
            $(this)
                    .parents(".dropdown-parent")
                    .addClass("visible-list");
        }

    });
    $(".pageCatal a").each(function() {
        var path = $(this).attr("href");
        if (path === pathname) {

            $(this).addClass('active-item');
            $(this)
                    .parents("ul").css("display", "block");
        }

    });

    $("#catalog-menu > li:not(.visible-list)").remove();
    $('.phone').attr("autocomplete", "off");
    $('input[name="tel_new"]').mask("+7 (999) 999-99-999");

   
    $('.phone').mask("+7 (999) 999-99-999");

    $(".top-banner").each(function(index) {
        if ($(this).children('.sticker-text').is(':empty')) {
            $(this).hide();
        }
    });
    $(".top-banner .close").on('click', function() {
        $(".top-banner").remove();
    });

   
    $(".delivOneEl").on("click", function() {
        $(this).addClass('active');

    });

    //navbar

    var previousScroll = 0,
            navBarOrgOffset = $("#navbar").offset().top;

    $("#navigation").height($("#navbar").height());

    $(window).scroll(function() {
        $(".menu-wrap.active").removeClass('active');


        var currentScroll = $(this).scrollTop();

        if (currentScroll > navBarOrgOffset) {
            if (currentScroll > previousScroll) {
                $("#navigation").hide();
            } else {
                $("#navigation").show();
                $("#navigation").addClass("fixed");

                $(".top-menu").addClass("navbar-fixed-top");

            }
        } else {
            $("#navigation").removeClass("fixed");

            $(".top-menu").removeClass("navbar-fixed-top");

            console.log('i')
        }
        previousScroll = currentScroll;






    });

    $(".mobile-filter").click(function() {
        $(".big-filter-wrapper").addClass("active")
    });
    $(".filter-close").click(function() {
        $(".big-filter-wrapper").removeClass("active")
    });

    $(".btn-menu").click(function() {
        $('.hidden-menu').css('left', '0');

    });
    $('.hidden-menu .sub-marker').click(function() {
        $(this).siblings('.dropdown-menu').slideToggle();
        $(this).siblings('.dropdown-menu').toggleClass('active');

    });
    $(".hidden-menu .close").click(function() {
        $('.hidden-menu').css('left', '-100%');

    });
    $(".top-navbar .open-menu").click(function() {
        if ($(".top-navbar").hasClass("fixed")
                ) {
            $(".menu-wrap").addClass('active act');
            $(".menu-wrap").css("position", "fixed");
            console.log('go2');
            $(".menu-wrap").css("top", "50px");
            $(".menu-wrap").fadeIn("slow")
        }

        else {
            $(".menu-wrap").addClass('active act');
            $(".menu-wrap").css("position", "absolute");
            $(".menu-wrap").css("top", "calc(100% + 50px");
            $(".menu-wrap").fadeIn("slow")
        }
    });

    $(".menu-wrap").mouseleave(function() {
        console.log('back');
        $(".menu-wrap.active").removeClass('active');
        $(".menu-wrap").css("position", "absolute");
        $(".menu-wrap").css("top", "calc(100% + 50px)");
        $(".menu-wrap").fadeOut("slow");
    });
    $("header .container-fluid:not(.menu-cont)").click(function() {
        console.log('back 2');
        $(".menu-wrap").removeClass('active');
        $(".menu-wrap").css("position", "absolute");
        $(".menu-wrap").css("top", "calc(100% + 50px)");
        $(".menu-wrap").fadeOut("slow");
    });
    $(".main-menu-block > li").hover(function() {
        $(function() {
            var s = $(".dropdown-menu-indent-sm > li"),
                    width = 0,
                    arr = [];
            s.each(function(indx, element) {
                arr[indx] = $(this).width()
                width += arr[indx];
            });
            var s = $(".dropdown-menu-indent-sm > li"),
                    height = 0,
                    arr = [];
            s.each(function(indx, element) {
                arr[indx] = $(this).height()
                height += arr[indx];
            });
			console.log('hhh' + height)
			console.log('mmm' + $(".main-menu-block").height())
            columns = height / $(".main-menu-block").height();
            console.log("height_old" + columns);
            menuHeight = $(".main-menu-block").height();
            mWidth = columns * 341;
			console.log('mvidth' + mWidth)
            menuWidth = $(".menu-wrap > div").width() - $(".main-menu-block").width();
            if (mWidth > menuWidth) {
                menuHeight = menuHeight * 1.2
                columns = height / menuHeight;
                mWidth = columns * 341;
                if (mWidth > menuWidth) {
                    menuHeight = menuHeight * 1.2;
                    $(".main-menu-block").css("height", menuHeight);
                } else {
                    $(".main-menu-block").css("height", menuHeight);
                }
            }
    if (navigator.userAgent.match(/iPad/i) != null) {
		
      $('.allow-default').removeAttr("href")
    }
            /* if (  
             height > $(".main-menu-block").height() ){
             console.log("да")
             }*/


        });

    });
var length = $(".main-menu-block:not(li > ul)").children("li").length;
	 console.log('length' + length)
    $(".main-menu-block > .dropdown-parent").each(function() {
      var subLength = $(this).find("li").length;
  console.log('sub' + subLength)
      var subLength2 = $(".dropdown-parent ul li ul li").length;
  
      if (subLength >= length - 1) {
        $(this)
          .children(".dropdown-menu")
          .addClass("column");
      }
      if (subLength >= (length - 1) * 2) {
        $(this)
          .children(".dropdown-menu")
          .addClass("column-2");
      } else {
      if (subLength >= (length - 1) * 3) {
        $(this)
          .children(".dropdown-menu")
          .addClass("column-3");
      }}
    });
    var text = $('#vendorenabled .panel-body').length;

    $(".panel-body").each(function() {
        var stringText = $(this).html();

        if (stringText === "")
            $(this)
                    .parents(".panel")
                    .addClass("no-display");
    });

    if ($("#faset-filter-body").html() === "") {
        $(".big-filter-wrapper").remove();
    }
    if ($(".bx-pager").html() === "") {
        $(".controls").remove();
    }
    if ($(".bx-pager").html() === "") {
        $(".wrap").remove();
    }

    $(".back").on("click", function() {
        $(".back").removeClass("active");
        $(".dropdown-menu").removeClass("active");
        $(".dropdown-menu .dropdown-menu").removeClass("subactive");
        $(".hidden-menu i").removeClass("no-display");
        $(".hidden-menu li").removeClass("no-display");
    });
    $(".btn-menu").on("click", function() {
        $(".back").removeClass("active");
        $(".dropdown-menu").removeClass("active");

        $(".hidden-menu li").removeClass("no-display");
        $(".hidden-menu i").removeClass("no-display");
    });






    $(".swiper-container > .swiper-wrapper  .product-block-wrapper-fix").unwrap();
    $(".main-content .catalog-wrap").unwrap();
    $(".swiper-container > .swiper-wrapper > div").addClass("swiper-slide");
    $(".brands-slider > .swiper-wrapper > li").addClass("swiper-slide");
    $(".gbook-slider > .swiper-wrapper > div").addClass("swiper-slide");
    if ($("#panel1 .product-block-wrapper-fix").length) {
        $("#panel2").removeClass("active");
        $("#panel2").removeClass("in");
    } else {



        var swiper1 = new Swiper(".active .spec-main-slider", {
            slidesPerView: 6,
            speed: 800,
            nextButton: ".btn-next2",
            prevButton: ".btn-prev2",
            preventClicks: false,
            effect: "slide",
            preventClicksPropagation: false,
            breakpoints: {
                550: {
                    slidesPerView: 2
                },
                730: {
                    slidesPerView: 2
                },
                950: {
                    slidesPerView: 3
                },
                1180: {
                    slidesPerView: 4
                },
                1300: {
                    slidesPerView: 5
                },
                1500: {
                    slidesPerView: 6
                }
            }
        });

    }
    var swiper7 = new Swiper(".gbook-slider", {
        slidesPerView: 3,
		autoHeight: true,
        speed: 800,
       nextButton:  ".btn-next6",
        prevButton: ".btn-prev6",
        
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 1,
                autoHeight: true,
            },
            730: {
                slidesPerView: 2
            },
            1100: {
                slidesPerView: 3
            }
        }
    });
    var swiper4 = new Swiper(".nowBuy-slider", {
        slidesPerView: 5,
        speed: 800,
        nextButton: ".btn-next4",
        prevButton: ".btn-prev4",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 2
            },
            730: {
                slidesPerView: 2
            },
            950: {
                slidesPerView: 3
            },
            1180: {
                slidesPerView: 4
            },
            1300: {
                slidesPerView: 4
            },
            1500: {
                slidesPerView: 4
            }
        }
    });
    var swiper5 = new Swiper(".brands-slider", {
        slidesPerView: 6,
        speed: 800,
        nextButton: ".btn-next5",
        prevButton: ".btn-prev5",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 2
            },
            800: {
                slidesPerView: 4
            },
            1000: {
                slidesPerView: 4
            },
            1080: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 4
            },
            1500: {
                slidesPerView: 5
            }
        }
    });
    var swiper5 = new Swiper(".compare-slider", {
        slidesPerView: 4,
        speed: 800,
        nextButton: ".btn-next10",
        prevButton: ".btn-prev10",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 2
            },
            850: {
                slidesPerView: 3
            },
            1000: {
                slidesPerView: 4
            },
            1080: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 3
            },
            1500: {
                slidesPerView: 4
            }
        }
    });
    var swiper2 = new Swiper(".spec-main-icon-slider", {
        slidesPerView: 6,
        speed: 800,
        nextButton: ".btn-next3",
        prevButton: ".btn-prev3",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 2
            },
            730: {
                slidesPerView: 2
            },
            950: {
                slidesPerView: 3
            },
            1180: {
                slidesPerView: 4
            },
            1300: {
                slidesPerView: 5
            },
            1500: {
                slidesPerView: 6
            }
        }
    });
    var swiper3 = new Swiper(".spec-hit-slider", {
        slidesPerView: 6,
        speed: 800,
        nextButton: ".btn-next1",
        prevButton: ".btn-prev1",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            550: {
                slidesPerView: 2
            },
            730: {
                slidesPerView: 2
            },
            950: {
                slidesPerView: 3
            },
            1180: {
                slidesPerView: 4
            },
            1300: {
                slidesPerView: 5
            },
            1500: {
                slidesPerView: 6
            }
        }
    });
    var swiper6 = new Swiper(".inner-nowbuy .last-slider", {
        slidesPerView: 4,
        speed: 800,
        nextButton: ".btn-next3",
        prevButton: ".btn-prev3",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            450: {
                slidesPerView: 1
            },
            550: {
                slidesPerView: 2
            },
            730: {
                slidesPerView: 2
            },
            950: {
                slidesPerView: 3
            },
            1180: {
                slidesPerView: 3
            },
            1300: {
                slidesPerView: 3
            },
            1500: {
                slidesPerView: 4
            }
        }
    });
    var swiper6 = new Swiper(".inner-nowbuy .nowBuy-slider", {
        slidesPerView: 4,
        speed: 800,
        nextButton: ".btn-next4",
        prevButton: ".btn-prev4",
        preventClicks: false,
        effect: "slide",
        preventClicksPropagation: false,
        breakpoints: {
            450: {
                slidesPerView: 1
            },
            550: {
                slidesPerView: 2
            },
            730: {
                slidesPerView: 2
            },
            950: {
                slidesPerView: 3
            },
            1180: {
                slidesPerView: 3
            },
            1300: {
                slidesPerView: 3
            },
            1500: {
                slidesPerView: 4
            }
        }
    });

    $("#actionTab li:nth-child(3)").click(function() {
        setTimeout(function() {
            var swiper1 = new Swiper(".spec-main-slider", {
                slidesPerView: 6,
                speed: 800,
                nextButton: ".btn-next2",
                prevButton: ".btn-prev2",
                preventClicks: false,
                effect: "slide",
                preventClicksPropagation: false,
                breakpoints: {
                    550: {
                        slidesPerView: 2
                    },
                    730: {
                        slidesPerView: 2
                    },
                    950: {
                        slidesPerView: 3
                    },
                    1180: {
                        slidesPerView: 4
                    },
                    1300: {
                        slidesPerView: 5
                    },
                    1500: {
                        slidesPerView: 6
                    }
                }
            });
        }, 400);
    });


    // ������� ������ � �����
    $('.sticker-close').on('click', function(e) {
        e.preventDefault();
        $.cookie('sticker_close', 1, {
            path: '/',
            expires: 365
        });
    });

});