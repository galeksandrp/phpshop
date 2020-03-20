function cdekwidgetWidget() {
    var path = '../phpshop/';
    if(Number(PHPShopCDEKOptions.admin) === 1) {
        path = '../';
    }

    new ISDEKWidjet({
        defaultCity: PHPShopCDEKOptions.defaultCity,
        country: '������',
        cityFrom: PHPShopCDEKOptions.cityFrom,
        link: 'forpvz',
        popup: true,
        path: path + 'modules/cdekwidget/templates/scripts/',
        servicepath: path + 'modules/cdekwidget/api/service.php',
        templatepath: path + 'modules/cdekwidget/templates/scripts/template.php',
        goods: PHPShopCDEKOptions.products,
        onChoose: cdekWidgetOnChoosePvz,
        onChooseProfile: cdekwidgetOnChooseProfile,
        apikey: PHPShopCDEKOptions.ymapApiKey
    });
}

// �������� �� ���. �������
function cdekWidgetOnChoosePvz(result) {
    var info = '��� ���������� ���: ' + result.id + ', ����� ' + result.cityName + ', ����� ���������� ��� ' + result.PVZ.Address + ', ������� ���������� ��� ' + result.PVZ.Phone;

    $('input[name="cdekInfo"]').val(info);
    $('input[name="cdek_pvz_id"]').val(result.id);
    $('input[name="cdek_type"]').val('pvz');
    $('#deliveryInfo').html('���: ' + result.PVZ.Address);

    cdekwidgetOnChoose(result);
}

// ���������� ��������. �������
function cdekwidgetOnChooseProfile(result) {
    var info = '���������� ��������: ����� ' + result.cityName;

    $('input[name="cdek_type"]').val('courier');
    $('input[name="cdekInfo"]').val(info);
    $('#deliveryInfo').html('���������� ��������: ����� ' + result.cityName);

    cdekwidgetOnChoose(result);
}

// ����� ������ ��� ����� ��������. �������
function cdekwidgetOnChoose(result) {
    $("#cdekwidgetModal").modal("hide");

    if(Number(PHPShopCDEKOptions.admin) === 1) {
        cdekAdminWidgetOnChoose(result);
    } else {
        $("#makeyourchoise").val('DONE');
        $('input[name="city_new"]').val(result.cityName);
        $('#cdekSum').val(result.price);
        $("#DosSumma").html(result.price);
        $("#TotalSumma").html(Number(result.price) + Number($('#OrderSumma').val()));
    }

    $('input[name="cdek_city_id"]').val(result.city);
    $('input[name="cdek_tariff"]').val(result.tarif);
}

function cdekwidgetStart(admin = false) {
    $('input[name="cdekSum"]').remove();
    $('input[name="cdekInfo"]').remove();
    $('input[name="cdek_pvz_id"]').remove();
    $('input[name="cdek_city_id"]').remove();
    $('input[name="cdek_type"]').remove();
    $('input[name="cdek_tariff"]').remove();

    $('<input type="hidden" name="cdekSum" id="cdekSum">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdekInfo">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_pvz_id">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_city_id">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_type">').insertAfter('#dop_info');
    $('<input type="hidden" name="cdek_tariff">').insertAfter('#dop_info');

    $("#makeyourchoise").val(null);

    cdekwidgetWidget(admin);

    $("#cdekwidgetModal").modal("toggle");
}