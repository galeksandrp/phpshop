<?php

$TitlePage = __("��������������");
PHPShopObj::loadClass('user');

function actionStart() {
    global $PHPShopInterface,$TitlePage;

    $PHPShopInterface->action_button['������ �����������'] = array(
        'name' => '������ �����������',
        'action' => 'users.jurnal',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-eye-open'
    );

    $PHPShopInterface->action_button['������ ������'] = array(
        'name' => '������ ������',
        'action' => 'users.stoplist',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-fire'
    );

    $PHPShopInterface->action_select['������ ������'] = array(
        'name' => '������ ������',
        'url' => '?path=users.stoplist'
    );
    
   $PHPShopInterface->action_select['������ �����������'] = array(
        'name' => '������ �����������',
        'url' => '?path=users.jurnal'
    );

    $PHPShopInterface->action_button['�������� ��������������'] = array(
        'name' => '',
        'action' => 'addNew',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="�������� ��������������"'
    );


    $PHPShopInterface->setActionPanel($TitlePage, array('������� ���������','������ ������','������ �����������'), array('�������� ��������������', '������ �����������'));
    $PHPShopInterface->setCaption(array(null, "2%"), array("�����", "15%"), array("���", "20%"), array("E-mail", "20%"), array("����", "20%"), array("", "10%"), array("������ &nbsp;&nbsp;&nbsp;", "10%", array('align' => 'right')));

    // ������� �������������
    $PHPShopUserStatus = new PHPShopUserStatusArray();
    $PHPShopUserStatusArray = $PHPShopUserStatus->getArray();
    $PHPShopUserStatusArray[0]['name'] = '������������';
    $PHPShopUserStatusArray[0]['discount'] = 0;

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['users']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            $PHPShopInterface->setRow(
                    $row['id'], array('name' => $row['login'], 'link' => '?path=users&id=' . $row['id'], 'align' => 'left'), $row['name'], array('name' => $row['mail'], 'link' => 'mailto:' . $row['mail']), array('name' => PHPShopDate::get($row['datas'], true)), array('action' => array('edit', 'delete', 'id' => $row['id']), 'align' => 'center'), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���'))));
        }
    $PHPShopInterface->Compile();
}

?>