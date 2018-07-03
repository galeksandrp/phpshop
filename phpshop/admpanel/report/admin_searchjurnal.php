<?php

$TitlePage = __("������ ������");

function actionStart() {
    global $PHPShopInterface,$TitlePage;

    $PHPShopInterface->action_select['�������� � ����'] = array(
        'name' => '�������� � �������������',
        'action' => 'add-search-base',
        'class' => 'disabled'
    );

    $PHPShopInterface->action_button['�������������'] = array(
        'name' => '�������������',
        'action' => 'report.searchreplace',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-screenshot'
    );
    
    $PHPShopInterface->action_title['add-search-base'] = '�������������';

    $PHPShopInterface->addJSFiles('./report/gui/report.gui.js');

    $PHPShopInterface->setActionPanel($TitlePage, array('������� ���������', '�������� � ����'), array('�������������'),false);
    $PHPShopInterface->setCaption(array(null, "2%"), array("������", "70%"), array("����", "10%"), array("", "10%"), array("�������", "10%"));

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['search_jurnal']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            $PHPShopInterface->setRow($row['id'], array('name' => $row['name'], 'align' => 'left', 'link' => $GLOBALS['SysValue']['dir']['dir'] . '/search/?words=' . $row['name'] . '&cat=' . $row['cat'] . '&set=' . $row['set'], 'target' => '_blank'), PHPShopDate::get($row['datas'], true), array('action' => array('delete','|', 'add-search-base', 'id' => $row['id']), 'align' => 'center'), array('name' => $row['num'], 'align' => 'center'));
        }
    $PHPShopInterface->Compile();
}

?>