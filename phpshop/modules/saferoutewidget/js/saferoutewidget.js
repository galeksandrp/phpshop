function saferoutewidgetStart() {
    $('input[name="saferouteReq"]').remove();

    var products = $.parseJSON($("input:hidden.cartListJson").val());

    if(!$('input').is('[name="saferouteSum"]')) { $('<input type="hidden" name="saferouteSum" id="saferouteSum">').insertAfter('#d'); }
    if(!$('input').is('[name="saferouteReq"]')) { $('<input type="hidden" name="saferouteReq" class="req form-control">').insertAfter('#dop_info'); }
    if(!$('input').is('[name="saferouteDop"]')) { $('<input type="hidden" name="saferouteDop">').insertAfter('#dop_info'); }
    if(!$('input').is('[name="saferouteData"]')) { $('<input type="hidden" name="saferouteData">').insertAfter('#dop_info'); }

    var widget = new SafeRouteCartWidget("saferoute-widget", {
        apiScript: "/phpshop/modules/saferoutewidget/api/saferoute-widget-api.php",
        products: products,
        weight: $("#ddweight").val()
    });

    widget.on("error", function (errors) {
        // Вызовется при возникновении ошибок при обработке запроса,
        // при передаче в виджет некорректных или неполных данных
        console.error(errors);
    });

    widget.on("done", function (response) {
        // Вызовется при получении ответа от сервера DDelivery

        $('<input type="hidden" name="saferouteToken" value="' + response.id + '">').insertAfter('#d');
        $('input[name="saferouteReq"]').val($('input[name="saferouteDop"]').val());
        $('#saferoute-close').text('Продолжить').addClass('btn-success');
    });

    widget.on("change", function (data) {
        if(data['delivery']) {
            if(data.delivery.type === 1) {
                var info = 'ПВЗ: ' + data.delivery.deliveryCompanyName;
                info = info + ', срок: ' + data.delivery.deliveryDate;
                if(data['city']) {
                    info = info +', адрес ПВЗ: ' + data.city.name + ' ' + data.delivery.point.address;
                }
                if(data['contacts']['phone']) {
                    info = info + ', телефон: ' + data.contacts.phone;
                }
            } else {
                var info = 'Доставка: ' + data.delivery.deliveryCompanyName;
                info = info + ', срок: ' + data.delivery.deliveryDate;
                if(data['contacts']) {
                    if(!data.contacts.address.zipCode) {
                        data.contacts.address.zipCode = '';
                    }
                    info = info + ', адрес: ' + data.contacts.address.zipCode + ' ' + data.city.name;
                    if(data.contacts.address.street) {
                        info = info + ' ул.' + data.contacts.address.street;
                    }
                    if(data.contacts.address.building) {
                        info = info + ' д.' + data.contacts.address.building;
                    }
                    if(data.contacts.address.apartment) {
                        info = info + ' кв.' + data.contacts.address.apartment;
                    }
                    if(data.contacts.phone) {
                        info = info + ', телефон: ' + data.contacts.phone;
                    }
                }
            }

            var del_sum = data.delivery.totalPrice;

            $('input[name="saferouteDop"]').val(info);
            $('#deliveryInfo').html(info);

            var total = Number(del_sum) + Number($('#OrderSumma').val());
            $("#DosSumma").html(del_sum);
            $("#TotalSumma").html(total.toFixed(2));
            $('#saferouteSum').val(del_sum);
        }

        $('input[name="name_new"]').val(data.contacts.fullName);
        $('input[name="fio_new"]').val(data.contacts.fullName);


        if(data['contacts']) {
            if(data.contacts.phone) $('input[name="tel_new"]').val(data.contacts.phone.substring(1));
            $('input[name="flat_new"]').val(data.contacts.address.flat);
            $('input[name="house_new"]').val(data.contacts.address.house);
            $('input[name="street_new"]').val(data.contacts.address.street);
            $('input[name="index_new"]').val(data.contacts.address.index);
        }
        if(data['city']) {
            $('input[name="city_new"]').val(data.city.name);
        }

        $('input[name="saferouteData"]').val(JSON.stringify(data, null, 0));

        // Hook
        if ($.isFunction(window.saferoutewidgetHook))
            saferoutewidgetHook(data);
    });

    $("#saferoutewidgetModal").modal("toggle");
}