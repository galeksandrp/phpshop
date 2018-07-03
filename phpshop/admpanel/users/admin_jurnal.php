<?php

$TitlePage = __("������ �����������");
PHPShopObj::loadClass('user');

function actionStart() {
    global $PHPShopInterface;

    $PHPShopInterface->action_select['������������� ���������'] = array(
        'name' => '������������� ��������� IP',
        'action' => 'add-blacklist-select',
        'class' => 'disabled'
    );


    $PHPShopInterface->action_button['������ ������'] = array(
        'name' => '������ ������',
        'action' => 'users.stoplist',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-fire'
    );

    $PHPShopInterface->action_title['add-blacklist'] = '������������� IP';
    $PHPShopInterface->action_title['whois'] = '��� ���?';

    $PHPShopInterface->addJSFiles('./users/gui/users.gui.js');
    $PHPShopInterface->setActionPanel(__("������ �����������"), array('������������� ���������'), array('������ ������'));
    $PHPShopInterface->setCaption(array(null, "2%"), array("�����", "30%"), array("IP", "20%"), array("�����������", "20%"), array("", "10%"), array("������ &nbsp;&nbsp;&nbsp;", "10%", array('align' => 'right')));


    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['jurnal']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            if (empty($row['flag'])){
                $status = '<span class="glyphicon glyphicon-ok"></span>';
                $link='?path=users&id=' . $row['id'];
            }
            else{
                $status = '<span class="glyphicon glyphicon-remove" style="color:red"></span>';
                $link='?path=users.stoplist&action=new&ip=' . $row['ip'];
            }

            $PHPShopInterface->setRow(
                    $row['id'], array('name' => $row['user'], 'link' => $link, 'align' => 'left'), $row['ip'], array('name' => PHPShopDate::get($row['datas'], true)), array('action' => array('add-blacklist','whois', 'id' => $row['id']), 'align' => 'center'), array('name' => $status, 'align' => 'right'));
        }
    $PHPShopInterface->Compile();
}

?>