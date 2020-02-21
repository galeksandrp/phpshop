

// �����������
function commentList(xid, comand, page, cid) {
    var message = "";
    var rateVal = 0;

    if (page === undefined)
        page = 0;

    if (cid === undefined)
        cid = 0;


    if (comand == "add") {
        message = $('#message').val();
        if (message == "")
            return false;
        if ($('input[name=rate][type=radio]:checked').val())
            rateVal = $('input[name=rate][type=radio]:checked').val();
    }

    if (comand == "edit_add") {
        message = $('#message').val();
        cid = $('#commentEditId').val();
        $('#commentButtonAdd').show();
        $('#commentButtonEdit').hide();
    }

    if (comand == "dell") {
        if (confirm("�� ������������� ������ ������� �����������?")) {
            cid = $('#commentEditId').val();
            $('#commentButtonAdd').show();
            $('commentButtonEdit').hide();
        }
        else
            cid = 0;
    }

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/comment.php',
        type: 'post',
        data: 'xid=' + xid + '&comand=' + comand + '&type=json&page=' + page + '&rateVal=' + rateVal + '&message=' + message + '&cid=' + cid,
        dataType: 'json',
        success: function(json) {
            if (json['success']) {

                if (comand == "edit") {
                    $('#message').val(json['comment']);
                    $('#commentButtonAdd').hide();
                    $('#commentButtonEdit').show();
                    $('#commentButtonEdit').show();
                    $('#commentEditId').val(cid);
                }
                else
                {
                    document.getElementById('message').value = "";
                    if (json['status'] == "error") {
                        mesHtml = "������� ���������� ����������� �������� ������ ��� �������������� �������������.\n<a href='/users/?from=true'>������������� ��� �������� �����������</a>.";
                        mesSimple = "������� ���������� ����������� �������� ������ ��� �������������� �������������.\n������������� ��� �������� �����������.";

                        showAlertMessage(mesHtml);

                        if ($('#evalForCommentAuth')) {
                            eval($('#evalForCommentAuth').val());
                        }
                    }
                    $('#commentList').html(json['comment']);
                }
                if (comand == "edit_add") {
                    mes = "��� ����������������� ����������� ����� �������� ������ ������������� ������ ����� ����������� ���������...";
                    showAlertMessage(mes);

                }
                if (comand == "add" && json['status'] != "error") {
                    mes = "����������� �������� � ����� �������� ����� ����������� ���������...";
                    showAlertMessage(mes);
                }
            }
        }
    });
}

// ���������� ������ � �������
function addToCartList(product_id, num, parent, addname) {

    if (num === undefined)
        num = 1;

    if (addname === undefined)
        addname = '';

    if (parent === undefined)
        parent = 0;

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/cartload.php',
        type: 'post',
        data: 'xid=' + product_id + '&num=' + num + '&xxid=0&type=json&addname=' + addname + '&xxid=' + parent,
        dataType: 'json',
        success: function(json) {
            if (json['success']) {
                showAlertMessage(json['message']);
                $("#num, #mobilnum").html(json['num']);
                $("#sum").html(json['sum']);
                $("#bar-cart, #order").addClass('active');
            }
        }
    });
}

// ���������� ������ � �������
function addToCompareList(product_id) {

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/compare.php',
        type: 'post',
        data: 'xid=' + product_id + '&type=json',
        dataType: 'json',
        success: function(json) {
            if (json['success']) {
                showAlertMessage(json['message']);
                $("#numcompare").html(json['num']);
            }
        }
    });
}


// �����������
function fotoload(xid, fid) {

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/fotoload.php',
        type: 'post',
        data: 'xid=' + xid + '&fid=' + fid + '&type=json',
        dataType: 'json',
        success: function(json) {
            if (json['success']) {
                $("#fotoload").fadeOut('slow', function() {
                    $("#fotoload").html(json['foto']);
                    $("#fotoload").fadeIn('slow');
                });
            }
        }
    });
}

// ���������� ������
$(".ok").addClass('btn btn-default btn-sm');
$("input:button").addClass('btn btn-default btn-sm');
$("input:submit").addClass('btn btn-primary');
$("input:text,input:password, textarea").addClass('form-control');


// �������� ������
function ButOn(Id) {
    Id.className = 'imgOn';
}

function ButOff(Id) {
    Id.className = 'imgOff';
}

function ChangeSkin() {
    document.SkinForm.submit();
}

// ����� ������
function ChangeValuta() {
    document.ValutaForm.submit();
}

// �������� ������ ��� ����������
function ReturnSortUrl(v) {
    var s, url = "";
    if (v > 0) {
        s = document.getElementById(v).value;
        if (s != "")
            url = "v[" + v + "]=" + s + "&";
    }
    return url;
}

// �������� ������� ����� ��������, ������ ��������
function NoFoto2(obj) {
    obj.height = 0;
    obj.width = 0;
}

// �������� ������� ����� ��������, ��������� ��������
function NoFoto(obj, pathTemplate) {
    obj.src = pathTemplate + '/images/shop/no_photo.gif';
}

