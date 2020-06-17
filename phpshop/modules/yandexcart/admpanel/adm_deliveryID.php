<?php

function addYandexcartDelivery($data) {
    global $PHPShopGUI;

    if (empty($data['yandex_enabled']))
        $data['yandex_enabled'] = 1;
    if (empty($data['yandex_day']))
        $data['yandex_day'] = 2;
    $Tab3 = $PHPShopGUI->setField("���� �������� ����", $PHPShopGUI->setInputText('��', 'yandex_day_min_new', $data['yandex_day_min'], 100,false,'left').$PHPShopGUI->set_(3).$PHPShopGUI->setInputText(null, 'yandex_day_new', $data['yandex_day'], 100,__('��')));
     $Tab3 .= $PHPShopGUI->setField("����� ���������� ��������", $PHPShopGUI->setInputText('�', 'yandex_order_before_new', $data['yandex_order_before'], 150,__('�����')),false,'������ ����� ����� ������� ����� ���������� ������ +1 ����. ����� �� 1 - 24.');
    $Tab3.=$PHPShopGUI->setField('������.�����', $PHPShopGUI->setRadio('yandex_enabled_new', 1, '���������', $data['yandex_enabled'], false, 'text-warning') .
            $PHPShopGUI->setRadio('yandex_enabled_new', 2, '��������', $data['yandex_enabled']));

    $Tab3.=$PHPShopGUI->setField('������ ��� ���������� �������', $PHPShopGUI->setRadio('yandex_check_new', 1, '���������', $data['yandex_check'], false, 'text-warning') . $PHPShopGUI->setRadio('yandex_check_new', 2, '��������', $data['yandex_check']));


    // ��� ��������
    $delivery_value[] = array(__('���������� ��������'), 1, $data['yandex_type']);
    $delivery_value[] = array(__('���������'), 2, $data['yandex_type']);
    $delivery_value[] = array(__('�����'), 3, $data['yandex_type']);
    $Tab3.= $PHPShopGUI->setField('������� ��������', $PHPShopGUI->setSelect('yandex_type_new', $delivery_value));
    
    // ����� � �������� ������ � �������
    $Tab3.=$PHPShopGUI->setField("��������� ����� � �������",$PHPShopGUI->setTextarea('yandex_mail_instock_new',$data['yandex_mail_instock'],true, false, '100px').$PHPShopGUI->setHelp('����������: <code>@dataFrom@</code> - ���������� ���� �������� ��, <code>@dataTo@</code> - ���������� ���� �������� ��'));
    
    // ����� � �������� ������ ��� �����
    $Tab3.=$PHPShopGUI->setField("��������� ����� ��� �����",$PHPShopGUI->setTextarea('yandex_mail_outstock_new',$data['yandex_mail_outstock'],true, false, '100px').$PHPShopGUI->setHelp('����������: <code>@dataFrom@</code> - ���������� ���� �������� ��, <code>@dataTo@</code> - ���������� ���� �������� ��'));

    if(empty($data['is_folder']))
    $PHPShopGUI->addTab(array("������.�����", $Tab3, true));
}

$addHandler = array(
    'actionStart' => 'addYandexcartDelivery',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>