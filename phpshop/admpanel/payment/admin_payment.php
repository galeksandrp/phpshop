<?php

$TitlePage = __("������� �����");

function actionStart() {
    global $PHPShopInterface,$TitlePage ;

    $PHPShopInterface->setActionPanel($TitlePage , array('������� ���������'), array('��������'),false);
        $PHPShopInterface->setCaption(array(null, "3%"), array("��������", "30%"), array("��������� ����", "20%"), array("���������", "10%", array('align' => 'center')), array("", "10%"), array("������", "10%", array('align' => 'right')));

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment_systems']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

             $PHPShopInterface->setRow($row['id'], array('name' => $row['name'], 'link' => '?path=payment&id=' . $row['id'], 'align' => 'left'), $row['path'], array('name' => $row['num'], 'align' => 'center'), array('action' => array('edit','|', 'delete', 'id' => $row['id']), 'align' => 'center'), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���'))));
             
        }
    $PHPShopInterface->Compile();
}
?>