<?php

$TitlePage="�����-�����";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->size="630,580";
    $PHPShopInterface->link="../modules/promotions/admpanel/adm_promotionID.php";
    $PHPShopInterface->setCaption(array("&plusmn;","5%"),array("��������","40%"),array("������","10%"),array("���","35%"),array("���� ��������","10%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");


    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),$where,array('order'=>'id'),array('limit'=>300));


    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            if($discount_tip==1)
                $discount_tip_name = '%';
            else
                $discount_tip_name = ' ���.';

            //����� ������
            if($code=='*')
                $code = '';

            $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),$name,$discount.$discount_tip_name,$code,$date_create);
        }
    $PHPShopInterface->setAddItem('../modules/promotions/admpanel/adm_promotion_new.php');
    $PHPShopInterface->Compile();
}
?>