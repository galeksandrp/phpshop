<?php


/**
 * E-mail XML ����� ������
 */
function mail_pickpoint_hook($obj,$row,$rout) {

    if($rout == 'END' and !empty($_POST['pickpoint_id'])){
        
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['pickpoint']['pickpoint_system']);
        $option=$PHPShopOrm->select();
        

        $content_file='<?xml version="1.0" encoding="windows-1251"?>
<documents>
<document>
<fio>'.$_POST['fio_new'].'</fio>
<sms_phone>'.$_POST['tel_new'].'</sms_phone>
<email>'.$_POST['mail'].'</email>
<additional_phones/>
<order_id>'.$_POST['ouid'].'</order_id>
<summ_rub>'.$obj->get('total').'</summ_rub>
<terminal_id>'.$_POST['pickpoint_id'].'</terminal_id>
<type_service>'.$option['type_service'].'</type_service>
<type_reception>'.$option['type_reception'].'</type_reception>
<embed>'.$obj->PHPShopSystem->getName().'</embed>
<size_x/> 
<size_y/> 
<size_z/> 
</document>
</documents>';

        // ������ � ����
        $file='files/price/'.$_POST['ouid'].'.xml';
        @fwrite(fopen($file,"w+"), $content_file);
        
        // �������� ������ ��������������
        new PHPShopMailFile($obj->PHPShopSystem->getParam('adminmail2'),$obj->PHPShopSystem->getParam('adminmail2'),'PickPoint N'.$_POST['ouid'],null,'PickPoint_'.$_POST['ouid'].'.xml',$file);

        // ������� ����
        unlink($file);
    }

}

$addHandler=array
        (
        'mail'=>'mail_pickpoint_hook'
);

?>