/**
 * ��������� JQuery �������
 * @package PHPShopJavaScript
 * @author PHPShop Software
 * @version 1.4
 */

// ������ � �������� ���� ���������
var MEGA_MENU_ICON = false;

// ���� ����������� ��������� �����������. ������������ ��� ������� ��������� � ������� bootstrap
var CATALOG_MENU = true;

// �������� ������
var FILTER = true;

// ����� �������
var BRAND_MENU = true;

// ������������ ��������� �������
var AJAX_SCROLL = true;

// ���������� ��������� ��� ������������ ��������� �������
var AJAX_SCROLL_HIDE_PAGINATOR = false;

// ����� ���������� �� �����
var ROOT_PATH = '';

// �������� �������� ����
var FIXED_NAVBAR = true;

// ������ ����� ��������
var PHONE_FORMAT = true;
var PHONE_MASK = "(999) 999-9999";

// DaData.ru Token
var DADATA_TOKEN = false;

// HTML �������� �������� ��� ���� ��������
var waitText = '<span class="wait">&nbsp;</span>';
// ��������� � ������������� ����������� ��� ����, ����� �������� ����� � ������.
var commentAuthErrMess = "������� ���������� ����������� �������� ������ ��� �������������� �������������.\n<a href='" + ROOT_PATH + "/users/?from=true'>������������� ��� �������� �����������</a>.";

// ����� ��������� ����� ���������� � �������, ���������, ������� � �.�.
function showAlertMessage(message, danger) {

    if (typeof danger != 'undefined') {
        if (danger === true)
            danger = 'danger';
        $('.success-notification').find('.alert').addClass('alert-' + danger);
    }
    else {
        $('.success-notification').find('.alert').removeClass('alert-danger');
        $('.success-notification').find('.alert').removeClass('alert-info');
    }


    var messageBox = '.success-notification';
    var innerBox = '#notification .notification-alert';

    //���� ��� �������� ��� ����������� �������, ������� ������� alert
    if ($(messageBox).length > 0) {
        $(innerBox).html(' ');
        $(innerBox).html(message);
        $(messageBox).fadeIn('slow');

        setTimeout(function() {
            $(messageBox).delay(500).fadeOut(1000);
        }, 5000);
    }
    else
        alert(message);
}

// �������� ���������� email
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// ���������� ������ � �������
function addToWishList(product_id) {

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/wishlist.php',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
            if (json['success']) {
                showAlertMessage(json['message']);
                $(".wishlistcount").html(json['count']);
            }
        }
    });
}

