<?php

function tab_addres($row) {
    global $PHPShopGUI;

    $PHPShopGUI->field_col = 3;
    $mass = unserialize($row);
    $dis=null;
    
    if(!is_array($mass))
        $mass=array();
    

    if(!is_array($mass['list']) or count($mass['list']) < 1)
        $mass['list'][]=array('fio_new'=>'����������');
    
    if (is_array($mass['list'])){
        foreach ($mass['list'] as $adrId => $adresData) {


            if ($mass['main'] == $adrId)
                $defaultChecked = 1;
            else
                $defaultChecked = 0;
            
            
            // ������ ����������
            $Tab1= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][fio_new]', $adresData['fio_new'])) .
                    $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][tel_new]', $adresData['tel_new'])) .
                    $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][country_new]', $adresData['country_new'])) .
                    $PHPShopGUI->setField(__("������/����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][state_new]', $adresData['state_new'])) .
                    $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][city_new]', $adresData['city_new'])) .
                    $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][index_new]', $adresData['index_new'])) .
                    $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][street_new]', $adresData['street_new'])) .
                    $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][house_new]', $adresData['house_new'])) .
                    $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][porch_new]', $adresData['porch_new'])) .
                    $PHPShopGUI->setField(__("��� ��������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][door_phone_new]', $adresData['door_phone_new'])) .
                    $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][flat_new]', $adresData['flat_new'])) .
                    $PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][delivtime_new]', $adresData['delivtime_new'])) .
                    $PHPShopGUI->setField(__("����������"), $PHPShopGUI->setCheckbox('mass['.$adrId.'][default]', 1, '������ �� ���������', $defaultChecked).$PHPShopGUI->setCheckbox('mass['.$adrId.'][delete]', 1, '������� �����', 0));

            // ��. ������ ����������
            $Tab2= $PHPShopGUI->setField(__("�����������"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_name_new]', $adresData['org_name_new'])) .
                    $PHPShopGUI->setField(__("��� "), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_inn_new]', $adresData['org_inn_new'])) .
                    $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_kpp_new]', $adresData['org_kpp_new'])) .
                    $PHPShopGUI->setField(__("��. �����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_yur_adres_new]', $adresData['org_yur_adres_new'])) .
                    $PHPShopGUI->setField(__("����. �����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_fakt_adres_new]', $adresData['org_fakt_adres_new'])) .
                    $PHPShopGUI->setField(__("�C"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_ras_new]', $adresData['org_ras_new'])) .
                    $PHPShopGUI->setField(__("����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_bank_new]', $adresData['org_bank_new'])) .
                    $PHPShopGUI->setField(__("�C"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_kor_new]', $adresData['org_kor_new'])) .
                    $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_bik_new]', $adresData['org_bik_new'])) .
                    $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass['.$adrId.'][org_city_new]', $adresData['org_city_new']));

           $dis.=$PHPShopGUI->setCollapse(__('������ �������� �').($adrId+1),'<div class="row"><div class="col-md-6">'.$Tab1.'</div><div class="col-md-6">'.$Tab2.'</div></div>');
        }
    }
         return  $dis;
}

?>