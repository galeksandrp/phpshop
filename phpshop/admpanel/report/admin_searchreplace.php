<?php

$TitlePage = __("������������� ������");

function actionStart() {
    global $PHPShopInterface;

    $PHPShopInterface->action_button['������'] = array(
        'name' => '������',
        'action' => 'report.searchjurnal',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-search'
    );

    $PHPShopInterface->action_button['�������� �������������'] = array(
        'name' => '',
        'action' => 'addNew',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="�������� �������������"'
    );

    $PHPShopInterface->setActionPanel(__("������������� ������"), array('������� ���������'), array('�������� �������������', '������'));
    $PHPShopInterface->setCaption(array(null, "2%"), array("������", "40%"), array("ID �������", "40%"), array("", "10%"), array("������", "10%"));


    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['search_base']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            $PHPShopInterface->setRow($row['id'], array('name' => str_replace(array('i', 'ii'), array('', ','), $row['name']), 'align' => 'left', 'link' => '?path=' . $_GET['path'] . '&id=' . $row['id']), $row['uid'], array('action' => array('edit', 'delete', 'id' => $row['id']), 'align' => 'center'), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���'))));
        }
    $PHPShopInterface->Compile();
}

?>