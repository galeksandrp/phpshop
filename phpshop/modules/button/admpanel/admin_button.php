<?php

$TitlePage="������";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->size="630,530";
    $PHPShopInterface->link="../modules/button/admpanel/adm_buttonID.php";
    $PHPShopInterface->setCaption(array("&plusmn;","5%"),array("��������","20%"),array("����������","70%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");


    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.button.button_forms"));
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),$where,array('order'=>'num'),array('limit'=>100));

    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),$name,$content);
        }
    $PHPShopInterface->Compile();
}
?>