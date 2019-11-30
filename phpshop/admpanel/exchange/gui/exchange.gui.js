
// ��������������� �������
var TABLE_EVENT = true;
locale.icon_load = locale.file_load;

$().ready(function() {

    // ��������� ���� ������
    $('#selectModal').on('show.bs.modal', function(event) {
        $('#selectModal .modal-title').html($('[data-target="#selectModal"]').attr('data-title'));
        $('#selectModal .modal-footer .btn-primary').addClass('hidden');
        $('#selectModal .modal-footer [data-dismiss="modal"]').html(locale.close);
        $('#selectModal .modal-body').css('max-height', ($(window).height() - 200) + 'px');
        $('#selectModal .modal-body').css('overflow-y', 'auto');
    });

    // ��������� Ace
    $(".ace-save").on('click', function(event) {
        event.preventDefault();
        $('#editor_src').val(editor.getValue());
        $('#product_edit').submit();
    });


    // Ace
    if ($('#editor_src').length) {
        var editor = ace.edit("editor");
        var mod = $('#editor_src').attr('data-mod');
        var theme = $('#editor_src').attr('data-theme');
        editor.setTheme("ace/theme/" + theme);
        editor.session.setMode("ace/mode/" + mod);
        editor.setValue($('#editor_src').val(), 1);
        editor.getSession().setUseWrapMode(true);
        editor.setShowPrintMargin(false);
        editor.setAutoScrollEditorIntoView(true);
        $('#editor').height(300);
        editor.resize();
    }

    // ������������� ������������ ����� update/insert
    $('#export_action').on('changed.bs.select', function() {
        $('kbd.enabled').toggle();
        $('#export_uniq').attr('disabled', function(_, attr) {
            return !attr;
        });
    });

    // ������� ��������
    $(".select-remove").on('click', function(event) {
        event.preventDefault();

        var data = [];
        data.push({name: 'selectID', value: 1});
        data.push({name: 'ajax', value: 1});
        data.push({name: 'actionList[selectID]', value: 'actionSelect'});
        $.ajax({
            mimeType: 'text/html; charset=windows-1251',
            url: '?path=exchange.export.product',
            type: 'post',
            data: data,
            dataType: "json",
            async: false,
            success: function() {
                window.location.reload();
            }
        });
    });

    // �������� ��������� ������� �� ������
    $(".data-row .clean-base").on('click', function(event) {
        event.preventDefault();
        var table = $(this).closest('.data-row').find('td:nth-child(2)').html();

        $.MessageBox({
            buttonDone: "OK",
            buttonFail: locale.cancel,
            message: locale.confirm_clean + ': ' + table + '?'
        }).done(function() {

            var data = [];
            data.push({name: 'table', value: table});
            data.push({name: 'saveID', value: 1});
            data.push({name: 'ajax', value: 1});
            data.push({name: 'actionList[saveID]', value: 'actionSave'});
            $.ajax({
                mimeType: 'text/html; charset=windows-1251',
                url: '?path=exchange.service',
                type: 'get',
                data: data,
                dataType: "json",
                async: false,
                success: function(json) {
                    if (json['success'] == 1) {
                        window.location.reload();
                    } else
                        showAlertMessage(locale.save_false, true, true);
                }
            });
        })

    });

    // �������� ��������� ������� � �����������
    $('.select-action .sql-clean').on('click', function(event) {
        event.preventDefault();

        var chk = $('input:checkbox:checked').length;
        var i = 0;

        if (chk > 0) {

            $.MessageBox({
                buttonDone: "OK",
                buttonFail: locale.cancel,
                message: locale.confirm_clean
            }).done(function() {

                $('input:checkbox:checked').each(function() {
                    var table = $(this).closest('.data-row').find('td:nth-child(2)').html();
                    var data = [];

                    data.push({name: 'table', value: table});
                    data.push({name: 'saveID', value: 1});
                    data.push({name: 'ajax', value: 1});
                    data.push({name: 'actionList[saveID]', value: 'actionSave'});
                    $.ajax({
                        mimeType: 'text/html; charset=windows-1251',
                        url: '?path=exchange.service',
                        type: 'get',
                        data: data,
                        dataType: "json",
                        async: false
                    });

                    i++;
                    if (chk == i)
                        window.location.reload();
                });
            })

        }
        else
            alert(locale.select_no);
    });

    // ������������ ����� �� ������
    $("body").on('click', ".data-row .restore", function(event) {
        event.preventDefault();
        var file = $(this).closest('.data-row').find('td:nth-child(2)>a').html();

        $.MessageBox({
            buttonDone: "OK",
            buttonFail: locale.cancel,
            message: locale.confirm_restore + ': ' + file + '?'
        }).done(function() {

            var data = [];
            data.push({name: 'lfile', value: '/phpshop/admpanel/dumper/backup/' + file});
            data.push({name: 'saveID', value: 1});
            data.push({name: 'ajax', value: 1});
            data.push({name: 'actionList[saveID]', value: 'actionSave'});
            $.ajax({
                mimeType: 'text/html; charset=windows-1251',
                url: '?path=exchange.sql',
                type: 'post',
                data: data,
                dataType: "json",
                async: false,
                success: function(json) {
                    if (json['success'] == 1) {
                        showAlertMessage(locale.backup_done);
                    } else
                        showAlertMessage('<strong>' + locale.backup_false + '</strong><br>' + json['error'], true, true);
                }
            });
        })
    });

    // �������� �� ������
    $("body").on('click', ".data-row .delete", function(event) {
        event.preventDefault();
        $('.list_edit_' + $(this).attr('data-id')).append('<input type="hidden" name="file" value="' + $(this).closest('.data-row').find('td:nth-child(2)>a').html() + '">');
    });

    // ������� � ����������
    $(".select-action .select").on('click', function(event) {
        event.preventDefault();
        if ($('input:checkbox:checked').length) {

            $('input:checkbox:checked').each(function() {
                var id = $(this).closest('.data-row');
                $('.list_edit_' + $(this).attr('data-id')).append('<input type="hidden" name="file" value="' + $(this).closest('.data-row').find('td:nth-child(2)>a').html() + '">');
            });

        }
        else
            alert(locale.select_no);
    });

    // ������� ����� � �����������
    $('.select-action .load').on('click', function(event) {
        event.preventDefault();
        if ($('input:checkbox:checked').length) {

            $('input:checkbox:checked').each(function() {
                var add = $(this).closest('.data-row').find('td:nth-child(2)>a').html();
                window.open('?path=exchange.backup&file=' + add);
            });
        }
        else
            alert(locale.select_no);
    });

    // �������������� ����
    $(".select-action .sql-optim").on('click', function(event) {
        event.preventDefault();
        window.location.href = '?path=exchange.sql&query=optimize';
    });

    // ������� ����� �� ������
    $(".data-row .load").on('click', function(event) {
        event.preventDefault();
        window.location.href = $(this).closest('.data-row').find('td:nth-child(2)>a').attr('href');
    });

    // SQL �������
    $('#sql_query').on('change', function() {
        if ($(this).val() != 0)
            editor.setValue($(this).val());
        //$('#sql_text').html($(this).val());
    });

    // C���� ��������� ������
    $("#select-none").on('click', function(event) {
        event.preventDefault();
        $('#pattern_table option:selected').each(function() {
            this.selected = false;
        });
    });

    // ��������� ��������� ���� ������
    $("#select-all").on('click', function(event) {
        event.preventDefault();
        $('#pattern_table option').each(function() {
            this.selected = true;
        });
    });

    // �������� ���� �����
    $("#remove-all").on('click', function(event) {
        event.preventDefault();
        $('#pattern_default option').each(function() {
            this.selected = false;
            $('#pattern_more').append('<option value="' + this.value + '" selected>' + $(this).html() + '</option>');
            $(this).remove();
        });
    });

    // ���������� ��� ���� � ��������
    $("#send-all").on('click', function(event) {
        event.preventDefault();
        $('#pattern_more option').each(function() {
            this.selected = true;
            $('#pattern_default').append('<option value="' + this.value + '" selected>' + $(this).html() + '</option>');
            $(this).remove();
        });
    });

    // ���������� ���������� ���� � ��������
    $("#send-default").on('click', function(event) {
        event.preventDefault();
        $('#pattern_more option:selected').each(function() {
            if (typeof this.value != 'undefined') {
                $('#pattern_default').append('<option value="' + this.value + '" selected>' + $(this).html() + '</option>');
                $(this).remove();
            }
        });
    });

    // �������� ���������� ���� �� ��������
    $("#send-more").on('click', function(event) {
        event.preventDefault();
        if (typeof $('#pattern_default :selected').html() != 'undefined') {
            $('#pattern_more').append('<option value="' + $('#pattern_default :selected').val() + '">' + $('#pattern_default :selected').html() + '</option>');
            $('#pattern_default option:selected').remove();
        }
    });


    // ������� ����������
    var table = $('#data').dataTable({
        //ajax: "./catalog/ajax.php", 
        //https://www.datatables.net/examples/data_sources/server_side.html
        "paging": true,
        "ordering": true,
        "order": [[3, "desc"]],
        "info": false,
        "language": locale.dataTable
    });
});