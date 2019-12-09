function cdekwidgetStart() {
    $('input[name="cdekSum"]').remove();
    $('input[name="cdekInfo"]').remove();
    $('input[name="cdek_pvz_id"]').remove();
    $('input[name="cdek_city_id"]').remove();
    $('input[name="cdek_type"]').remove();
    $('input[name="cdek_tariff"]').remove();

    var defaultCity = $('#cdekwidgetdefaultCity').val();
    var cityFrom = $('#cdekwidgetCityFrom').val();
    var cdekProducts = $.parseJSON($('.cdekProducts').val());

    var widjet = new ISDEKWidjet({
        defaultCity: defaultCity,
        cityFrom: cityFrom,
        link: 'forpvz',
        popup: true,
        path: '../phpshop/modules/cdekwidget/templates/scripts/',
        servicepath: '../phpshop/modules/cdekwidget/api/service.php',
        templatepath: '../phpshop/modules/cdekwidget/templates/scripts/template.php',
        goods: cdekProducts,
        onChoose: cdekWidgetOnChoose,
        onChooseProfile: onChooseProfile
    });

    $('<input type="hidden" name="cdekSum" id="cdekSum">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdekInfo">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_pvz_id">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_city_id">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_type">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_tariff">').insertAfter('#dop_info');

    $("#makeyourchoise").val(null);

    $("#cdekwidgetModal").modal("toggle");
}

function cdekWidgetOnChoose(result) {
    var info = '��� ���������� ���: ' + result.id + ', ������ ���: ' + result.PVZ.PostalCode + ', ����� ' + result.cityName + ', ����� ���������� ��� ' + result.PVZ.Address + ', ������� ���������� ��� ' + result.PVZ.Phone;

    $('input[name="cdekInfo"]').val(info);
    $('input[name="cdek_city_id"]').val(result.city);
    $('input[name="cdek_type"]').val('pvz');
    $('input[name="cdek_pvz_id"]').val(result.id);
    $('input[name="cdek_tariff"]').val(result.tarif);
    $("#DosSumma").html(result.price);
    $("#TotalSumma").html(Number(result.price) + Number($('#OrderSumma').val()));
    $('#cdekSum').val(result.price);
    $('input[name="city_new"]').val(result.cityName);
    $('#deliveryInfo').html('���: ' + result.PVZ.Address);

    $("#makeyourchoise").val('DONE');

    $("#cdekwidgetModal").modal("hide");
}
function onChooseProfile(result) {
    var info = '���������� ��������: ����� ' + result.cityName;

    $('input[name="cdekInfo"]').val(info);
    $('input[name="cdek_city_id"]').val(result.city);
    $('input[name="cdek_type"]').val(result.id);
    $('input[name="cdek_tariff"]').val(result.tarif);
    $("#DosSumma").html(result.price);
    $("#TotalSumma").html(Number(result.price) + Number($('#OrderSumma').val()));
    $('#cdekSum').val(result.price);
    $('input[name="city_new"]').val(result.cityName);
    $('#deliveryInfo').html('���������� ��������: ����� ' + result.cityName);

    $("#cdekwidgetModal").modal("hide");
}
