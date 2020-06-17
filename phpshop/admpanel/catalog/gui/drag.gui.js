//https://code.jquery.com/ui/1.11.3/jquery-ui.min.js'
//https://api.jqueryui.com/droppable/

$().ready(function () {

    $('.list-group-item').draggable({containment: ".list-group", revert: true, revertDuration: 0});

    $(".list-group").droppable({
        accept: ".list-group-item", //��������� ������ �������
        over: function (event, ui)//���� ������ ��� �������- �������� � ��������
        {
            $(this).addClass('hover');
        },
        out: function (event, ui)//���� ������ ����- ������� �������
        {
            $(this).removeClass('hover');
        },
        drop: function (event, ui)//���� ������� ������ � ������
        {
            $(this).append(ui.draggable);//���������� ������ � ������ ������
            $(this).removeClass('hover');//������� ���������
            alert(ui.draggable.attr('data-nodeid'));
        }
    });

});