// ���������� �� ���� ��������
function GetSortAll() {
    var url = ROOT_PATH + "/shop/CID_" + arguments[0] + ".html?";

    var i = 1;
    var c = arguments.length;

    for (i = 1; i < c; i++)
        if (document.getElementById(arguments[i]))
            url = url + ReturnSortUrl(arguments[i]);

    location.replace(url.substring(0, (url.length - 1)) + "#sort");

}

// �������������� ������� �������� �� �������
var trans = [];
for (var i = 0x410; i <= 0x44F; i++)
    trans[i] = i - 0x350; // �-��-�
trans[0x401] = 0xA8;    // �
trans[0x451] = 0xB8;    // �

// ������� �������� �� ����������
/*
 trans[0x457] = 0xBF;    // �
 trans[0x407] = 0xAF;    // �
 trans[0x456] = 0xB3;    // �
 trans[0x406] = 0xB2;    // �
 trans[0x404] = 0xBA;    // �
 trans[0x454] = 0xAA;    // �
 */

// ��������� ����������� ������� escape()
var escapeOrig = window.escape;

// �������������� ������� escape()
window.escape = function(str)
{
    var ret = [];
    // ���������� ������ ����� ��������, ������� ��������� ���������
    for (var i = 0; i < str.length; i++)
    {
        var n = str.charCodeAt(i);
        if (typeof trans[n] != 'undefined')
            n = trans[n];
        if (n <= 0xFF)
            ret.push(n);
    }
    return escapeOrig(String.fromCharCode.apply(null, ret));
}

// ������� ��������� � �������
function auto_layout_keyboard(str) {
    replacer = {
        "q": "�", "w": "�", "e": "�", "r": "�", "t": "�", "y": "�", "u": "�",
        "i": "�", "o": "�", "p": "�", "[": "�", "]": "�", "a": "�", "s": "�",
        "d": "�", "f": "�", "g": "�", "h": "�", "j": "�", "k": "�", "l": "�",
        ";": "�", "'": "�", "z": "�", "x": "�", "c": "�", "v": "�", "b": "�",
        "n": "�", "m": "�", ",": "�", ".": "�", "/": "."
    };

    return str.replace(/[A-z/,.;\'\]\[]/g, function(x) {
        return x == x.toLowerCase() ? replacer[ x ] : replacer[ x.toLowerCase() ].toUpperCase();
    });
}


// Ajax ������ ���������� ������
function filter_load(filter_str, obj) {

    $.ajax({
        type: "POST",
        url: '?' + filter_str.split('#').join(''),
        data: {
            ajax: true
        },
        success: function(data)
        {
            if (data === 'empty_sort') {
                showAlertMessage('������ �� �������', true);
            } else {
                $(".template-product-list").html(data);
                $('#price-filter-val-max').removeClass('has-error');
                $('#price-filter-val-min').removeClass('has-error');

                // ������������ ����� ������
                setEqualHeight(".product-description");
                setEqualHeight(".product-name-fix");
                setTimeout(function() {
                    //setEqualHeight(".thumbnail");
                    //setEqualHeight(".caption img");
                }, 600);
                // lazyLoad
                setTimeout(function() {
                    $(window).lazyLoadXT();
                }, 50);

                // ����� Waypoint
                Waypoint.refreshAll();
            }
        },
        error: function(data) {
            $(obj).attr('checked', false);
            //$(obj).attr('disabled', true);

            if ($(obj).attr('name') == 'max')
                $('#price-filter-val-max').addClass('has-error');
            if ($(obj).attr('name') == 'min')
                $('#price-filter-val-min').addClass('has-error');

            window.location.hash = window.location.hash.split($(obj).attr('data-url') + '&').join('');
        }


    });
}

// ������� �������
function price_slider_load(min, max, obj) {


    var hash = window.location.hash.split('min=' + $.cookie('slider-range-min') + '&').join('');
    hash = hash.split('max=' + $.cookie('slider-range-max') + '&').join('');
    hash += 'min=' + min + '&max=' + max + '&';
    window.location.hash = hash;

    filter_load(hash, obj);

    $.cookie('slider-range-min', min);
    $.cookie('slider-range-max', max);

    $(".pagination").hide();

}

// Ajax ������ ������� �����
function faset_filter_click(obj) {

    if (AJAX_SCROLL) {

        $(".pagination").hide();

        if ($(obj).prop('checked')) {
            window.location.hash += $(obj).attr('data-url') + '&';

        }
        else {
            window.location.hash = window.location.hash.split($(obj).attr('data-url') + '&').join('');
            if (window.location.hash == '')
                $('html, body').animate({scrollTop: $("a[name=sort]").offset().top - 100}, 500);

        }

        filter_load(window.location.hash.split(']').join('][]'), obj);
    }
    else {

        var href = window.location.href.split('?')[1];

        if (href == undefined)
            href = '';


        if ($(obj).prop('checked')) {
            var last = href.substring((href.length - 1), href.length);
            if (last != '&' && last != '')
                href += '&';

            href += $(obj).attr('data-url').split(']').join('][]') + '&';

        }
        else {
            href = href.split($(obj).attr('data-url').split(']').join('][]') + '&').join('');
        }

        window.location.href = '?' + href;
    }
}