// ������� ��������
function UpdateDeliveryJq(xid, param, stop_hook) {

    var sum = $("#OrderSumma").val();
    var wsum = $("#WeightSumma").html();

    $("form[name='forma_order'] input[name=dostavka_metod]").attr('disabled', true);
    $(this).html(waitText);

    $.ajax({
        url: ROOT_PATH + '/phpshop/ajax/delivery.php',
        type: 'post',
        data: 'type=json&xid=' + xid + '&sum=' + sum + '&wsum=' + wsum + param,
        dataType: 'json',
        success: function(json) {
            if (json['success']) {
                $("#DosSumma").html(json['delivery']);
                $("#d").val(xid);
                $("#TotalSumma").html(json['total']);
                $("#seldelivery").html(json['dellist']);


                $("#userAdresData").hide();
                $("#seldelivery").html(json['userAdresData']);
                $("#userAdresData").html(json['adresList']);
                $("#userAdresData").fadeIn("slow");

                $('#deliveryInfo').html(null);

                // ���������� �������� �����
                var paymentStop = $("input#dostavka_metod:checked").attr('data-option');
                if (paymentStop !== undefined)
                    var payment_array = paymentStop.split(",");

                $('input[name="order_metod"]').each(function() {
                    $(this).attr('disabled', false);
                });

                if ($.isArray(payment_array)) {
                    $.each(payment_array, function(index, value) {
                        $('input[data-option="payment' + value + '"]').attr('disabled', true);
                        $('input[data-option="payment' + value + '"]').attr('checked', false);
                    });
                }

                if ($("input#order_metod:checked").length == 0) {
                    $('input#order_metod').each(function() {
                        if (!this.disabled) {
                            this.checked = true;
                            return false;
                        }
                    });
                }

                // ���� ���� ��������
                if (json['hook'] !== undefined && json['hook'] !== "" && stop_hook === undefined) {
                    eval(json['hook']);
                }

                // ��������� ��� ��������� �� ������ ������
                if ($("form[name='forma_order'] input[name='fio_new']").val() == "")
                    $("form[name='forma_order'] input[name='fio_new']").val($("form[name='forma_order'] input[name='name_new']").val());

                //��������� ������� �����, ���� ������
                $("#adres_id").change();

                // ��������� DaData.ru
                if (typeof $('#body').attr('data-token') !== 'undefined' && $('#body').attr('data-token').length)
                    var DADATA_TOKEN = $('#body').attr('data-token');
                if (DADATA_TOKEN !== false && DADATA_TOKEN !== undefined) {
                    var
                            token = DADATA_TOKEN,
                            type = "ADDRESS",
                            $city = $("form[name='forma_order'] input[name='city_new']"),
                            $street = $("form[name='forma_order'] input[name='street_new']"),
                            $house = $("form[name='forma_order'] input[name='house_new']");

                    $city.suggestions({
                        token: token,
                        type: type,
                        hint: false,
                        bounds: "city-settlement",
                        onSelect: showPostalCode,
                        onSelectNothing: clearPostalCode
                    });

                    $street.suggestions({
                        token: token,
                        type: type,
                        hint: false,
                        bounds: "street",
                        constraints: $city,
                        onSelect: showPostalCode,
                        onSelectNothing: clearPostalCode
                    });

                    $house.suggestions({
                        token: token,
                        type: type,
                        hint: false,
                        bounds: "house",
                        constraints: $street,
                        onSelect: showPostalCode,
                        onSelectNothing: clearPostalCode
                    });
                    function showPostalCode(suggestion) {
                        $("[name='index_new']").val(suggestion.data.postal_code);
                    }
                    function clearPostalCode() {
                        $("[name='index_new']").val("");
                    }
                    /*
                     $("form[name='forma_order'] input[name='fio_new']").suggestions({
                     token: DADATA_TOKEN,
                     type: "NAME",
                     count: 5
                     });*/
                    $("form[name='forma_order'] input[name='org_name_new']").suggestions({
                        token: DADATA_TOKEN,
                        type: "PARTY",
                        count: 5
                    });
                }
            }
        }
    });
}


// �������� ������ ������
// �������� ����� ������
function OrderChekJq()
{

    if ($("#makeyourchoise").val() != "DONE") {
        bad = 1;
    } else {
        bad = 0;
    }

    var badReq = 0;
    var badReqName = 0;
    var badReqEmail = 0;
//    $('form[name="forma_order"] input.req, form[name="forma_order"] select.req').each(function() {
    $('form[name="forma_order"] .req').each(function() {


        // ��������� ���������� e-mail � ��� ������������
        if ($(this).attr('name') == 'mail' && !IsEmail($(this).val()))
            badReqEmail = 1;

        if ($(this).attr('name') == 'name_new')
            if ($(this).val().length < 3)
                badReqName = 1;

        if ($(this).val() == "" || ($(this).attr('name') == 'rule' && $(this).prop('checked') == false) || (badReqEmail && $(this).attr('name') == 'mail') || (badReqName && $(this).attr('name') == 'name_new')) {
            // ��������� �� ����� �� ����� ������� ������������ ����
            if (badReq == 0) {
                var destination = $(this).parent().offset().top;
                var par = $(this);
                jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800, function() {
                    par.focus();
                });
            }

            if (badReq == 0)
                badReq = 1;
            $(this).addClass('reqActiv');
        }

    }
    );
    if (badReqEmail == 1) {
        showAlertMessage("������ ���������� ����� ������.\n������� ���������� E-mail �����! ");
    } else if (badReqName == 1) {
        showAlertMessage("������ ���������� ����� ������.\n��� ������ �������� �� ����� ��� �� 3 ����!");
    } else if (badReq == 1) {
        showAlertMessage("������ ���������� ����� ������.\n������ ���������� * ����������� ��� ����������! ");
    } else if (bad == 1) {
        showAlertMessage("������ ���������� ����� ������.\n�������� ��������!");
        var destination = $('#seldelivery').offset().top;
        jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
    } else {
        $('form[name="forma_order"]').submit();
    }
}

