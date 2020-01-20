<?php
$TitlePage = __("�����-�����");

function actionStart() {
    global $PHPShopInterface,$TitlePage;

    $PHPShopInterface->setActionPanel($TitlePage, array('������� ���������'), array('��������',));
    $PHPShopInterface->setCaption(array("", "1%"), array("��������", "50%"), array("������", "15%"),  array("���� ��������", "15%"), array("", "10%"), array("������ &nbsp;&nbsp;&nbsp;", "10%", array('align' => 'right')));

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['promotion']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), $where = false, array('order' => 'id'), array('limit' => 1000));

    if (is_array($data))
        foreach ($data as $row) {

            if ($row['discount_tip'] == 1)
                $discount_tip_name = '%';
            else
                $discount_tip_name = ' ���.';

            $PHPShopInterface->setRow($row['id'], array('name' => $row['name'], 'link' => '?path='.$_GET['path'].'&id=' . $row['id'], 'align' => 'left'), $row['discount'] . $discount_tip_name, $row['date_create'], array('action' => array('edit', '|','delete', 'id' => $row['id']), 'align' => 'center'), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���'))));
        }
    $PHPShopInterface->Compile();
}

?>