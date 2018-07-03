<?php

function tab_userdata($data, $order) {
    global $PHPShopGUI;
    
    $PHPShopGUI->field_col=3;

    // ������ ����������
    $disp1 = $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'fio_new', $data['fio'] . $order['Person']['name_person'])) .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'tel_new', $data['tel'])) .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'country_new', $data['country'])) .
            $PHPShopGUI->setField(__("������/����"), $PHPShopGUI->setInputText('', 'state_new', $data['state'])) .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'city_new', $data['city'])) .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'index_new', $data['index'])) .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'street_new', $data['street'] . $order['Person']['adr_name'])) .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'house_new', $data['house'])) .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'porch_new', $data['porch'])) .
            $PHPShopGUI->setField(__("��� ��������"), $PHPShopGUI->setInputText('', 'door_phone_new', $data['door_phone'])) .
            $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText('', 'flat_new', $data['flat'])) .
            $PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setInputText('', 'delivtime_new', $data['delivtime']));

    // ��. ������ ����������
    $disp2 = $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText('', 'org_name_new', $data['org_name'] . $order['Person']['org_name'])) .
            $PHPShopGUI->setField(__("��� "), $PHPShopGUI->setInputText('', 'org_inn_new', $data['org_inn'])) .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'org_kpp_new', $data['org_kpp'])) .
            $PHPShopGUI->setField(__("��. �����"), $PHPShopGUI->setInputText('', 'org_yur_adres_new', $data['org_yur_adres'])) .
            $PHPShopGUI->setField(__("����. �����"), $PHPShopGUI->setInputText('', 'org_fakt_adres_new', $data['org_fakt_adres'])) .
            $PHPShopGUI->setField(__("���. ����"), $PHPShopGUI->setInputText('', 'org_ras_new', $data['org_ras'])) .
            $PHPShopGUI->setField(__("����"), $PHPShopGUI->setInputText('', 'org_bank_new', $data['org_bank'])) .
            $PHPShopGUI->setField(__("���. ����"), $PHPShopGUI->setInputText('', 'org_kor_new', $data['org_kor'])) .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'org_bik_new', $data['org_bik'])) .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'org_city_new', $data['org_city']));


    return $PHPShopGUI->setGrid(array($disp1, 6), array($disp2, 6));
}

?>