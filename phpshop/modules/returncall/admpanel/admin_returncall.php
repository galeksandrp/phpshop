<?php

$TitlePage=" ReCall -> ����� ������";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->size="630,450";
    $PHPShopInterface->link="../modules/returncall/admpanel/adm_returncallID.php";
    $PHPShopInterface->setCaption(array("����","5%"),array("�������","10%"),array("IP","5%"),array("���","20%"),array("�����","7%"),
            array("���������","20%"),array("������","10%"));

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
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array("limit"=>"1000"));
    if(is_array($data))
        foreach($data as $row) {
        $time=null;
            extract($row);
            if(!empty($time_start)) $time.=' �� '.$time_start;
            if(!empty($time_end)) $time.=' �� '.$time_end;
            $PHPShopInterface->setRow($id,PHPShopDate::dataV($date,false),$tel,$ip,$name,$time,substr($message,0,150),$status_array[$status]);
        }
    
    $PHPShopInterface->Compile();
}
?>