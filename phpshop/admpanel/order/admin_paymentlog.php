<?php

$TitlePage = __("����������� �������");

function actionStart() {
    global $PHPShopInterface,$PHPShopSystem;


    $PHPShopInterface->setActionPanel(__("����������� �������"), null, null);
    $PHPShopInterface->checkbox_action = false;
    $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");
    $PHPShopInterface->setCaption(array("� ������", "20%"), array("�����������", "20%"), array("��������� �������", "20%"), array("����� ".$PHPShopSystem->getDefaultValutaCode(), "20%",array('align' => 'right')));

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment']);
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'uid DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            $PHPShopInterface->setRow(array('name' => $row['uid'], 'align' => 'left'), PHPShopDate::get($row['datas'], true), $row['name'], array('name'=>number_format($row['sum'], $format, '.', ' '),'align'=>'right'));
        }
    $PHPShopInterface->Compile();
}

?>