// ������� ��������� ������
function wpiGenerateRandomNumber(limit) {

    limit = limit || 8;

    var password = '';

    var chars = 'abcdefghijklmnopqrstuvwxyz0123456789';

    var list = chars.split('');
    var len = list.length, i = 0;

    do {

        i++;

        var index = Math.floor(Math.random() * len);

        password += list[index];

    } while (i < limit);

    return password;

}

$(document).ready(function() {

    // DaData.ru �����
    if (typeof $('#body').attr('data-token') !== 'undefined' && $('#body').attr('data-token').length)
        var DADATA_TOKEN = $('#body').attr('data-token');

    // �������� ��������� �� ����� �� ������ ��������
    $('#notification').on('click', 'img', function() {
        $(this).parent().fadeOut('slow', function() {
            $(this).hide();
        });
    });


    //*******************�����������, ���������� ������***************** 
    // ������ ��������� ������ ��� �����������
    $(".passGen").click(function() {
        var str = wpiGenerateRandomNumber(8);
        $(this).closest('form').find("input[name='password_new'], input[name='password_new2']").val(str);
        showAlertMessage('��� ��������������� ������ ����� ������ �� ��� email ����� ���������� �����������...');
    });

    // ���������� ������ � �� ������ ��� ������ ��� �����
    $('form').on('reset', function(e) {
        setTimeout(function() {
            $("#order_metod").change();
        });
    });

    // ��� ����� ������� ������, ���� ������ ������� ��. ����, ������� ��
    // ������� ����� ������� ���������� ���������� �������
//    $("#order_metod").change(function() {
//        var str = "";
//        $("#order_metod option:selected").each(function() {
//            str = ".showYurDataForPaymentClass" + $(this).val();
//        });
//        if (str != "" && $(str))
//            $("#showYurDataForPaymentLoad").html($(str).html());
//        else
//            $("#showYurDataForPaymentLoad").html($(str).html());
//    }).change();

    // �������� ����� ��������� ������������.
    $("input#order_metod").change(function() {
        var str = "";
        str = ".showYurDataForPaymentClass" + $("input#order_metod:checked").val();
        if (str != "" && $(str).html()) {
            $("#showYurDataForPaymentLoad").html($(str).clone().removeClass().show());
            if (DADATA_TOKEN !== false && DADATA_TOKEN !== undefined) {
                $("#showYurDataForPaymentLoad input[name='org_name_new']").suggestions({
                    token: DADATA_TOKEN,
                    type: "PARTY",
                    count: 5,
                    onSelect: showSuggestion
                });
                $("#showYurDataForPaymentLoad input[name='org_bank_new']").suggestions({
                    token: DADATA_TOKEN,
                    type: "BANK",
                    count: 5,
                    onSelect: showSuggestionBank
                });
            }
        }
        else {
            $("#showYurDataForPaymentLoad").html('');
        }
    });
    // �������� ������ � ������ ������.
    $("input#order_metod:first").attr('checked', 'checked').change();

    // ��� ��������� ������, ��������� �����. ����
    $("#adres_id").change(function() {
        var str = "";
        $(this).find("option:selected").each(function() {
            str = $(this).val();
        });
        if (!str)
            return;


        // �������� ������ ������� 
        var obj = jQuery.parseJSON($("input:hidden.adresListJson").val());
        // �������� ���������� ������
        //$(this).closest('form').find("input:text").val("");
        $.each(obj, function(index, value) {
            $.each(value, function(index2, value2) {
                $("input[name='" + index2 + "']").val("");
            });
        });


        $.each(obj[str], function(index, value) {
            if (value != "") {
                name = "input[name='" + index + "']";
                $(name).val(value);
                $(name).removeClass('reqActiv');
            }
        });
    }).change();

    // ������ ������� �� ������
    $("form[name='forma_order']").on('change', 'select.citylist', function() {
        var par = $(this).attr("name");
        if (par == "city_new")
            return false;
        if (par == "country_new") {
            $("form[name='forma_order'] select.citylist[name=city_new] option[value!='']").remove();
            $("form[name='forma_order'] select.citylist[name=state_new] option[value!='']").remove();
        }
        if (par == "state_new") {
            $("form[name='forma_order'] select.citylist[name=city_new] option[value!='']").remove();
        }

        $("form[name='forma_order'] select.citylist").attr("disabled", true);
        $(this).after(waitText);
        $.ajax({
            url: ROOT_PATH + '/phpshop/ajax/citylist.php',
            type: 'post',
            data: {
                country: $("form[name='forma_order'] select.citylist[name=country_new] option:selected").attr('for'),
                region: $("form[name='forma_order'] select.citylist[name=state_new] option:selected").attr('for'),
                par: par
            },
            //dataType: 'xml',
            success: function(data) {
                $("#citylist .wait").remove();
                $("form[name='forma_order'] select.citylist[name=country_new]").attr("disabled", false);
                switch (par) {
                    case "country_new":
                        $("form[name='forma_order'] select.citylist[name=state_new]").html(data);
                        $("form[name='forma_order'] select.citylist[name=state_new]").attr("disabled", false);
                        break;
                    case "state_new":
                        $("form[name='forma_order'] select.citylist[name=city_new]").html(data);
                        $("form[name='forma_order'] select.citylist[name=city_new]").attr("disabled", false);
                        $("form[name='forma_order'] select.citylist[name=state_new]").attr("disabled", false);
                        break;
                }
            }
        });
    });

    // ����� ������� ��������
    $("form[name='forma_order']").on('click', 'input[name=dostavka_metod]', function() {
        $(this).next().after(waitText);
        UpdateDeliveryJq($(this).val());
    });



    // ��� ����� ����� ������������, ��������� ����������� ��� � ����� ���� �� ����
    $("form[name='forma_order']").on('change', 'input[name=name_new]', function() {
        if ($("form[name='forma_order'] input[name='fio_new']").val() == "")
            $("form[name='forma_order'] input[name='fio_new']").val($(this).val());
    });

    // ��������� ����� ������� ��������� ��� ������������ ����� ��� �������� �� ���
    $('form[name="forma_order"]').on('keyup blur change', '.req', function() {
        if ($(this).val() != '')
            $(this).removeClass('reqActiv');
        else
            $(this).addClass('reqActiv');
    });

    //*******************������ � �������***************** 
    // ���� �� �����������, ��� ������� ������ �����, ������� ���������, ��� ���������� �����������.
    $('textarea.commentTextarea').on('focus', function() {
        if ($('input#commentAuthFlag').val() == 0) {
            $(this).val("").attr('readonly', 'readonly');
            showAlertMessage(commentAuthErrMess);
            if (document.getElementById('evalForCommentAuth')) {
                eval(document.getElementById('evalForCommentAuth').value);
            }
        }
    });


    // ��������� ������ � �������
    var cart_lang = [];
    for (var i = 0; i < 100; i++) {
        cart_lang[i] = '��';
    }
    cart_lang[1] = '';
    cart_lang[2] = '�';
    cart_lang[3] = '�';
    cart_lang[4] = '�';
    cart_lang[21] = '';
    cart_lang[22] = '�';
    cart_lang[23] = '�';
    cart_lang[24] = '�';
    if (cart_lang[$('#num').text()] != 'undefined')
        $('#lang-cart').text('�����' + cart_lang[$('#num').text()]);

    $(".button").click(function() {
        setTimeout(function() {
            if (cart_lang[$('#num').text()] != 'undefined')
                $('#lang-cart').text('�����' + cart_lang[$('#num').text()]);
        }, 1000);
    });

});
// ����� ��������� DaData.ru � ����� ����������� ������
function showSuggestion(suggestion) {
    var data = suggestion.data;
    if (!data)
        return;
    $("input[name='org_inn_new']").val(data.inn);
    $("input[name='org_kpp_new']").val(data.kpp);
    $("input[name='org_yur_adres_new']").val(data.address.value);
    $("input[name='org_fakt_adres_new']").val(data.address.value);
}
function showSuggestionBank(suggestion) {
    var data = suggestion.data;
    if (!data)
        return;
    $("input[name='org_bik_new']").val(data.bic);
    $("input[name='org_city_new']").val(data.address.data.city);
    $("input[name='org_kor_new']").val(data.correspondent_account);
}