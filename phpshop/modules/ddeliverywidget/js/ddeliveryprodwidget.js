function ddeliveryprodwidgetStart() {
    // ������������� �������
    var widget = new DDeliveryWidgetCard("dd-widget-card", {
        apiScript: "/phpshop/modules/ddeliverywidget/api/dd-widget-api.php",
    });

    $("#ddeliverywidgetModal").modal("toggle");
}