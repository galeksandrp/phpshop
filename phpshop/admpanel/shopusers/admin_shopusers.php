<?php

$TitlePage = __("����������");
PHPShopObj::loadClass('user');

function actionStart() {
    global $PHPShopInterface,$TitlePage;

    $PHPShopInterface->action_button['�������� ������������'] = array(
        'name' => '',
        'action' => 'addNew',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="'.__('�������� ������������').'"'
    );

    $PHPShopInterface->action_title['order'] = '����� �����';

    $PHPShopInterface->addJSFiles('./shopusers/gui/shopusers.gui.js');
    $PHPShopInterface->setActionPanel($TitlePage, array('CSV', '������� ���������'), array('�������� ������������'));
    $PHPShopInterface->setCaption(array(null, "2%"), array("���", "25%"), array("E-mail", "20%"), array("������", "20%"), array("������ %", "10%"), array("����", "10%"), array("", "10%"), array("������", "10%", array('align' => 'right')));
    $PHPShopInterface->Compile();
}

// ��������� �������
$PHPShopInterface->getAction();
?>