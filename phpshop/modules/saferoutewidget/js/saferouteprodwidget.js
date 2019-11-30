function saferouteprodwidgetStart() {
    // Инициализация виджета
    var widget = new SafeRouteCardWidget("saferoute-widget-card", {
        apiScript: "/phpshop/modules/saferoutewidget/api/saferoute-widget-api.php",
		userFullName: $('input[name="fio_new"]').val(),
		userPhone: $('input[name="tel_new"]').val(),
    });

    $("#saferoutewidgetModal").modal("toggle");
}