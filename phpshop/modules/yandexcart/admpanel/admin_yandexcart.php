<?php

$TitlePage = "������ ��������";

function actionStart() {
    global $PHPShopInterface, $PHPShopModules, $TitlePage, $select_name;

    $PHPShopInterface->checkbox_action = false;
    $PHPShopInterface->setActionPanel($TitlePage, $select_name, false);
    //$PHPShopInterface->setCaption(array("�������", "50%"), array("ID ������", "10%"), array("����", "10%"), array("������", "20%"));
    $PHPShopInterface->setCaption(array("����", "20%"),  array("� ������", "20%"),array("��������", "50%"));

    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexcart.yandexcart_log"));
    $PHPShopOrm->debug = false;


    $data = $PHPShopOrm->select(array('*'), $where = false, array('order' => 'id DESC'), array('limit' => 1000));

    if (is_array($data))
        foreach ($data as $row) {
        //$PHPShopInterface->setRow($row['id'], PHPShopDate::get($row['date'], true), $row['order_id'],$row['path']);

            $PHPShopInterface->setRow(array('name' => PHPShopDate::get($row['date'], true), 'link' => '?path=modules.dir.yandexcart&id=' . $row['id']), array('name' => $row['order_id'], 'link' => '?path=order&id=' . $row['order_id']), $row['path']);
        }
    $PHPShopInterface->Compile();
}
?>