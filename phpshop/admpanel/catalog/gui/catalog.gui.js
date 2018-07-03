$().ready(function() {

    // ��������� ����� - 2 ���
    $("body").on('click', "#selectModal .modal-footer .option-send", function(event) {
        event.preventDefault();

        if ($('#selectModal input:checkbox:checked').length) {
            var data = [];
            $('#selectModal input:checkbox:checked').each(function() {
                data.push({name: 'option[' + $(this).attr('name') + ']', value: $(this).val()});

            });

            data.push({name: 'selectID', value: 1});
            data.push({name: 'ajax', value: 1});
            data.push({name: 'actionList[selectID]', value: 'actionOptionSave'});
            $.ajax({
                mimeType: 'text/html; charset=windows-1251',
                url: '?path=catalog.select',
                type: 'post',
                data: data,
                dataType: "json",
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }
        else
            alert(locale.select_no);
    });

    // ��������� ����� - 1 ���
    $(".option").on('click', function(event) {
        event.preventDefault();

        var data = [];
        data.push({name: 'selectID', value: 1});
        data.push({name: 'ajax', value: 1});
        data.push({name: 'cat', value: cat});
        data.push({name: 'actionList[selectID]', value: 'actionOption'});

        $.ajax({
            mimeType: 'text/html; charset=windows-1251',
            url: '?path=catalog.select',
            type: 'post',
            data: data,
            dataType: "html",
            async: false,
            success: function(data) {
                $('#selectModal .modal-dialog').removeClass('modal-lg');
                $('#selectModal .modal-title').html(locale.option_title);
                $('#selectModal .modal-footer .btn-primary').addClass('option-send');
                $('#selectModal .modal-footer .btn-delete').addClass('hidden');
                $('#selectModal .modal-body').html(data);
                $('#selectModal').modal('show');
            }
        });
    });

    // ����������� ����� ������
    $(".search").on('click', function(event) {
        event.preventDefault();

        var data = [];
        data.push({name: 'selectID', value: 1});
        data.push({name: 'ajax', value: 1});
        data.push({name: 'cat', value: cat});
        data.push({name: 'actionList[selectID]', value: 'actionAdvanceSearch'});

        $.ajax({
            mimeType: 'text/html; charset=windows-1251',
            url: '?path=catalog.search',
            type: 'post',
            data: data,
            dataType: "html",
            async: false,
            success: function(data) {
                $('#selectModal .modal-dialog').removeClass('modal-lg');
                $('#selectModal .modal-title').html(locale.search_advance_title);
                $('#selectModal .modal-footer .btn-primary').html(locale.search_advance_but);
                $('#selectModal .modal-footer .btn-primary').addClass('search-send');
                $('#selectModal .modal-footer .btn-delete').addClass('hidden');
                $('#selectModal .modal-body').html(data);
                $('#selectModal').modal('show');
                $('#modal-form').attr('method', 'get');
            }
        });
    });

    // ������� �� �������� �� ������
    $("#dropdown_action  .url").on('click', function(event) {
        event.preventDefault();
        window.open('../../shop/UID_' + $(this).attr('data-id') + '.html');
    });

    // ������������� � ���������� - 2 ���
    $("body").on('click', "#selectModal .modal-footer .edit-select-send", function(event) {
        event.preventDefault();

        if ($('#selectModal input:checkbox:checked').length) {
            var data = [];
            $('#selectModal input:checkbox:checked').each(function() {
                data.push({name: 'select_col[' + $(this).attr('name') + ']', value: $(this).attr('name')});

            });

            data.push({name: 'selectID', value: 1});
            data.push({name: 'ajax', value: 1});
            data.push({name: 'actionList[selectID]', value: 'actionSelectEdit'});
            $.ajax({
                mimeType: 'text/html; charset=windows-1251',
                url: '?path=catalog.select',
                type: 'post',
                data: data,
                dataType: "json",
                async: false,
                success: function() {
                    window.location.href = '?path=catalog.select&cat=' + cat;
                }

            });
        }
        else
            alert(locale.select_no);
    });

    // C���� ��������� ���������
    $('#selectModal').on('click', "#select-none", function(event) {
        event.preventDefault();
        $('#selectModal input:checkbox:checked').each(function() {
            this.checked = false;
        });
    });

    // �������� ��� ��������
    $('#selectModal').on('click', "#select-all", function(event) {
        event.preventDefault();
        $('#selectModal input:checkbox').each(function() {
            this.checked = true;
        });
    });

    // ������������� � ���������� - 1 ���
    $(".select-action .edit-select").on('click', function(event) {
        event.preventDefault();

        if ($('#data input:checkbox:checked').length) {
            var data = [];
            $('#data input:checkbox:checked').each(function() {
                if (this.value != 'all')
                    data.push({name: 'select[' + $(this).attr('data-id') + ']', value: $(this).attr('data-id')});

            });

            data.push({name: 'selectID', value: 1});
            data.push({name: 'ajax', value: 1});
            data.push({name: 'actionList[selectID]', value: 'actionSelect'});

            $.ajax({
                mimeType: 'text/html; charset=windows-1251',
                url: '?path=catalog.select',
                type: 'post',
                data: data,
                dataType: "html",
                async: false,
                success: function(data) {
                    $('#selectModal .modal-title').html(locale.select_title);
                    $('#selectModal .modal-footer .btn-primary').html(locale.select_edit);
                    $('#selectModal .modal-footer .btn-primary').addClass('edit-select-send');
                    $('#selectModal .modal-dialog').addClass('modal-lg');
                    $('#selectModal .modal-body').html(data);
                    $('#selectModal').modal('show');
                }
            });
        }
        else
            alert(locale.select_no);
    });

    // �������������� � ����������
    $(".select-action .export-select").on('click', function(event) {
        event.preventDefault();

        if ($('#data input:checkbox:checked').length) {
            var data = [];
            $('#data input:checkbox:checked').each(function() {
                if (this.value != 'all')
                    data.push({name: 'select[' + $(this).attr('data-id') + ']', value: $(this).attr('data-id')});
            });

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
                    window.location.href = '?path=exchange.export';
                }

            });
        }
        else
            alert(locale.select_no);
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
        data.push({name: 'editID', value: 1});
        data.push({name: 'ajax', value: 1});
        data.push({name: 'actionList[editID]', value: 'actionUpdate.catalog.edit'});
        $.ajax({
            mimeType: 'text/html; charset=windows-1251', // ! Need set mimeType only when run from local file
            url: '?path=product&id=' + $(this).attr('data-id'),
            type: 'post',
            data: data,
            dataType: "json",
            async: false,
            success: function(json) {
                if (json['success'] == 1) {
                    showAlertMessage(locale.save_done);
                } else
                    showAlertMessage(locale.save_false, true);
            }
        });
    });

    if (typeof tree_save === "undefined") {
        tree_save = false;
    }

    // ������ ���������
    if (typeof(TREEGRID_LOAD) != 'undefined') {
        $('.tree').treegrid({
            saveState: tree_save,
            initialState: 'collapsed',
            expanderExpandedClass: 'glyphicon glyphicon-triangle-bottom',
            expanderCollapsedClass: 'glyphicon glyphicon-triangle-right'
        });
    }

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
        if (confirm(locale.confirm_delete)) {
            $('.list_edit_' + $(this).attr('data-id')).ajaxSubmit({
                success: function() {
                    id.empty();
                    showAlertMessage(locale.save_done);
                }
            });
        }
    });

    // ������� ����� �� ������
    $("button[name=addNew]").on('click', function() {
        var cat = $(this).attr('data-cat');
        var href = '?path=product&return=catalog&action=new';
        if (cat > 0)
            href += '&cat=' + cat;
        window.location.href = href;
        action = true;
    });

    // ��������� ������� ���������
    if (typeof cat != 'undefined') {
        $('.treegrid-' + cat).addClass('treegrid-active');
    }

    // ������� ����� �� ������
    $(".select-action .copy").on('click', function(event) {
        event.preventDefault();
        window.location.href = '?path=product&return=catalog&action=new&id=' + $('input[name=rowID]').val();
    });

    // ������� ����� �� ������ dropdown
    $(".data-row .copy").on('click', function(event) {
        event.preventDefault();
        window.location.href = '?path=product&return=catalog&action=new&id=' + $(this).attr('data-id');
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