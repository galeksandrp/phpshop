
$(document).ready(function() {

    // �������������� �������������� �����
    $('.autofill tr').each(function(key, value) {

        if (key > 0 && $(value).find(':nth-child(3) input:text').val() == "") {
            var def = $(value).find(':nth-child(1)').html();
            $(value).find(':nth-child(3) input:text').val(def);
            $(value).find(':nth-child(5) input:text').val(key);
        }
    });


    // ���������� ������� ���������
    if (typeof(TREEGRID_LOAD) != 'undefined')
        $('.title-icon .glyphicon-chevron-down').on('click', function() {
            $('.tree').treegrid('expandAll');
        });

    if (typeof(TREEGRID_LOAD) != 'undefined')
        $('.title-icon .glyphicon-chevron-up').on('click', function() {
            $('.tree').treegrid('collapseAll');
        });


    // ��������� ������ �� ������ (����, �����)
    $('.editable').on('change', function() {
        var data = [];
        data.push({name: $(this).attr('data-edit'), value: $(this).val()});
        data.push({name: 'rowID', value: $(this).attr('data-id')});
        data.push({name: 'saveID', value: 1});
        data.push({name: 'actionList[saveID]', value: 'actionSave'});
        data.push({name: 'ajax', value: 1});
        $.ajax({
            mimeType: 'text/html; charset=windows-1251', // ! Need set mimeType only when run from local file
            url: '?path=delivery&id=' + $(this).attr('data-id'),
            type: 'post',
            data: data,
            dataType: "json",
            async: false,
            success: function(json) {
                if (json['success'] == 1)
                    showAlertMessage(locale.save_done);
                else
                    showAlertMessage(locale.save_false, true);
            }
        });
    });

    // ������ ���������
    if (typeof(TREEGRID_LOAD) != 'undefined')
        $('.tree').treegrid({
            saveState: true,
            expanderExpandedClass: 'glyphicon glyphicon-triangle-bottom',
            expanderCollapsedClass: 'glyphicon glyphicon-triangle-right'
        });

    $('.data-tree .dropdown-toggle').addClass('btn-xs');

    // ��������� ���������
    if (typeof(TREEGRID_LOAD) != 'undefined')
        $(".treegrid-parent").on('click', function(event) {
            event.preventDefault();
            $('.' + $(this).attr('data-parent')).treegrid('toggle');
        });

    // ������������� ��������� � ������
    $(".tree .edit").on('click', function(event) {
        event.preventDefault();
        window.location.href += '&id=' + $(this).attr('data-id');
    });

    // ������� ��������� � ������
    $(".tree .delete").on('click', function(event) {
        event.preventDefault();
        var id = $(this).closest('.data-tree');
        var data_id = $(this).attr('data-id');

        $.MessageBox({
            buttonDone: "OK",
            buttonFail: locale.cancel,
            message: locale.confirm_delete
        }).done(function() {

            $('.list_edit_' + data_id).ajaxSubmit({
                success: function() {
                    id.empty();
                    showAlertMessage(locale.save_done);
                }
            });
        })

    });

    // ������� ����� �� ������
    $(".newcat").on('click', function(event) {
        event.preventDefault();
        window.location.href += '&action=new&target=cat';
    });

    // ��������� �� ������ dropdown
    $('.data-row, .data-tree').hover(
            function() {
                $(this).find('#dropdown_action').show();
                $(this).find('.editable').removeClass('input-hidden');
                $(this).find('.media-object').addClass('image-shadow');
            },
            function() {
                $(this).find('#dropdown_action').hide();
                $(this).find('.editable').addClass('input-hidden');
                $(this).find('.media-object').removeClass('image-shadow');
            });

});