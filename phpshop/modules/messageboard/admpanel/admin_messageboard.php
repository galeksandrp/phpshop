<?php
$TitlePage="����������";

function actionStart() {
    global $PHPShopInterface,$_classPath;

        // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");

    $PHPShopInterface->size="630,530";
    $PHPShopInterface->link="../modules/messageboard/admpanel/adm_messageboardID.php";
    $PHPShopInterface->setCaption(array("&plusmn;","5%"),array("����","10%"),array("���������","45%"),array("���������","45%"));

    // SQL
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.messageboard.messageboard_log"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array("limit"=>"1000"));
    if(is_array($data))
        foreach($data as $row) {
            extract($row);
            $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),PHPShopDate::dataV($date,false),$title,substr($content,0,150)."...");
        }


    $PHPShopInterface->Compile();
}
?>