// ������������ ����� ������
function setEqualHeight(columns) {

    $(columns).closest('.row ').each(function() {
        var tallestcolumn = 0;

        $(this).find(columns).each(function() {
            var currentHeight = $(this).height();
            if (currentHeight > tallestcolumn) {
                tallestcolumn = currentHeight;
            }
        });

        if (tallestcolumn > 0) {
            $(this).find(columns).height(tallestcolumn);
        }
    });

}
function mainNavMenuFix() {
    var body_width = $('body').width();
    if (body_width < 768) {
        $('.mobile-menu .sub-marker').removeClass('sub-marker')


    }

    if (body_width > 767) {
        var nav_weight = $('.main-navbar-top').width();
        var full_weight = 0;
        $('.main-navbar-top > li').each(function() {
            full_weight += $(this).width();
        });
        var menu_content = ('<div class="additional-nav-menu"><a href="#" class="dropdown-toggle link" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bars"></i></a><ul class="dropdown-menu dropdown-menu-right aditional-link" role="menu"></ul></div>');
        if ($('.header-menu-wrapper').find('.additional-nav-menu')) {
            var nav_weight_fix = nav_weight - 46;
        }
        if (nav_weight < full_weight) {
            var nav_weight_fix = nav_weight - 46;
            if ($('.header-menu-wrapper').find('.additional-nav-menu')) {
                $('.header-menu-wrapper > .row').append(menu_content);
            }

            while (nav_weight_fix < full_weight) {
                $('.main-navbar-top > li:last-child').appendTo('.aditional-link');
                var full_weight = 0;
                $('.main-navbar-top > li').each(function() {
                    full_weight += $(this).width();
                });
            }

        }
        /* $('.main-navbar-top').addClass('active');*/
    }
}
function productPageSliderImgFix() {
    var block_height = $('.bx-wrapper .bx-viewport').height();
    var block_height_fix = block_height + 'px';
    $('.bx-wrapper .bx-viewport .bxslider > div > a').css('line-height', block_height_fix);

}


