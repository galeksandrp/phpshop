<?php

function tab_userdata($data, $order) {
    global $PHPShopGUI;
    
    
    $PHPShopGUI->field_col=3;
    
    $help='<p class="text-muted hidden-xs data-row">'.__('�������������� ���� � ������ � ���������� � �� ������������� ���������� ����� ��������� � �������').'  <a href="?path=delivery&id='.$order['Person']['dostavka_metod'].'&tab=1"><span class="glyphicon glyphicon-share-alt"></span>'.__('���������� ���������').'</a></p><hr>';
    
    if(empty($data['fio'])){
        $data['fio']=$order['Person']['name_person'];
    }

    // ������ ����������
    $disp1 = $PHPShopGUI->setField("���", $PHPShopGUI->setInputText('', 'fio_new', $data['fio'] )) .
            $PHPShopGUI->setField("�������", $PHPShopGUI->setInputText('', 'tel_new', $data['tel'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInputText('', 'country_new', $data['country'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInputText('', 'state_new', $data['state'])) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('', 'city_new', $data['city'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInputText('', 'index_new', $data['index'])) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('', 'street_new', $data['street'] . $order['Person']['adr_name'])) .
            $PHPShopGUI->setField("���", $PHPShopGUI->setInputText('', 'house_new', $data['house'])) .
            $PHPShopGUI->setField("�������", $PHPShopGUI->setInputText('', 'porch_new', $data['porch'])) .
            $PHPShopGUI->setField("�������", $PHPShopGUI->setInputText('', 'door_phone_new', $data['door_phone'])) .
            $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText('', 'flat_new', $data['flat'])).
            $PHPShopGUI->setField("Tracking", $PHPShopGUI->setInputText('', 'tracking_new', $data['tracking']));

    // ��. ������ ����������
    $disp2 = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText('', 'org_name_new', $data['org_name'] . $order['Person']['org_name'])) .
            $PHPShopGUI->setField("���", $PHPShopGUI->setInputText('', 'org_inn_new', $data['org_inn'])) .
            $PHPShopGUI->setField("���", $PHPShopGUI->setInputText('', 'org_kpp_new', $data['org_kpp'])) .
            $PHPShopGUI->setField("��. �����", $PHPShopGUI->setInputText('', 'org_yur_adres_new', $data['org_yur_adres'])) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('', 'org_fakt_adres_new', $data['org_fakt_adres'])) .
            $PHPShopGUI->setField("�/�", $PHPShopGUI->setInputText('', 'org_ras_new', $data['org_ras'])) .
            $PHPShopGUI->setField("����", $PHPShopGUI->setInputText('', 'org_bank_new', $data['org_bank'])) .
            $PHPShopGUI->setField("�/�", $PHPShopGUI->setInputText('', 'org_kor_new', $data['org_kor'])) .
            $PHPShopGUI->setField("���", $PHPShopGUI->setInputText('', 'org_bik_new', $data['org_bik'])) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('', 'org_city_new', $data['org_city'])).
            $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('', 'delivtime_new', $data['delivtime']));

    return $help.$PHPShopGUI->setGrid(array($disp1, 6), array($disp2, 6));
}

?>