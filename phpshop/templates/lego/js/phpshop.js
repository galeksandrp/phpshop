

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
        } else
            cid = 0;
    }

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/comment.php',
        type: 'post',
        data: 'xid=' + xid + '&comand=' + comand + '&type=json&page=' + page + '&rateVal=' + rateVal + '&message=' + message + '&cid=' + cid,
        dataType: 'json',
        success: function (json) {
            if (json['success']) {

                if (comand == "edit") {
                    $('#message').val(json['comment']);
                    $('#commentButtonAdd').hide();
                    $('#commentButtonEdit').show();
                    $('#commentButtonEdit').show();
                    $('#commentEditId').val(cid);
                } else {
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
        success: function (json) {
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
        success: function (json) {
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
        success: function (json) {
            if (json['success']) {
                $("#fotoload").fadeOut('slow', function () {
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
window.escape = function (str) {
    var ret = [];
    // ���������� ������ ����� ��������, ������� ��������� ���������
    for (var i = 0; i < str.length; i++) {
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

    return str.replace(/[A-z/,.;\'\]\[]/g, function (x) {
        return x == x.toLowerCase() ? replacer[x] : replacer[x.toLowerCase()].toUpperCase();
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
        success: function (data) {
            if (data === 'empty_sort') {
                showAlertMessage('������ �� �������', true);
            } else {
                $(".template-product-list").html(data);
                $('#price-filter-val-max').removeClass('has-error');
                $('#price-filter-val-min').removeClass('has-error');

                // ������������ ����� ������
                setEqualHeight(".product-description");
                setEqualHeight(".product-name-fix");
                setTimeout(function () {
                    //setEqualHeight(".thumbnail");
                    setEqualHeight(".caption img");
                }, 600);
                setEqualHeight(".caption img");
                // lazyLoad
                setTimeout(function () {
                    $(window).lazyLoadXT();
                }, 50);

                // ����� Waypoint
                Waypoint.refreshAll();
            }
        },
        error: function (data) {
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

        } else {
            window.location.hash = window.location.hash.split($(obj).attr('data-url') + '&').join('');
            if (window.location.hash == '')
                $('html, body').animate({scrollTop: $("a[name=sort]").offset().top - 100}, 500);

        }

        filter_load(window.location.hash.split(']').join('][]'), obj);
    } else {

        var href = window.location.href.split('?')[1];

        if (href == undefined)
            href = '';


        if ($(obj).prop('checked')) {
            var last = href.substring((href.length - 1), href.length);
            if (last != '&' && last != '')
                href += '&';

            href += $(obj).attr('data-url').split(']').join('][]') + '&';

        } else {
            href = href.split($(obj).attr('data-url').split(']').join('][]') + '&').join('');
        }

        window.location.href = '?' + href;
    }
}

// ������������ ����� ������
function setEqualHeight(columns) {

    $(columns).closest('.row ').each(function () {
        var tallestcolumn = 0;

        $(this).find(columns).each(function () {
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

function productPageSelect() {
    $(".table-optionsDisp select").each(function () {
        var selectID = $(this).attr("id");
        $(".product-page-option-wrapper").append(
                '<div class="product-page-select ' + selectID + '""></div>'
                );
        $(this)
                .children("option")
                .each(function () {
                    var optionValue = $(this).attr("value");
                    var optionHtml = $(this).html();
                    $("." + selectID + "").append(
                            '<div class="select-option" value="' +
                            optionValue +
                            '">' +
                            optionHtml +
                            "</div>"
                            );
                });
    });

    $(".select-option").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            var optionInputValue = [];
            $(".product-page-select .select-option.active").each(function () {
                optionInputValue.unshift($(this).attr("value"));
            });
            var optionInputNewValue = optionInputValue.join();
            $(".product-page-option-wrapper input").attr(
                    "value",
                    optionInputNewValue
                    );
        } else {
            $(this)
                    .siblings()
                    .removeClass("active");
            $(this).addClass("active");
            var optionInputValue = [];
            $(".product-page-select .select-option.active").each(function () {
                optionInputValue.unshift($(this).attr("value"));
            });
            var optionInputNewValue = optionInputValue.join("");
            $(".product-page-option-wrapper input").attr(
                    "value",
                    optionInputNewValue
                    );
        }
    });
}
// ��������� ����� �����
function setRubznak() {
    $(".rubznak").each(function () {
        if (
                $(this).html() == "�." ||
                $(this).html() == "���" ||
                $(this).html() == "p"
                )
            $(this).html("p");
    });
}
function productFilter() {
    $('.filter-list #faset-filter').on('click', 'h4', function () {
        if ($(this).parents('.faset-filter-block-wrapper').hasClass('active')) {
            $('.faset-filter-block-wrapper').removeClass('active');
            $(this).parents('.faset-filter-block-wrapper').removeClass('active');
        } else {
            $('.faset-filter-block-wrapper').removeClass('active');
            $(this).parents('.faset-filter-block-wrapper').addClass('active');
        }
    });
}
function searchOpen() {
    $('.search-open-button').on('click', function () {
        $('.search-big-block').addClass("active");
    });
    $('.search-close').on('click', function () {
        $('.search-big-block').removeClass("active");
        $('.header-search-form').trigger("reset");
    });
}

function topMenuFix() {
    var body_width = $('body').width();
    if (body_width > 768) {
        var nav_weight = $('.top-menu-list').width();
        var top_nav_weight = $('.catalog-menu-list').width();
        var full_weight = 0;
        var top_full_weight = 0;

        $('.top-menu-list > li').each(function () {
            full_weight += ($(this).width() + 30);
        });
        $('.catalog-menu-list > li').each(function () {
            top_full_weight += ($(this).width() + 46);
        });

        var menu_content = ('<div class="additional-nav-menu"><a href="#" class="dropdown-toggle link" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bars"></i></a><ul class="dropdown-menu  aditional-link" role="menu"></ul></div>');
        var main_menu_content = ('<div class="additional-main-menu"><a href="#" class="dropdown-toggle link" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bars"></i></a><ul class="dropdown-menu  main-link" role="menu"></ul></div>');

        if ($('.top-menu-block').length) {
            if ($('.top-menu-block').find('.additional-nav-menu')) {
                var nav_weight_fix = nav_weight - 26;
            }

            if (nav_weight < full_weight) {

                var nav_weight_fix = nav_weight - 26;
                if ($('.top-menu-block').find('.additional-nav-menu')) {
                    $('.top-menu-block').append(menu_content);
                }

                while (nav_weight_fix < full_weight) {

                    $('.top-menu-list > li:last-child').appendTo('.aditional-link');
                    var full_weight = 0;
                    $('.top-menu-list > li').each(function () {
                        full_weight += ($(this).width() + 30);
                    });

                }

            }
        }

        if ($('.catalog-menu-wrap').find('.additional-main-menu')) {
            var top_nav_weight_fix = top_nav_weight - 46;
        }
        if (top_nav_weight < top_full_weight) {

            var top_nav_weight_fix = top_nav_weight - 46;
            if ($('.catalog-menu-wrap').find('.additional-main-menu')) {
                $('.catalog-menu-wrap').append(main_menu_content);
            }

            while (top_nav_weight_fix < top_full_weight) {

                $('.catalog-menu-list > li:last-child').prependTo('.main-link');
                var top_full_weight = 0;
                $('.catalog-menu-list > li').each(function () {
                    top_full_weight += $(this).width() + 46;
                });
            }

        }
        $('.top-menu-list').addClass('active');
    }
}
$(document).ajaxStop(function () {
    if ($(".filter-row #faset-filter-body .grid-item").length == 2) {
        $("#faset-filter-body .grid-item").css("width", "50%")
    }
    if ($(".filter-row #faset-filter-body .grid-item").length == 1) {
        $("#faset-filter-body .grid-item").css("width", "100%")
    }
    if ($(".filter-row #faset-filter-body .grid-item").length == 3) {
        $("#faset-filter-body .grid-item").css("width", "33%")
    }
    if ($(".filter-row #faset-filter-body .grid-item").length >= 3) {
        $("#faset-filter-body .grid-item").css("width", "33%")
    }

});

$(document).ready(function () {
    if (navigator.userAgent.match(/iPad/i) != null) {
        $('.main-menu-block > li > a.sub-marker').removeAttr("href")
        $('.main-menu-block > li').on("click", function () {

            $('.hover').removeClass('hover')
            $(this).addClass('hover')
        }

        )
    }
    if (navigator.userAgent.indexOf('Mac OS X') != -1) {
        $("body").addClass("mac");
    } else {
        $("body").addClass("pc");
    }

    topMenuFix();
    searchOpen();
    productPageSelect();
    setTimeout(function () {
        $(".top-menu-list").css("opacity", "1")
        $(".catalog-menu-list").css("opacity", "1")
        $(".additional-nav-menu").css("opacity", "1")
        $(".additional-main-menu").css("opacity", "1")
    }, 600);
    setTimeout(function () {
        $('input[name="tel_new"]').mask("+7 (999) 999-99-99");

        $('input[name="tel_new"]').on('keyup', function (event) {
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
        $(".delivOneEl")
                .closest("#seldelivery")
                .each(function () {
                    var tallestcolumn = 0;

                    $(this)
                            .find(".delivOneEl")
                            .each(function () {
                                var currentWidth = $(this).width();

                                if (currentWidth > tallestcolumn) {
                                    tallestcolumn = currentWidth;
                                }
                            });

                    if (tallestcolumn > 0) {
                        $(this)
                                .find(".delivOneEl")
                                .width(tallestcolumn);
                        $(this)
                                .find(".delivOneEl")
                                .css("opacity", "1");
                        $(this)
                                .find(".delivOneEl")
                                .css("display", "block");
                    }
                });

    }, 2000);
    $("#seldelivery").on("click", function () {
        //  $(".delivOneEl").css("opacity", "0");

        setTimeout(function () {
            $('input[name="tel_new"]').mask('+7(999)-999-9999');
            $(".delivOneEl")
                    .closest("#seldelivery")
                    .each(function () {
                        var tallestcolumn = 0;

                        $(this)
                                .find(".delivOneEl")
                                .each(function () {
                                    var currentWidth = $(this).width();

                                    if (currentWidth > tallestcolumn) {
                                        tallestcolumn = currentWidth;
                                    }
                                });

                        if (tallestcolumn > 0) {
                            /*$(this)
                             .find(".delivOneEl")
                             .width(tallestcolumn);*/
                            $(this)
                                    .find(".delivOneEl")
                                    .css("opacity", "1");
                            $(this)
                                    .find(".delivOneEl")
                                    .css("display", "block");
                            $(this)
                                    .find(".delivOneEl")
                                    .css("display", "block");
                        }
                    });
        }, 400);
    })


    productFilter();
    
    // ������ ������ ���������� ������
    $("button.orderCheckButton").on("click", function (e) {
        e.preventDefault();
        OrderChekJq();
    });

    // ������������ ����� ������
    setEqualHeight(".thumbnail .description");
    setEqualHeight(".prod-title");
    setEqualHeight(".prod-photo");
    setEqualHeight(".product-name");
    setEqualHeight(".price-block");
    setTimeout(function () {
        setEqualHeight(".prod-desc");
    }, 600);
    setEqualHeight(".prod-sort");

    // ������������� ������ ����
    $('.mega-more-parent').each(function () {
        if ($(this).hasClass('hide') || $(this).hasClass('hidden'))
            $(this).prev().removeClass('template-menu-line');
    });

    // ����� ���� ��������� � ��������
    $('.mega-more').on('click', function (event) {
        event.preventDefault();
        $(this).hide();
        $(this).closest('.mega-menu-block').find('.template-menu-line').removeClass('hide');
    });

    // ����������� ���������� � �������
    $('#filter-selection-well input:radio').on('change', function() {
        window.location.href = $(this).attr('data-url');
    });

    $('#price-filter-body input').on('change', function () {
        if (AJAX_SCROLL) {
            price_slider_load($('#price-filter-body input[name=min]').val(), $('#price-filter-body input[name=max]').val(), $(this));
        } else {
            $('#price-filter-form').submit();
        }

    });

    // ������� �������
    $("#slider-range").on("slidestop", function (event, ui) {

        if (AJAX_SCROLL) {

            // ����� ������� ��������
            count = current;

            price_slider_load(ui.values[0], ui.values[1]);
        } else {
            $('#price-filter-form').submit();
        }
    });
    // �������� ������
    if (FILTER && $("#sorttable table td").html()) {
        $("#faset-filter-body").html($("#sorttable table td").html());
        $("#faset-filter").removeClass("hide");
        $('.mobile-filter').addClass('visible-filter')

    } else {
        $("#faset-filter").hide();
        $('.mobile-filter').hide();
    }

    if (!FILTER) {
        $("#faset-filter").hide();
        $("#sorttable").removeClass("hide");
    }
    var body_width = $('body').width();
    if (body_width < 769) {

        $('.bx-pager').remove();
    }
    if (body_width > 769) {
        if ($(".filter-row #faset-filter-body .grid-item").length == 2) {
            $("#faset-filter-body .grid-item").css("width", "50%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length == 1) {
            $("#faset-filter-body .grid-item").css("width", "100%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length == 3) {
            $("#faset-filter-body .grid-item").css("width", "33%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length >= 3) {
            $("#faset-filter-body .grid-item").css("width", "33%")
        }
    }

    // ����������� ����������
    $('#filter-well input:radio').on('change', function () {
        if (AJAX_SCROLL) {

            count = current;

            window.location.hash = window.location.hash.split($(this).attr('name') + '=1&').join('');
            window.location.hash = window.location.hash.split($(this).attr('name') + '=2&').join('');
            window.location.hash += $(this).attr('name') + '=' + $(this).attr('value') + '&';

            filter_load(window.location.hash);
        } else {

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
            success: function (data) {
                if (data) {
                    $("#faset-filter-body").html(data);
                    $("#faset-filter-body").html($("#faset-filter-body").find('td').html());
                }
            }
        });
    }

    // Ajax ������
    $('#faset-filter-body').on('change', 'input:checkbox', function () {

        // ����� ������� ��������
        count = current;

        faset_filter_click($(this));
    });

    // ����� �������
    $('#faset-filter-reset').on('click', function (event) {
        if ($(".filter-row #faset-filter-body .grid-item").length == 2) {
            $("#faset-filter-body .grid-item").css("width", "50%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length == 1) {
            $("#faset-filter-body .grid-item").css("width", "100%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length == 3) {
            $("#faset-filter-body .grid-item").css("width", "33%")
        }
        if ($(".filter-row #faset-filter-body .grid-item").length >= 3) {
            $("#faset-filter-body .grid-item").css("width", "33%")
        }

        if (AJAX_SCROLL) {
            event.preventDefault();
            $("#faset-filter-body").html($("#sorttable table td").html());
            filter_load('');
            $('html, body').animate({scrollTop: $("a[name=sort]").offset().top - 100}, 500);
            window.location.hash = '';
            $.removeCookie('slider-range-min');
            $.removeCookie('slider-range-max');
            $(".pagination").show();
            if ($(".filter-row #faset-filter-body .grid-item").length == 2) {
                $("#faset-filter-body .grid-item").css("width", "50%")
            }
            if ($(".filter-row #faset-filter-body .grid-item").length == 1) {
                $("#faset-filter-body .grid-item").css("width", "100%")
            }
            if ($(".filter-row #faset-filter-body .grid-item").length == 3) {
                $("#faset-filter-body .grid-item").css("width", "33%")
            }
            if ($(".filter-row #faset-filter-body .grid-item").length >= 3) {
                $("#faset-filter-body .grid-item").css("width", "33%")
            }

            // ����� ������� ��������
            count = current;
        }

    });

    // ��������� �������
    $('.pagination a').on('click', function (event) {
        if (AJAX_SCROLL) {
            event.preventDefault();
            window.location.href = $(this).attr('href') + window.location.hash;
        }
    });

    // toTop
    $('#toTop').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: $("header").offset().top - 100}, 500);
    });

    // ����������� ���������
    $('.breadcrumb, .slider.tabs').waypoint(function () {
        if (FIXED_NAVBAR)
            $('#navigation').toggleClass('navbar-fixed-top');

        // toTop          
        $('#toTop').fadeToggle();
    });

    // ������� �������
    $(document).on('keydown', function (e) {
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
                success: function (json) {
                    if (json['success']) {
                        confirm(json['info']);
                    }
                }
            });
        }
    });

    // ����� �������� ������
    $(".cat-menu-search").on('click', function () {
        $('#cat').val($(this).attr('data-target'));
        $('#catSearchSelect').html($(this).html());
    });

    $("body").on("click", ".fastView", function (e) {
        e.preventDefault();
        var url = $(this).attr("data-role");

        if (url.length > 2) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    ajax: true
                },
                success: function (data) {
                    $(".fastViewContent").html(data);
                    //$('body').addClass('fix');

                    productPageSelect();
                    $(".btn-number").click(function (e) {
                        e.preventDefault();

                        fieldName = $(this).attr("data-field");
                        type = $(this).attr("data-type");
                        var input = $("input[name='" + fieldName + "']");
                        var currentVal = parseInt(input.val());
                        if (!isNaN(currentVal)) {
                            if (type == "minus") {
                                if (currentVal > input.attr("min")) {
                                    input.val(currentVal - 1).change();
                                }
                                if (parseInt(input.val()) == input.attr("min")) {
                                    $(this).attr("disabled", true);
                                }
                            } else if (type == "plus") {
                                if (currentVal < input.attr("max")) {
                                    input.val(currentVal + 1).change();
                                }
                                if (parseInt(input.val()) == input.attr("max")) {
                                    $(this).attr("disabled", true);
                                }
                            }
                        } else {
                            input.val(0);
                        }
                    });
                    $(".input-number").change(function () {
                        var num = parseInt($(this).val());

                        $(this)
                                .closest(".addToCart")
                                .children(".addToCartFull")
                                .attr("data-num", num);
                    });

                    //image zoom
                    //JQueryZoom();
                }
            });
            /* $('.product-img-modal > img').load(function() {
             if ($('.bxslider').length) {
             $('.bxslider-pre').addClass('hide');
             $('.bxslider').removeClass('hide');
             slider = $('.bxslider').bxSlider({
             mode: 'fade',
             pagerCustom: '.bx-pager'
             });
             }
             });*/
        }
    });
    $(".odnotipList").appendTo(".odnotipListWrapper");
    $(".odnotipList .product-block-wrapper-fix").unwrap();

    // ��������� ������������
    $("body").on("click", "#commentLoad", function () {
        commentList($(this).attr("data-uid"), "list");
    });

    // ������� ������ �������� ���������� ��������
    if ($("#files").html() == "��� ������")
        $("#filesTab").addClass("hide");

    if ($("#vendorenabled").html() == "")
        $("#settingsTab").addClass("hide");
    if ($("#desc").html() == "")
        $("#descTab").addClass("hide");
    if ($("#pages").html() != "")
        $("#pagesTab").addClass("show");
    if ($("#descTab").hasClass("hide") && $("#settingsTab").hasClass("hide")) {
        $("#commentTab").addClass('active'), $("#messages").addClass('active')
    }
    /*
     if ($('#vendorActionButton').val() == '���������') {
     $('#sorttable').addClass('show');
     }*/

    // ������ � �������� ���� ���������
    if (MEGA_MENU_ICON === false) {
        $(".mega-menu-block img").hide();
    }

    // ������� ���� �������
    if (BRAND_MENU === false) {
        $("#brand-menu").hide();
    }

    if (
            $(".brands").length
            ) {
        $(".brands-link").css("display", "inline");
    }

    if (CATALOG_MENU === false) {
        $("#catalog-menu").hide();
    } else {
        $("#catalog-menu").removeClass("hide");
    }

    // ���������� � �������
    $('body').on('click', 'button.addToCartList', function () {

        addToCartList($(this).attr("data-uid"), $(this).attr("data-num"));
        $(this).attr("disabled", "disabled");

        $("#order").addClass("active");
        if ($(this).hasClass('listBtn')) {
            $(this).addClass("btn-success");
            $(this).children('.btn-text').text('� �������');
        }
    });

    // ��������� ���������� ������ ��� ���������� � �������
    $('body').on('change', '.addToCartListNum', function () {
        var num = (Number($(this).val()) || 1);
        var id = $(this).attr('data-uid');
        /*
         if (num > 0 && $('.addToCartList').attr('data-uid') === $(this).attr('data-uid'))
         $('.addToCartList').attr('data-num', num);*/
        if (num > 0) {
            $(".addToCartList").each(function () {
                if ($(this).attr('data-uid') === id)
                    $('.addToCartList[data-uid=' + id + ']').attr('data-num', num);
            });
        }

    });
    // ���������� � ������� �������
    $(".addToCartListParent").on('click', function () {
        addToCartList($(this).attr('data-uid'), $(this).attr('data-num'), $(this).attr('data-parent'));
        $('[itemprop="price"]').html($(this).attr('data-price'));
    });

    // ���������� � ������� �����
    $(".addToCartListOption").on('click', function () {
        addToCartList($(this).attr('data-uid'), $(this).attr('data-num'), $(this).attr('data-uid'), $('#allOptionsSet' + $(this).attr('data-uid')).val());
    });

    // ���������� � wishlist
    $('body').on('click', '.addToWishList', function () {
        addToWishList($(this).attr('data-uid'));
    });

    // ���������� � compare
    $('body').on('click', '.addToCompareList', function () {
        addToCompareList($(this).attr('data-uid'));
    });

    // �������� ��������� �������������� �� ������� ��������
    $("#CheckMessage").on('click', function () {
        if ($("#message").val() != '')
            $("#forma_message").submit();
    });

    // ���������� �������
    if ($("#cartlink").attr('data-content') == "") {
        $("#cartlink").attr('href', '/order/');
    }
    $('[data-toggle="popover"]').popover();
    $('a[data-toggle="popover"]').on('show.bs.popover', function () {
        $('a[data-toggle="popover"]').attr('data-content', $("#visualcart_tmp").html());
    });

    // ��������� 
    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    // ���������� select
    $('.selectpicker').selectpicker({
        width: "100%"
    });

    // ������� �� ������ �� ����� � ���������
    $('#price-form').on('click', function (event) {
        event.preventDefault();
        if ($(this).attr('data-uid') != "" && $(this).attr('data-uid') != "ALL")
            window.location.replace("../shop/CID_" + $(this).attr('data-uid') + ".html");
    });

    // Ajax �����
    $("#search").on('input', function () {
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
                success: function (data) {

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
        } else {
            $("#search").attr('data-content', '');
            $("#search").popover('hide');

        }
    });
    // ��������� �����������
    if ($('#usersError').html()) {
        $('form[name=user_forma] .form-group').addClass('has-error has-feedback');
        $('form[name=user_forma] .glyphicon').removeClass('hide');
        $('#userModal').modal('show');
        $('#userModal').on('shown.bs.modal', function () {

        });
    }

    // �������� ������������ ������ �����������
    $("form[name=user_forma_register] input[name=password_new2]").on('blur', function () {
        if ($(this).val() != $("form[name=user_forma_register] input[name=password_new]").val()) {
            $('form[name=user_forma_register] #check_pass').addClass('has-error has-feedback');
            $('form[name=user_forma_register] .glyphicon').removeClass('hide');
        } else {
            $('form[name=user_forma_register] #check_pass').removeClass('has-error has-feedback');
            $('form[name=user_forma_register] .glyphicon').addClass('hide');
        }
    });

    // ����������� ������������
    $("form[name=user_forma_register]").on("submit", function () {
        if (
                $(this)
                .find("input[name=password_new]")
                .val() !=
                $(this)
                .find("input[name=password_new2]")
                .val()
                ) {
            $(this)
                    .find("#check_pass")
                    .addClass("has-error has-feedback");
            $(this)
                    .find(".glyphicon")
                    .removeClass("hide");
            return false;
        } else
            $(this).submit();
    });

    // ������ �����������
    if ($("#user_error").html()) {
        $("#user_error")
                .find(".list-group-item")
                .addClass("list-group-item-warning");
    }

    // ������ ����� ��������
    $(
            "form[name='forma_order'], input[name=returncall_mod_tel],input[name=tel]"
            ).on("click", function () {
        if (PHONE_FORMAT && PHONE_MASK && $(".bar-padding-fix").is(":hidden")) {
            $(
                    "input[name=tel_new], input[name=returncall_mod_tel],input[name=tel]"
                    ).mask(PHONE_MASK);
        }
    });

    if (body_width > 769) {

        $(".main-slider .zoom").elevateZoom({
            zoomType: "inner",
            cursor: "crosshair",

            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    }

    $('.zoomContainer').remove();
    $(window).resize(function () {

        if (body_width > 769) {

            $(".main-slider .zoom").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",

                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        }

        $('.zoomContainer').remove();

    })
    if (body_width > 769) {
        if ($(".bxslider").length) {
            $(".bxslider-pre").addClass("hide");
            $(".bxslider").removeClass("hide");

            slider = $(".product-1 .bxslider, .product-2 .bxslider, .product-3 .bxslider").bxSlider({
                controls: (body_width > 769) ? false : true,
                nextText: "",
                prevText: "",
                mode: (body_width > 769) ? "fade" : "horizontal",

                pager: ($(".bxslider>div").length > 1) ? true : false,
                pagerCustom: (body_width > 769) ? ".bx-pager" : null,
                infiniteLoop: true,
                onSliderLoad: function (currentIndex) {
                    $(".bxslider")
                            .children()
                            .eq(currentIndex + 1)
                            .addClass("active-slide");
                    $('.zoomContainer').remove();

                },
                onSlideAfter: function ($slideElement) {
                    $(".bxslider")
                            .children()
                            .removeClass("active-slide");
                    $slideElement.addClass("active-slide");
                    if (body_width > 769) {
                        $('.zoomContainer').remove();
                        $(".main-slider .active-slide > div").elevateZoom({
                            zoomType: "inner",

                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750
                        });
                    }
                }
            });
            $('.zoomContainer').remove();
            var width = $('.bx-wrapper').width();
            var height = $('.bx-wrapper .bx-viewport').height();
            if (body_width > 769) {
                thumbsSlider = $('.product-1 .bx-pager, .product-2 .bx-pager').bxSlider({
                    wrapperClass: 'wrap',
                    nextText: "",
                    prevText: "",
                    touchEnabled: false,
                    minSlides: 1,
                    maxSlides: (width < 248) ? 1 :
                            (width < 246) ? 2 :
                            (width < 369) ? 3 :
                            (width < 492) ? 4 :
                            (width < 615) ? 5 : 6,
                    slideMargin: 6,
                    moveSlides: 1,
                    infiniteLoop: false,
                    pager: false,
                    slideWidth: 90,
                });
            }
            vertSlider = $('.product-3 .bx-pager').bxSlider({
                wrapperClass: 'wrap-vert',
                mode: "vertical",
                pager: false,
                touchEnabled: false,
                adaptiveHeight: true,
                easing: 'easeInOutQuint',
                //displaySlideQty: visibleThumbs,
                //moveSlideQty: visibleThumbs,
                infiniteLoop: false,
                slideWidth: 90,
                minSlides: (height < 240) ? 1 :
                        (height < 360) ? 2 :
                        (height < 480) ? 3 :
                        (height < 600) ? 4 :
                        (height < 720) ? 5 : 6,
                slideMargin: 6,
            });
            $(".bx-controls").appendTo(".controls");

            $(".product-4 .bxslider div").removeClass('zoom');
            if (body_width > 769) {
                $(".bx-controls").on("click", ".bx-next", function () {
                    //   $('.zoomContainer').remove();
                    current = $(".bigslider .active-slide");
                    if ($(current).next('div').html() !== undefined) {
                        $(current).removeClass("active-slide");
                        $(current).css("display", "none");
                        $(current).siblings('div').css("display", "none");
                        $(current).next('div').addClass("active-slide");
                        $(current).next('div').css("display", "block");
                    }

                    $(".main-slider .active-slide > div").elevateZoom({
                        zoomType: "inner",

                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });



                });
            }
            if (body_width > 769) {
                $(".bx-controls").on("click", ".bx-prev", function () {
                    $('.zoomContainer').remove();
                    current = $(".bigslider .active-slide");
                    if ($(current).prev('div').html() !== undefined) {
                        $(current).removeClass("active-slide");
                        $(current).css("display", "none");
                        $(current).siblings('div').css("display", "none");
                        $(current).prev('div').addClass("active-slide");
                        $(current).prev('div').css("display", "block");
                    }
                    $(".main-slider .active-slide > div").elevateZoom({
                        zoomType: "inner",

                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });

                });
            }
        }
    } else {

        if ($('.bxslider').length) {
            $('.bxslider-pre').addClass('hide');
            $('.bxslider').removeClass('hide');
            slider = $('.bxslider').bxSlider({
                mode: 'fade',
                pagerCustom: null,
                controls: true
            });
        }

        if ($(".bx-default-pager .bx-pager-item+.bx-pager-item").length) {
            $(".bx-default-pager").css("visibility", "visible")
        }

    }
    setTimeout(function () {
        if (body_width < 769) {
            $.removeData($('.main-slider .zoom'), 'elevateZoom');
            $('.zoomContainer').remove();
            $('.zoom').removeClass("zoom")
        }
    }, 600);

    var before = $(this).width();
    $(window).resize(function () {
        var after = $(this).width();
        if (body_width > 767 && body_width < 1367) {
            if (after != before) {
                setTimeout(function () {
                    window.location.reload();
                }, 100);
            }
        }
    });

    // ������������� ����
    $(".collapse").on("show.bs.collapse", function () {
        $(this)
                .prev("h4")
                .find("i")
                .removeClass("fa-chevron-down");
        $(this)
                .prev("h4")
                .find("i")
                .addClass("fa-chevron-up");
        $(this)
                .prev("h4")
                .attr("title", "������");
    });
    $(".collapse").on("hidden.bs.collapse", function () {
        $(this)
                .prev("h4")
                .find("i")
                .removeClass("fa-chevron-up");
        $(this)
                .prev("h4")
                .find("i")
                .addClass("fa-chevron-down");
        $(this)
                .prev("h4")
                .attr("title", "��������");
    });

    $(".input-number").change(function () {
        var num = parseInt($(this).val());

        $(this)
                .closest(".addToCart")
                .children(".addToCartFull")
                .attr("data-num", num);
    });
    // ���������� � ������� ��������� ��������
    $("body").on("click", ".addToCartFull", function () {
        $(".cart").css("display", "block");
        // ������
        if ($("#parentSizeMessage").html()) {
            // ������
            if (
                    $('input[name="parentColor"]').val() === undefined &&
                    $('input[name="parentSize"]:checked').val() !== undefined
                    ) {
                addToCartList(
                        $('input[name="parentSize"]:checked').val(),
                        $('input[name="quant[2]"]').val(),
                        $('input[name="parentSize"]:checked').attr("data-parent")
                        );

                $(this).addClass("btn-success");
                $(this).text('� �������');
            }
            // ������  � ����
            else if (
                    $('input[name="parentSize"]:checked').val() > 0 &&
                    $('input[name="parentColor"]:checked').val() > 0
                    ) {
                var color = $('input[name="parentColor"]:checked').attr("data-color");
                var size = $('input[name="parentSize"]:checked').attr("data-name");
                var parent = $('input[name="parentColor"]:checked').attr("data-parent");

                $.ajax({
                    url: ROOT_PATH + "/phpshop/ajax/option.php",
                    type: "post",
                    data:
                            "color=" +
                            escape(color) +
                            "&parent=" +
                            parent +
                            "&size=" +
                            escape(size),
                    dataType: "json",
                    success: function (json) {
                        if (json["id"] > 0) {
                            if ($('input[name="parentSize"]:checked').val() > 0 && $('input[name="parentColor"]:checked').val() > 0) {
                                
                                addToCartList(json["id"], $('input[name="quant[2]"]').val(), $('input[name="parentColor"]:checked').attr("data-parent"));
                                
                                $(".addToCartFull[data-uid="+parent+"]").addClass("btn-success");
                                $(".addToCartFull[data-uid="+parent+"]").text('� �������');
                            } else
                                showAlertMessage($("#parentSizeMessage").html());
                            $(".input-number").change(function () {
                                var num = parseInt($(this).val());

                                $(this)
                                        .closest(".addToCart")
                                        .children(".addToCartFull")
                                        .attr("data-num", num);
                            });
                        }
                    }
                });
            } else
                showAlertMessage($("#parentSizeMessage").html());
        }
        // ����� ��������������
        else if ($("#optionMessage").html()) {
            var optionCheck = true;
            var optionValue = $("#allOptionsSet" + $(this).attr("data-uid")).val();
            $(".optionsDisp select").each(function () {
                if ($(this).hasClass("req") && optionValue === "")
                    optionCheck = false;
            });

            if (optionCheck) {
                addToCartList(
                        $(this).attr("data-uid"),
                        $('input[name="quant[2]"]').val(),
                        $(this).attr("data-uid"),
                        optionValue
                        );
                $(this).addClass("btn-success");
                $(this).text('� �������');
            } else
                showAlertMessage($("#optionMessage").html());
        }
        // ������� �����
        else {
            addToCartList(
                    $(this).attr("data-uid"),
                    $('input[name="quant[2]"]').val()
                    );
            $(this).addClass("btn-success");
            $(this).text('� �������');
        }
    });


    // ����� ����� 
    $('body').on('change', 'input[name="parentColor"]', function () {

        $('input[name="parentColor"]').each(function () {
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
            success: function (json) {
                if (json['id'] > 0) {

                    // ����� ����
                    $('[itemprop="price"]').html(json['price']);

                    // ����� ������ ����
                    if (json['price_n'] != "")
                        $('[itemscope] .old-price').html(json['price_n'] + '<span class="rubznak">' + $('[itemprop="priceCurrency"]').html() + '</span>');
                    else
                        $('[itemscope] .old-price').html('');

                    // ����� ��������
                    var parent_img = json['image'];
                    if (parent_img != "") {

                        $(".bx-pager img").each(function (index, el) {
                            if ($(this).attr('src') == parent_img) {
                                slider.goToSlide(index);
                            }

                        });
                    }

                }
            }
        });

    });

    // ����� �������
    $('body').on('change', 'input[name="parentSize"]', function () {
        var id = this.value;

        $('input[name="parentSize"]').each(function () {
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
                $('[itemscope] .old-price').html($(this).attr('data-priceold') + '<span class=rubznak>' + $('[itemprop="priceCurrency"]').html() + '</span>');
            else
                $('[itemscope] .old-price').html('');

            // ����� ��������
            var parent_img = $(this).attr('data-image');
            if (parent_img != "") {

                $(".bx-pager img").each(function (index, el) {
                    if ($(this).attr('src') == parent_img) {
                        slider.goToSlide(index);
                    }

                });
            }
        }

        $('.selectCartParentColor').each(function () {
            $(this).parent('label').removeClass('label_active');
            if ($(this).hasClass('select-color-' + id)) {
                $(this).parent('label').removeClass('not-active');
                $(this).parent('label').attr('title', $(this).attr('data-color'));

                $(this).val(id);
            } else {
                $(this).parent('label').addClass('not-active');
                $(this).parent('label').attr('title', '���');
            }
        });
    });

    // plugin bootstrap minus and plus http://jsfiddle.net/laelitenetwork/puJ6G/
    $(".btn-number").click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr("data-field");
        type = $(this).attr("data-type");
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == "minus") {
                if (currentVal > input.attr("min")) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr("min")) {
                    $(this).attr("disabled", true);
                }
            } else if (type == "plus") {
                if (currentVal < input.attr("max")) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr("max")) {
                    $(this).attr("disabled", true);
                }
            }
        } else {
            input.val(0);
        }
    });
    //  �������� �� ������������� cookie
    $('.cookie-message a').on('click', function (e) {
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

    // �������� �����
    $("input#order_metod").change(function () {
        $('.paymOneEl').removeClass('active');
        $(this).closest('.paymOneEl').addClass('active');
    });

});

// reCAPTCHA
if (
        $("#recaptcha_default").length ||
        $("#recaptcha_returncall").length ||
        $("#recaptcha_oneclick").length
        ) {
    var ga = document.createElement("script");
    ga.type = "text/javascript";
    ga.async = true;
    ga.defer = true;
    ga.src =
            "//www.google.com/recaptcha/api.js?onload=recaptchaCreate&render=explicit";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(ga, s);
}
recaptchaCreate = function () {
    if ($("#recaptcha_default").length)
        grecaptcha.render("recaptcha_default", {
            sitekey: $("#recaptcha_default").attr("data-key"),
            size: $("#recaptcha_default").attr("data-size")
        });

    if ($("#recaptcha_returncall").length)
        grecaptcha.render("recaptcha_returncall", {
            sitekey: $("#recaptcha_returncall").attr("data-key"),
            size: $("#recaptcha_returncall").attr("data-size")
        });

    if ($("#recaptcha_oneclick").length)
        grecaptcha.render("recaptcha_oneclick", {
            sitekey: $("#recaptcha_oneclick").attr("data-key"),
            size: $("#recaptcha_oneclick").attr("data-size")
        });
};