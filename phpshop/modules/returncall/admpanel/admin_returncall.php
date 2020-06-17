<?php

function actionStart() {
    global $PHPShopInterface,$PHPShopModules,$subpath,$TitlePage, $select_name;
    
    $PHPShopInterface->setActionPanel($TitlePage, $select_name, false);
    
    $PHPShopInterface->setCaption(array("","1%"),array("���","30%"),array("����","15%"),array("�������","20%"),array("�����","15%"),array("", "10%"),array("������","10%"));

    $status_array=array(
        1=>__('����� ������'),
        2=>'<span class="text-primary">'.__('�����������').'</span>',
        3=>'<span class="text-warning">'.__('����c�����').'</span>',
        4=>'<span class="text-success">'.__('��������').'</span>',
        5=>'<span class="text-success">'.__('�����').'</span>'
    );

    // SQL
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array("limit"=>"1000"));
    if(is_array($data))
        foreach($data as $row) {
        $time=null;
            $PHPShopInterface->setRow($row['id'],array('name' => $row['name'], 'link' => '?path=modules.dir.'.$subpath[2].'&id=' . $row['id'], 'align' => 'left'),PHPShopDate::get($row['date'],true),$row['tel'],$row['time_start'].' '.$row['time_end'],array('action' => array('edit', 'delete', 'id' => $row['id']), 'align' => 'center'),$status_array[$row['status']]);
        }
    
    $PHPShopInterface->Compile();
}
?>