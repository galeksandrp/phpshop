
$().ready(function() {

    var theme_new = false;


    // ��������� �����
    $('[name="option[mail_smtp_enabled]"]').prop('checked', function(_, checked) {
        if (!checked) {
            $('[name="option[mail_smtp_auth]"]').attr('disabled', true);
            $('[name="option[mail_smtp_host]"]').attr('disabled', true);
            $('[name="option[mail_smtp_port]"]').attr('disabled', true);
            $('[name="option[mail_smtp_user]"]').attr('disabled', true);
            $('[name="option[mail_smtp_pass]"]').attr('disabled', true);
        }
    });

    $('[name="option[mail_smtp_enabled]"]').click(function() {
        var smtp_disabled = this.checked;
        $('[name="option[mail_smtp_auth]"]').attr('disabled', !smtp_disabled);
        $('[name="option[mail_smtp_host]"]').attr('disabled', !smtp_disabled);
        $('[name="option[mail_smtp_port]"]').attr('disabled', !smtp_disabled);
        $('[name="option[mail_smtp_user]"]').attr('disabled', !smtp_disabled);
        $('[name="option[mail_smtp_pass]"]').attr('disabled', !smtp_disabled);
    });

    // ���������� ���� ����������
    $('#theme_new').on('changed.bs.select', function() {
        theme_new = true;
    });

    // ������������ �������� ��� ����� ����
    $("button[name=editID]").on('click', function(event) {
        event.preventDefault();
        if (theme_new === true) {
            setTimeout(function() {
                window.location.reload();
            }, 5000);
        }
    });

    // ����������� ���������
    if ($('#fix-check:visible').length && typeof(WAYPOINT_LOAD) != 'undefined')
        var waypoint = new Waypoint({
            element: document.getElementById('fix-check'),
            handler: function(direction) {
                $('.navbar-action').toggleClass('navbar-fixed-top');
            },
            offset: '10%'
        });

    $(".tree a[data-view]").on('click', function(event) {
        event.preventDefault();

        $('html, body').animate({scrollTop: $("a[name=" + $(this).attr('data-view') + "]").offset().top - 100}, 500);
    });

    // ��������� ���������
    $(".pay-support").on('click', function(event) {
        event.preventDefault();
        $('[name=product_upgrade]').submit();
    });
});