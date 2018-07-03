function ddeliverywidgetStart() {

    var products = $.parseJSON($("input:hidden.cartListJson").val());
    $('<input type="hidden" name="ddeliverySum" id="ddeliverySum">').insertAfter('#d');
    $('<input type="hidden" name="ddeliveryReq" class="req form-control">').insertAfter('#dop_info');

    var widget = new DDeliveryWidgetCart("dd-widget", {
        apiScript: "/phpshop/modules/ddeliverywidget/api/dd-widget-api.php",
        products: products,
        weight: $("#ddweight").val(), 
        //stopSubmit: true
    });
    
    //widget.on("error", function (errors) {
        // ��������� ��� ������������� ������ ��� ��������� �������,
        // ��� �������� � ������ ������������ ��� �������� ������
        //console.error(errors);
    //}); 
    
    widget.on("afterSubmit", function (response) {
    // ��������� ��� ��������� ������ �� ������� DDelivery
        
        $('<input type="hidden" name="ddeliveryToken" value="' + response.id + '">').insertAfter('#d');
        $('#ddelivery-close').text('����������').addClass('btn-success');
    });       
    
    widget.on("change", function (data) {
    // ��������� ��� ��������� ���������� ������� ��������
    // ��� ������ ������� �������� � �������
        if(typeof data.delivery.point!=="undefined") {
            var info = '���: ' + data.delivery.point.delivery_company_name;
            info = info + ', ����: ' + data.delivery.point.delivery_date;
            info = info +', ����� ���: '+data.delivery.point.address;
            var del_sum = data.delivery.point.price_delivery;
        } else {
            var info = '��������: ' + data.delivery.delivery_company_name;
            info = info + ', ����: ' + data.delivery.delivery_date;
            var del_sum = data.delivery.total_price;
        }
        $('input[name="ddeliveryReq"]').val(info);

        $("#DosSumma").html(del_sum);
        $("#TotalSumma").html(Number(del_sum) + Number($('#OrderSumma').val()));
        $('#ddeliverySum').val(del_sum);

        //$('input[name="name_new"]').val(data.contacts.address.index);
        $('input[name="city_new"]').val(data.city.name);
        $('input[name="flat_new"]').val(data.contacts.address.flat);
        $('input[name="house_new"]').val(data.contacts.address.house);
        $('input[name="street_new"]').val(data.contacts.address.street);
        $('input[name="index_new"]').val(data.contacts.address.index);
        
    });      

    $("#ddeliverywidgetModal").modal("toggle");
}


function ddeliverywidgetReset() {
    $('input[name="ddeliveryReq"]').remove();
}

/*
function ddeliverywidgetHook(data) {
    
    // ���������� �� ������
    if (data['city_name'] != '������') {

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