var body_height = $(window).height() - 200;
var body_height2 = $(window).height() - 330;
$(document).ajaxStop(function() {

    setTimeout(function() {
        //setEqualHeight(".thumbnail");
        //setEqualHeight(".caption img");
    }, 600);
    setEqualHeight(".caption h5");
    setEqualHeight(".thumbnail .description");
    setEqualHeight(".prod-photo");
    setEqualHeight(".product-price");
    setEqualHeight(".stock");
});
$(document).ready(function() {
    mainNavMenuFix();
    $(".filter-btn").on('click', function() {

        $("#faset-filter").fadeIn();


    });
    $(".filter-close").click(function() {
        $("#faset-filter").fadeOut();

    });


    $(".faset-filter-name .close").on('click', function() {
        $("#faset-filter").fadeOut();


    });
    if ($(".carousel-inner .item+.item").length) {

        $(".carousel-control, .carousel-indicators").css("visibility", "visible")
    }

    setTimeout(function() {
        $('input[name="tel_new"]').mask("+7 (999) 999-99-99");

        $('input[name="tel_new"]').on('keyup', function(event) {
            reserveVal = $(this).cleanVal();
            phone = $(this).cleanVal().slice(0, 10);
            $(this).val($(this).masked(phone));
            if ($(this).cleanVal()[1] == '9') {
                if ($(this).cleanVal()[0] == '8' || $(this).cleanVal()[0] == '7') {
                    phone = reserveVal.slice(1);
                    $(this).val($(this).masked(phone));
                }
            }
        });

    }, 1000);
    var pathname = self.location.pathname;

    $(".left-block-list  li").each(function(index) {

        if ($(this).attr("data-cid") == pathname) {
            $(this).children("ul").addClass("active");
            $(this).find("i").toggleClass("fa-chevron-down")
            $(this).find("i").toggleClass("fa-chevron-up")
            var cid = $(this).attr("data-cid-parent");

            $("#cid" + cid).addClass("active");
            $("#cid" + cid).attr("aria-expanded", "false");
            $("#cid-ul" + cid).addClass("active");
            $(this).addClass("active");
            $(this).parent("ul").addClass("active");
            $(this).parent("ul").siblings('a').addClass("active");
            $(this).find("a").addClass("active");

        }
    });

    $('.left-block-list > li').removeClass('dropdown');

    $('.left-block-list > li > ul').removeClass('dropdown-menu');
    $('.left-block-list > li > a').on('click', function() {
        $(this).find("i").toggleClass("fa-chevron-down")
        $(this).find("i").toggleClass("fa-chevron-up")
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).siblings('ul').removeClass('active');
        } else {
            $(this).addClass('active');
            $(this).siblings('ul').addClass('active');
            $(this).siblings('ul').addClass('fadeIn animated');
        }
    });

    //��������� ������ ���� �������� �� �������� ��������
    $('.breadcrumb > li > a').each(function() {
        var linkHref = $(this).attr('href');
        $('.left-block li').each(function() {
            if ($(this).attr('data-cid') == linkHref) {
                $(this).addClass("active");
                $(this).parent("ul").addClass("active");
                $(this).parent("ul").siblings('a').addClass("active");
                $(this).find("a").addClass("active");
            }
        });
        $('.left-block ul').each(function() {
            if ($(this).hasClass('active')) {
                $(this).parent('li').removeClass('active');
            }
        });
    });
    /*$(document).mouseup(function (e) {
     var container = $('.popover');
     if (container.has(e.target).length === 0){
     container.hide();
     }
     });*/
    $("#cartlink").popover({
        delay: {show: 0, hide: 800}
    });


    setTimeout(function() {
        $('.header-menu-wrapper li').removeClass('active');
        $('.header-menu-wrapper').css("opacity", "1")
        $('.header-menu-wrapper').css("height", "auto")
    }, 400);
    // ������ ������ ���������� ������ 
    $("button.orderCheckButton").on("click", function(e) {
        e.preventDefault();
        OrderChekJq();
    });

    // ������������ ����� ������
    setEqualHeight(".thumbnail .description");
    setEqualHeight(".prod-photo");

    setTimeout(function() {
        //   setEqualHeight(".thumbnail");
        setEqualHeight(".stock");
        //setEqualHeight(".caption img");

    }, 900);




    setEqualHeight(".caption h5");
    // ������������� ������ ����
    $('.mega-more-parent').each(function() {
        if ($(this).hasClass('hide') || $(this).hasClass('hidden'))
            $(this).prev().removeClass('template-menu-line');
    });

    $(".swiper-container > .swiper-wrapper > div").addClass("swiper-slide");

    if ($(".swiper-container").length)
        var swiper5 = new Swiper(".compare-slider", {
            slidesPerView: 3,
            speed: 800,
            nextButton: ".btn-next10",
            prevButton: ".btn-prev10",
            preventClicks: false,
            effect: "slide",
            preventClicksPropagation: false,
            breakpoints: {
                450: {
                    slidesPerView: 2
                },
                610: {
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
                    slidesPerView: 3
                }
            }
        });
    setEqualHeight(".prod-title");
    setEqualHeight(".prod-photo");
    setEqualHeight(".product-name");


    setEqualHeight(".prod-desc");
    setEqualHeight(".prod-sort");
    // ����� ���� ��������� � ��������
    $('.mega-more').on('click', function(event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('.mega-menu-block').find('.template-menu-line').removeClass('hide');
    });


    // ����������� ���������� � �������
    $('#filter-selection-well input:radio').on('change', function() {
        window.location.href = $(this).attr('data-url');
    });

    $('#price-filter-body input').on('change', function() {
        if (AJAX_SCROLL) {
            price_slider_load($('#price-filter-body input[name=min]').val(), $('#price-filter-body input[name=max]').val(), $(this));
        } else {
            $('#price-filter-form').submit();
        }

    });


    // ������� �������
    $("#slider-range").on("slidestop", function(event, ui) {

        if (AJAX_SCROLL) {

            // ����� ������� ��������
            count = current;

            price_slider_load(ui.values[ 0 ], ui.values[ 1 ]);
        }
        else {
            $('#price-filter-form').submit();
        }
    });

    // �������� ������
    if (FILTER && $("#sorttable table td").html()) {
        $("#faset-filter-body").html($("#sorttable table td").html());
        $("#faset-filter").removeClass('hide');
        $('.filter-btn').addClass('visible-filter')
    }
    else {
        $("#faset-filter").hide();
    }

    if (!FILTER) {
        $("#faset-filter").hide();
        $("#sorttable").removeClass('hide');
    }


    // ����������� ����������
    $('#filter-well input:radio').on('change', function() {
        if (AJAX_SCROLL) {

            count = current;

            window.location.hash = window.location.hash.split($(this).attr('name') + '=1&').join('');
            window.location.hash = window.location.hash.split($(this).attr('name') + '=2&').join('');
            window.location.hash += $(this).attr('name') + '=' + $(this).attr('value') + '&';

            filter_load(window.location.hash);
        }
        else {

            var href = window.location.href.split('?')[1];

            if (href == undefined)
                href = '';

            var last = href.substring((href.length - 1), href.length);
            if (last != '&' && last != '')
                href += '&';

            href = href.split($(this).attr('name') + '=1&').join('');
            href = href.split($(this).attr('name') + '=2&').join('');
            href += $(this).attr('name') + '=' + $(this).attr('value');
            window.location.href = '?' + href;
        }
    });


    // �������� ���������� ������ ��� ��������
    if (window.location.hash != "" && $("#sorttable table td").html()) {

        var filter_str = window.location.hash.split(']').join('][]');

        // �������� ���������� �������
        filter_load(filter_str);

        // ������������ ���������
        $.ajax({
            type: "POST",
            url: '?' + filter_str.split('#').join(''),
            data: {
                ajaxfilter: true
            },
            success: function(data)
            {
                if (data) {
                    $("#faset-filter-body").html(data);
                    $("#faset-filter-body").html($("#faset-filter-body").find('td').html());
                }
            }
        });
    }

    // Ajax ������
    $('#faset-filter-body').on('change', 'input:checkbox', function() {

        // ����� ������� ��������
        count = current;

        faset_filter_click($(this));
    });


    // ����� �������
    $('#faset-filter-reset').on('click', function(event) {
        if (AJAX_SCROLL) {
            event.preventDefault();
            $("#faset-filter-body").html($("#sorttable table td").html());
            filter_load('');
            $('html, body').animate({scrollTop: $("a[name=sort]").offset().top - 100}, 500);
            window.location.hash = '';
            $.removeCookie('slider-range-min');
            $.removeCookie('slider-range-max');
            $(".pagination").show();

            // ����� ������� ��������
            count = current;
        }

    });


    // ��������� �������
    $('.pagination a').on('click', function(event) {
        if (AJAX_SCROLL) {
            event.preventDefault();
            window.location.href = $(this).attr('href') + window.location.hash;
        }
    });


    // toTop
    $('#toTop').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: $("header").offset().top - 100}, 500);
    });

    // ����������� ���������
    $('.main-container').waypoint(function() {
        if (FIXED_NAVBAR)
            $('#navigation').toggleClass('navbar-fixed-top');

        // toTop          
        $('#toTop').fadeToggle();
    });

    // ������� �������
    $(document).on('keydown', function(e) {
        if (e == null) { // ie
            key = event.keyCode;
            var ctrl = event.ctrlKey;
        } else { // mozilla
            key = e.which;
            var ctrl = e.ctrlKey;
        }
        if ((key == '123') && ctrl)
            window.location.replace(ROOT_PATH + '/phpshop/admpanel/');
        if (key == '120') {
            $.ajax({
                url: ROOT_PATH + '/phpshop/ajax/info.php',
                type: 'post',
                data: 'type=json',
                dataType: 'json',
                success: function(json) {
                    if (json['success']) {
                        confirm(json['info']);
                    }
                }
            });
        }
    });


    // ����� �������� ������
    $(".cat-menu-search").on('click', function() {
        $('#cat').val($(this).attr('data-target'));
        $('#catSearchSelect').html($(this).html());
    });

    hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>', position: 'top right', fade: 2});
    hs.graphicsDir = ROOT_PATH + '/java/highslide/graphics/';
    hs.wrapperClassName = 'borderless';


    // ���������� ����������� ������
    $("body").on('click', '.highslide', function() {
        return hs.expand(this);
    });

    // ������ �������� �����������
    $('.highslide img').on('error', function() {
        $(this).attr('src', '/phpshop/templates/bootstrap/images/shop/no_photo.gif');
        return true;
    });


    // ��������� ������������
    $("body").on('click', '#commentLoad', function() {
        commentList($(this).attr('data-uid'), 'list');
    });

    // ������� ������ �������� ���������� ��������
    if ($('#files').html() != '��� ������')
        $('#filesTab').addClass('show');

    if ($('#vendorenabled').html() != '')
        $('#settingsTab').addClass('show');

    if ($('#pages').html() != '')
        $('#pagesTab').addClass('show');


    // ������ � �������� ���� ���������
    if (MEGA_MENU_ICON === false) {
        $('.mega-menu-block img').hide();
    }


    // ������� ���� �������
    if (BRAND_MENU === false) {
        $('#brand-menu').hide();
    }

    if (CATALOG_MENU === false) {
        $('#catalog-menu').hide();
    }
    else {
        $('#catalog-menu').removeClass('hide');
    }

    // ���������� � �������
    $('body').on('click', 'button.addToCartList', function() {
        addToCartList($(this).attr('data-uid'), $(this).attr('data-num'));
        $(this).attr('disabled', 'disabled');
        $(this).addClass('btn-success');
        $(this).text("� �������")
        $('#order').addClass('active');
    });

    // ��������� ���������� ������ ��� ���������� � �������
    $('body').on('change', '.addToCartListNum', function() {
        var num = (Number($(this).val()) || 1);
        var id = $(this).attr('data-uid');
        /*
         if (num > 0 && $('.addToCartList').attr('data-uid') === $(this).attr('data-uid'))
         $('.addToCartList').attr('data-num', num);*/
        if (num > 0) {
            $(".addToCartList").each(function() {
                if ($(this).attr('data-uid') === id)
                    $('.addToCartList[data-uid=' + id + ']').attr('data-num', num);
            });
        }

    });

    // ���������� � ������� �������
    $(".addToCartListParent").on('click', function() {
        addToCartList($(this).attr('data-uid'), $(this).attr('data-num'), $(this).attr('data-parent'));
        $('[itemprop="price"]').html($(this).attr('data-price'));
    });

    // ���������� � ������� �����
    $(".addToCartListOption").on('click', function() {
        addToCartList($(this).attr('data-uid'), $(this).attr('data-num'), $(this).attr('data-uid'), $('#allOptionsSet' + $(this).attr('data-uid')).val());
    });

    // ���������� � wishlist
    $('body').on('click', '.addToWishList', function() {
        addToWishList($(this).attr('data-uid'));
    });

    // ���������� � compare
    $('body').on('click', '.addToCompareList', function() {
        addToCompareList($(this).attr('data-uid'));
    });

    // �������� ��������� �������������� �� ������� ��������
    $("#CheckMessage").on('click', function() {
        if ($("#message").val() != '')
            $("#forma_message").submit();
    });

    // ���������� �������
    if ($("#cartlink").attr('data-content') == "") {
        $("#cartlink").attr('href', '/order/');
    }
    $('[data-toggle="popover"]').popover();
    $('a[data-toggle="popover"]').on('show.bs.popover', function() {
        $('a[data-toggle="popover"]').attr('data-content', $("#visualcart_tmp").html());
    });

    // ��������� 
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    // ���������� select
    $('.selectpicker').selectpicker({
        width: "100%"
    });

    // ������� �� ������ �� ����� � ���������
    $('#price-form').on('click', function(event) {
        event.preventDefault();
        if ($(this).attr('data-uid') != "" && $(this).attr('data-uid') != "ALL")
            window.location.replace("../shop/CID_" + $(this).attr('data-uid') + ".html");
    });

    // Ajax �����
    $("#search").on('input', function() {
        var words = $(this).val();
        if (words.length > 2) {
            $.ajax({
                type: "POST",
                url: ROOT_PATH + "/search/",
                data: {
                    words: escape(words + ' ' + auto_layout_keyboard(words)),
                    set: 2,
                    ajax: true
                },
                success: function(data)
                {

                    // ��������� ������
                    if (data != 'false') {

                        if (data != $("#search").attr('data-content')) {
                            $("#search").attr('data-content', data);

                            $("#search").popover('show');
                        }
                    } else
                        $("#search").popover('hide');
                }
            });
        }
        else {
            $("#search").attr('data-content', '');
            $("#search").popover('hide');

        }
    });

    // ��������� �����������
    if ($('#usersError').html()) {
        $('form[name=user_forma] .form-group').addClass('has-error has-feedback');
        $('form[name=user_forma] .glyphicon').removeClass('hide');
        $('#userModal').modal('show');
        $('#userModal').on('shown.bs.modal', function() {

        });
    }

    // �������� ������������ ������ �����������
    $("form[name=user_forma_register] input[name=password_new2]").on('blur', function() {
        if ($(this).val() != $("form[name=user_forma_register] input[name=password_new]").val()) {
            $('form[name=user_forma_register] #check_pass').addClass('has-error has-feedback');
            $('form[name=user_forma_register] .glyphicon').removeClass('hide');
        }
        else {
            $('form[name=user_forma_register] #check_pass').removeClass('has-error has-feedback');
            $('form[name=user_forma_register] .glyphicon').addClass('hide');
        }
    });

    // ����������� ������������
    $("form[name=user_forma_register]").on('submit', function() {
        if ($(this).find("input[name=password_new]").val() != $(this).find("input[name=password_new2]").val()) {
            $(this).find('#check_pass').addClass('has-error has-feedback');
            $(this).find('.glyphicon').removeClass('hide');
            return false;
        }
        else
            $(this).submit();
    });

    // ������ �����������
    if ($("#user_error").html()) {
        $("#user_error").find('.list-group-item').addClass('list-group-item-warning');
    }

    // ������ ����� ��������
    setTimeout(function() {
        $('input[name=tel_new]').mask("+7 (999) 999-99-99");

        $('input[name=tel_new]').on('keyup', function(event) {
            reserveVal = $(this).cleanVal();
            phone = $(this).cleanVal().slice(0, 10);
            $(this).val($(this).masked(phone));
            if ($(this).cleanVal()[1] == '9') {
                if ($(this).cleanVal()[0] == '8' || $(this).cleanVal()[0] == '7') {
                    phone = reserveVal.slice(1);
                    $(this).val($(this).masked(phone));
                }
            }
        });
    }, 2500);
    $('input[name=returncall_mod_tel],input[name=tel],input[name=oneclick_mod_tel]').mask("+7 (999) 999-99-99");

    $('input[name=returncall_mod_tel],input[name=tel],input[name=oneclick_mod_tel]').on('keyup', function(event) {
        reserveVal = $(this).cleanVal();
        phone = $(this).cleanVal().slice(0, 10);
        $(this).val($(this).masked(phone));
        if ($(this).cleanVal()[1] == '9') {
            if ($(this).cleanVal()[0] == '8' || $(this).cleanVal()[0] == '7') {
                phone = reserveVal.slice(1);
                $(this).val($(this).masked(phone));
            }
        }
    })
    // ����������� � �� �������� ������
    if ($('.bxslider').length) {
        $('.bxslider-pre').addClass('hide');
        $('.bxslider').removeClass('hide');
        slider = $('.bxslider').bxSlider({
            mode: 'fade',
            pagerCustom: '.bx-pager'
        });
    }
    productPageSliderImgFix();

    // ����������� � �� �������� ������ � �������� �������������
    $(document).on('click', '.bxslider a', function(event) {
        event.preventDefault();
        $('#sliderModal').modal('show');
        $('.bxsliderbig').html($('.bxsliderbig').attr('data-content'));
        $('.modal .modal-body img').css("max-height", $(window).height() * 0.65);
        setTimeout(function() {



            $('.modal .modal-body .bx-viewport').css("max-height", $(window).height() * 0.65);
            $('.modal .modal-body .bx-viewport').css("opacity", "1")

        }, 600);
        sliderbig = $('.bxsliderbig').bxSlider({
            mode: 'fade',
            pagerCustom: '.bx-pager-big'
        });


        if ($('.bx-pager-big').length == 0) {
            $('.modal-body').append('<div class="bx-pager-big">' + $('.bxsliderbig').attr('data-page') + '</div>');
            sliderbig.reloadSlider();
        }

        sliderbig.goToSlide(slider.getCurrentSlide());

    });

    // �������� ���������� ���� �������������, ���� �� �����������
    $(document).on('click', '.bxsliderbig a', function(event) {
        event.preventDefault();
        slider.goToSlide(sliderbig.getCurrentSlide());
        $('#sliderModal').modal('hide');
    });

    // �������� ���������� ���� �������������
    $('#sliderModal').on('hide.bs.modal', function() {
        slider.goToSlide(sliderbig.getCurrentSlide());
        sliderbig.destroySlider();
        delete sliderbig;
    });

    // ������������� ���� 
    $('.collapse').on('show.bs.collapse', function() {
        $(this).prev('h4').find('i').removeClass('fa-chevron-down');
        $(this).prev('h4').find('i').addClass('fa-chevron-up');
        $(this).prev('h4').attr('title', '������');
    });
    $('.collapse').on('hidden.bs.collapse', function() {
        $(this).prev('h4').find('i').removeClass('fa-chevron-up');
        $(this).prev('h4').find('i').addClass('fa-chevron-down');
        $(this).prev('h4').attr('title', '��������');
    });


    // ���������� � ������� ��������� ��������
    $("body").on('click', ".addToCartFull", function() {

        // ������
        if ($('#parentSizeMessage').html()) {

            // ������
            if ($('input[name="parentColor"]').val() === undefined && $('input[name="parentSize"]:checked').val() !== undefined) {
                addToCartList($('input[name="parentSize"]:checked').val(), $('input[name="quant[2]"]').val(), $('input[name="parentSize"]:checked').attr('data-parent'));
            }
            // ������  � ����
            else if ($('input[name="parentSize"]:checked').val() > 0 && $('input[name="parentColor"]:checked').val() > 0) {

                var color = $('input[name="parentColor"]:checked').attr('data-color');
                var size = $('input[name="parentSize"]:checked').attr('data-name');
                var parent = $('input[name="parentColor"]:checked').attr('data-parent');

                $.ajax({
                    url: ROOT_PATH + '/phpshop/ajax/option.php',
                    type: 'post',
                    data: 'color=' + escape(color) + '&parent=' + parent + '&size=' + escape(size),
                    dataType: 'json',
                    success: function(json) {
                        if (json['id'] > 0) {
                            if ($('input[name="parentSize"]:checked').val() > 0 && $('input[name="parentColor"]:checked').val() > 0)
                                addToCartList(json['id'], $('input[name="quant[2]"]').val(), $('input[name="parentColor"]:checked').attr('data-parent'));
                            else
                                showAlertMessage($('#parentSizeMessage').html());
                        }
                    }
                });
            }

            else
                showAlertMessage($('#parentSizeMessage').html());
        }
        // ����� ��������������
        else if ($('#optionMessage').html()) {
            var optionCheck = true;
            var optionValue = $('#allOptionsSet' + $(this).attr('data-uid')).val();
            $('.optionsDisp select').each(function() {
                if ($(this).hasClass('req') && optionValue === '')
                    optionCheck = false;
            });

            if (optionCheck)
                addToCartList($(this).attr('data-uid'), $('input[name="quant[2]"]').val(), $(this).attr('data-uid'), optionValue);
            else
                showAlertMessage($('#optionMessage').html());
        }
        // ������� �����
        else {
            addToCartList($(this).attr('data-uid'), $('input[name="quant[1]"]').val());
        }

    });

