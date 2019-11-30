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
        weight: $("#ddweight").val(), 
        //stopSubmit: true
    });
    
    widget.on("error", function (errors) {
        // ��������� ��� ������������� ������ ��� ��������� �������,
        // ��� �������� � ������ ������������ ��� �������� ������
        console.error(errors);
    }); 
    
    widget.on("afterSubmit", function (response) {
    // ��������� ��� ��������� ������ �� ������� DDelivery
        
        $('<input type="hidden" name="saferouteToken" value="' + response.id + '">').insertAfter('#d');
        $('input[name="saferouteReq"]').val($('input[name="saferouteDop"]').val());
        $('#saferoute-close').text('����������').addClass('btn-success');
    });       
    
    widget.on("beforeSubmit", function (data) {
        if(typeof data.delivery!=="undefined") {
            if(typeof data.delivery.point!=="undefined") {
                var info = '���: ' + data.delivery.point.delivery_company_name;
                info = info + ', ����: ' + data.delivery.point.delivery_date;
                info = info +', ����� ���: ' + data.city.name + ' ' + data.delivery.point.address;
                info = info + ', �������: ' + data.contacts.phone;  
                var del_sum = data.delivery.point.price_delivery;
            } else {
                var info = '��������: ' + data.delivery.delivery_company_name;
                info = info + ', ����: ' + data.delivery.delivery_date;
                info = info + ', �����: ' + data.contacts.address.index + ' ' + data.city.name + ' ��.' + data.contacts.address.street + ' �.' + data.contacts.address.house + ' ��.' + data.contacts.address.flat;
                info = info + ', �������: ' + data.contacts.phone;  
                var del_sum = data.delivery.total_price;
            }
            $('input[name="saferouteDop"]').val(info);
            $('#deliveryInfo').html(info);

            $("#DosSumma").html(del_sum);
            $("#TotalSumma").html(Number(del_sum) + Number($('#OrderSumma').val()));
            $('#saferouteSum').val(del_sum);
        }

        $('input[name="name_new"]').val(data.contacts.fullName);
		$('input[name="fio_new"]').val(data.contacts.fullName); 
		if(data.contacts.phone) $('input[name="tel_new"]').val(data.contacts.phone.substring(1)); 
        $('input[name="city_new"]').val(data.city.name);
        $('input[name="flat_new"]').val(data.contacts.address.flat);
        $('input[name="house_new"]').val(data.contacts.address.house);
        $('input[name="street_new"]').val(data.contacts.address.street);
        $('input[name="index_new"]').val(data.contacts.address.index);
        
        $('input[name="saferouteData"]').val(JSON.stringify(data, null, 0));
        
        // Hook
        if ($.isFunction(window.saferoutewidgetHook))
            saferoutewidgetHook(data);
    });      

    $("#saferoutewidgetModal").modal("toggle");
}

/*
function ddeliverywidgetHook(data) {
    
    // ���������� �� ������
    if (data.city.name != '������') {

        // ���������� �������� �����
        var paymentStop = '3'; // �� ������ ����� �������
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
    }
}*/