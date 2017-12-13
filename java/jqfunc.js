/**
 * ��������� jQuery �������
 * @package PHPShopJavaScript
 * @author PHPShop Software
 * @version 1.1
 */

// ������������ ��������� �������
var AJAX_SCROLL = false;

// HTML �������� �������� ��� ���� ��������
var waitText = '<span class="wait">&nbsp;</span>';
// ��������� � ������������� ����������� ��� ����, ����� �������� ����� � ������.
var commentAuthErrMess = "������� ���������� ����������� �������� ������ ��� �������������� �������������.\n<a href='" + dirPath() + "/users/?from=true'>������������� ��� �������� �����������</a>.";

// ����� ��������� ����� ���������� � �������, ���������, ������� � �.�.
function showAlertMessage(message) {
    var messageBox = '.success-notification';
    var innerBox = '#notification .notification-alert';

    //���� ��� �������� ��� ����������� �������, ������� ������� alert
    if ($(messageBox).length > 0) {
        $(innerBox).html(' ');
        $(innerBox).html(message);
        $(messageBox).fadeIn('slow');

        setTimeout(function() {
            $(messageBox).delay(500).fadeOut(1000);
        }, 7000);
    }
    else
        alert(message);
}

// �������� ��������� �� ����� �� ������ ��������
$('#notification img').live('click', function() {
    $(this).parent().fadeOut('slow', function() {
        $(this).hide();
    });
});

// �������� ���������� email
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// ���������� ������ � �������
function addToWishList(product_id) {

    // �������� ����������
    var dir = dirPath();

    $.ajax({
        url: dir + '/phpshop/ajax/wishlist.php',
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
function UpdateDeliveryJq(xid, obj) {
    var req = new Subsys_JsHttpRequest_Js();
    var sum = document.getElementById('OrderSumma').value;
    var wsum = document.getElementById('WeightSumma').innerHTML;

    $("form[name='forma_order'] input[name=dostavka_metod]").attr('disabled', true);
    $(this).html(waitText);

    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.responseJS) {
                document.getElementById('DosSumma').innerHTML = (req.responseJS.delivery || '');
                document.getElementById('d').value = xid;
                document.getElementById('TotalSumma').innerHTML = (req.responseJS.total || '');
                document.getElementById('seldelivery').innerHTML = (req.responseJS.dellist || '');
                
                // ���� ���� ��������
                if(typeof(req.responseJS.hook))
                    eval(req.responseJS.hook);

                $("#userAdresData").hide();
                document.getElementById('userAdresData').innerHTML = (req.responseJS.adresList || '');
                $("#userAdresData").fadeIn("slow");

                // ��������� ��� ��������� �� ������ ������
                if ($("form[name='forma_order'] input[name='fio_new']").val() == "")
                    $("form[name='forma_order'] input[name='fio_new']").val($("form[name='forma_order'] input[name='name_new']").val());

                //��������� ������� �����, ���� ������
                $("#adres_id").change();
            }
        }
    }
    req.caching = false;
    // �������������� ������.
    // �������� ����������
    var dir = dirPath();

    req.open('POST', dir + '/phpshop/ajax/delivery.php', true);
    req.send({
        xid: xid,
        sum: sum,
        wsum: wsum
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

//alert($(this).attr('name') + $(this).val());
        if ($(this).val() == "" || (badReqEmail && $(this).attr('name') == 'mail') || (badReqName && $(this).attr('name') == 'name_new')) {
            // ��������� �� ����� �� ������ ������� ������������ ����
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
        if (str != "" && $(str))
            $("#showYurDataForPaymentLoad").html($(str).html());
        else
            $("#showYurDataForPaymentLoad").html($(str).html());
    });
    // �������� ������ � ������ ������.
    $("input#order_metod:first").attr('checked', 'checked').change();


    // ��� ��������� ������, ��������� �����. ����
    $("#adres_id").change(function() {
        var str = "";
        $("#adres_id option:selected").each(function() {
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
    $("form[name='forma_order'] select.citylist").live('change', function() {
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
        var dir = dirPath();
        $.ajax({
            url: dir + '/phpshop/ajax/citylist.php',
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
    $("form[name='forma_order'] input[name=dostavka_metod]").live('click', function() {
        $(this).next().after(waitText);
        UpdateDeliveryJq($(this).val());
    });



    // ��� ����� ����� ������������, ��������� ����������� ��� � ����� ���� �� ����
    $("form[name='forma_order'] input[name=name_new]").live('change', function() {
        if ($("form[name='forma_order'] input[name='fio_new']").val() == "")
            $("form[name='forma_order'] input[name='fio_new']").val($(this).val());
    });

    // ��������� ����� ������� ��������� ��� ������������ ����� ��� �������� �� ���
    $('form[name="forma_order"] .req').live('keyup blur change', function() {
        if ($(this).val() != '')
            $(this).removeClass('reqActiv');
        else
            $(this).addClass('reqActiv');
    });

    //*******************������ � �������***************** 
    // ���� �� �����������, ��� ������� ������ �����, ������� ���������, ��� ���������� �����������.
    $('textarea.commentTextarea').live('focus', function() {
        if ($('input#commentAuthFlag').val() == 0) {
            $(this).val("").attr('readonly', 'readonly');
            showAlertMessage(commentAuthErrMess);
            if (document.getElementById('evalForCommentAuth')) {
                eval(document.getElementById('evalForCommentAuth').value);
            }
        }
    });
});