// ����� ����� 
    $('body').on('change', 'input[name="parentColor"]', function() {

        $('input[name="parentColor"]').each(function() {
            this.checked = false;
            $(this).parent('label').removeClass('label_active');
        });

        this.checked = true;
        $(this).parent('label').addClass('label_active');


        var color = $('input[name="parentColor"]:checked').attr('data-color');
        var size = $('input[name="parentSize"]:checked').attr('data-name');
        var parent = $('input[name="parentColor"]:checked').attr('data-parent');

        $.ajax({
            url: ROOT_PATH + '/phpshop/ajax/option.php',
            type: 'post',
            data: 'color=' + escape(color) + '&parent=' + parent + '&size=' + escape(size),
            dataType: 'json',
            success: function(json) {
                if (json['id'] > 0) {

                    // ����� ����
                    $('[itemprop="price"]').html(json['price']);

                    // ����� ������ ����
                    if (json['price_n'] != "")
                        $('[itemscope] .price-old').html(json['price_n'] + '<span class="rubznak">' + $('[itemprop="priceCurrency"]').html() + '</span>');
                    else
                        $('[itemscope] .price-old').html('');

                    // ����� ��������
                    var parent_img = json['image'];
                    if (parent_img != "") {

                        $(".bx-pager img").each(function(index, el) {
                            if ($(this).attr('src') == parent_img) {
                                slider.goToSlide(index);
                            }

                        });
                    }
                    
                    // ����� ������
                    $('#items').html(json['items']);
                }
            }
        });

    });

    // ����� �������
    $('body').on('change', 'input[name="parentSize"]', function() {
        var id = this.value;

        $('input[name="parentSize"]').each(function() {
            this.checked = false;
            $(this).parent('label').removeClass('label_active');
        });

        this.checked = true;
        $(this).parent('label').addClass('label_active');

        // ���� ��� ������ ������ ����� ���� � ��������
        if ($('input[name="parentColor"]').val() === undefined) {

            // ����� ����
            $('[itemprop="price"]').html($(this).attr('data-price'));

            // ����� ������ ����
            if ($(this).attr('data-priceold') != "")
                $('[itemscope] .price-old').html($(this).attr('data-priceold') + '<span class=rubznak>' + $('[itemprop="priceCurrency"]').html() + '</span>');
            else
                $('[itemscope] .price-old').html('');

            // ����� ��������
            var parent_img = $(this).attr('data-image');
            if (parent_img != "") {

                $(".bx-pager img").each(function(index, el) {
                    if ($(this).attr('src') == parent_img) {
                        slider.goToSlide(index);
                    }

                });
            }
            
            // ����� ������
            $('#items').html($(this).attr('data-items'));
        }

        $('.selectCartParentColor').each(function() {
            $(this).parent('label').removeClass('label_active');
            if ($(this).hasClass('select-color-' + id)) {
                $(this).parent('label').removeClass('not-active');
                $(this).parent('label').attr('title', $(this).attr('data-color'));

                $(this).val(id);
            }
            else {
                $(this).parent('label').addClass('not-active');
                $(this).parent('label').attr('title', '���');
            }
        });
    });

    // FlipClock
    if ($('.clock').length) {
        var now = new Date();
        var night = new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate(),
                $('.clock').attr('data-hour'), 0, 0
                );
        var msTillMidnight = night.getTime() / 1000 - now.getTime() / 1000;
        var clock = $('.clock').FlipClock({
            language: 'russian',
            coundown: true

        });
        clock.setTime(msTillMidnight);
        clock.setCountdown(true);
        clock.start();
    }

    // plugin bootstrap minus and plus http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });

    $('.odnotip .col-md-12').addClass("col-md-4 col-sm-3 col-xs-6")
    $('.odnotip .col-md-12').removeClass("col-md-12")

    // ��������� DaData.ru
    var DADATA_TOKEN = $('#body').attr('data-token');
    if (DADATA_TOKEN) {

        $('[name="name_new"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "NAME",
            params: {
                parts: ["NAME"]
            },
            count: 5
        });
        $('[name="name"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "NAME",
            params: {
                parts: ["NAME"]
            },
            count: 5
        });
        $('[name="name_person"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "NAME",
            params: {
                parts: ["NAME"]
            },
            count: 5
        });
        $('[name="oneclick_mod_name"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "NAME",
            params: {
                parts: ["NAME"]
            },
            count: 5
        });
        $('[name="returncall_mod_name"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "NAME",
            params: {
                parts: ["NAME"]
            },
            count: 5
        });
        $('[type="email"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "EMAIL",
            suggest_local: false,
            count: 5
        });
        $('[name="org_name"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "PARTY",
            count: 5
        });
        $('[name="company"]').suggestions({
            token: DADATA_TOKEN,
            partner: "PHPSHOP",
            type: "PARTY",
            count: 5
        });
    }

    //  �������� �� ������������� cookie
    $('.cookie-message a').on('click', function(e) {
        e.preventDefault();
        $.cookie('usecookie', 1, {
            path: '/',
            expires: 365
        });
        $(this).parent().slideToggle("slow");
    });
    var usecookie = $.cookie('usecookie');
    if (usecookie == undefined && COOKIE_AGREEMENT) {
        $('.cookie-message p').html('� ����� �������������� �������� ������������ ������������ �� ������ ����� ������������ cookie-�����. ��������� ������ ����, �� ����� ���� �������� �� ������������� ���� cookie-������.');
        $('.cookie-message').removeClass('hide');
    }


//mobile-menu 
    $('.mobile-menu .dropdown-parent').on('click', function() {
        $(this).children('ul').slideToggle()
    })

    $(window).resize(function() {

        mainNavMenuFix()
    })
});

// reCAPTCHA
if ($("#recaptcha_default").length || $("#recaptcha_returncall").length || $("#recaptcha_oneclick").length) {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.defer = true;
    ga.src = '//www.google.com/recaptcha/api.js?onload=recaptchaCreate&render=explicit';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
}
recaptchaCreate = function() {

    if ($("#recaptcha_default").length)
        grecaptcha.render("recaptcha_default", {"sitekey": $("#recaptcha_default").attr('data-key'), "size": $("#recaptcha_default").attr('data-size')});

    if ($("#recaptcha_returncall").length)
        grecaptcha.render("recaptcha_returncall", {"sitekey": $("#recaptcha_returncall").attr('data-key'), "size": $("#recaptcha_returncall").attr('data-size')});

    if ($("#recaptcha_oneclick").length)
        grecaptcha.render("recaptcha_oneclick", {"sitekey": $("#recaptcha_oneclick").attr('data-key'), "size": $("#recaptcha_oneclick").attr('data-size')});
};