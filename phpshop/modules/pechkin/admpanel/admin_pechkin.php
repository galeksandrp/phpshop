<?php

$TitlePage="������ ������������";


function actionStart() {
    global $PHPShopInterface,$_classPath;



    $PHPShopInterface->size="630,580";
    $PHPShopInterface->link="../modules/pechkin/admpanel/adm_pechkinID.php";
    $PHPShopInterface->setCaption(array("&plusmn;","5%"),array("��� �������� ����","30%"),array("ID �������� ����","10%"),array("���","20%"),array("���� ��������","10%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");

    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.pechkin.pechkin_forms"));
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),$where,array('order'=>'id'),array('limit'=>300));


    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),$base_name,$list_id, ($type==1 ? '����������' : '������������') ,$date_create);
        }
    $PHPShopInterface->Compile();
}
?>