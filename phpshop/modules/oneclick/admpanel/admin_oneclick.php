<?php

$TitlePage=" ������� ����� -> ����� ������";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->size="630,450";
    $PHPShopInterface->link="../modules/oneclick/admpanel/adm_oneclickID.php";
    $PHPShopInterface->setCaption(array("����","5%"),array("�������","10%"),array("���","20%"),
            array("������������","20%"),array("����","10%"),
            array("�����","7%"),
            array("���������","10%"),
            array("������","10%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");
    
    $status_array=array(
        1=>'����� ������',
        2=>'������� �����������',
        3=>'����c�����',
        4=>'��������'
    );

    // SQL
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.oneclick.oneclick_jurnal"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array("limit"=>"1000"));
    if(is_array($data))
        foreach($data as $row) {
            extract($row);
            $PHPShopInterface->setRow($id,PHPShopDate::dataV($date,false),$tel,$name,$product_name,$product_price,PHPShopDate::dataV($date),substr($message,0,150),$status_array[$status]);
        }
    
    $PHPShopInterface->Compile();
}
?>